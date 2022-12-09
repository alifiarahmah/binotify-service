<?php

class Song extends Controller
{
    function __construct() {
        session_start();
    }

    public function index($id = 0)
    {
        $this->view('templates/layout', [
            'mode' => 'index',
            'id' => $id,
        ]);
    }

    public function add()
    {
        $this->view('templates/layout', [
            'mode' => 'add',
        ]);
    }

    public function edit($id = 0)
    {
        $this->view('templates/layout', [
            'mode' => 'edit',
            'id' => $id,
        ]);
    }

    public function delete($id = 0)
    {
        $this->model('Song_model')->deleteSong($id);
        header('Location: ' . BASE_URL);
    }

    public function submit()
    {
        if ($_FILES['song-file']['error'] == 0) {
            $song_audio = $_FILES['song-file'];
            $song_audio_path = $this->store_audio($song_audio);
            $_POST['audio-path'] = $song_audio_path;
            $duration = $_FILES['song-file']['size'] * 8 / (128 * 1024);
            $_POST['duration'] = ceil($duration);
        } else {
            $_POST['audio-path'] = 'default.mp3';
            $_POST['duration'] = 0;
        }

        $song_image = $_FILES['song-image'];
        $song_image_path = $this->store_image($song_image);
        $_POST['image-path'] = $song_image_path;

        if ($this->model('Song_model')->addSong($_POST) > 0) {
            header('Location: ' . BASE_URL);
            exit;
        }
    }

    public function save($id)
    {
        if ($_FILES['song-image']['error'] == 0) {
            $song_image = $_FILES['song-image'];
            $song_image_path = $this->store_image($song_image);
            $_POST['image-path'] = $song_image_path;
        } else {
            $_POST['image-path'] = $this->model('Song_model')->getSongById($id)['image_path'];
        }

        if ($_FILES['song-file']['error'] == 0) {
            $song_audio = $_FILES['song-file'];
            $song_audio_path = $this->store_audio($song_audio);
            $_POST['audio-path'] = $song_audio_path;
        } else {
            $_POST['audio-path'] = $this->model('Song_model')->getSongById($id)['audio_path'];
        }

        $_POST['song-id'] = $id;
        if ($_POST['song-album'] == 0) {
            $_POST['song-album'] = NULL;
        }

        if ($this->model('Song_model')->updateSong($_POST) > 0) {
            header('Location: ' . BASE_URL);
            exit;
        }
    }

    public function store_image($image)
    {
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_error = $image['error'];

        if ($image_error === 0) {
            $image_destination = 'public/assets/image/' . $image_name;
            move_uploaded_file($image_tmp_name, $image_destination);
            return $image_destination;
        }
    }

    public function store_audio($audio)
    {
        $audio_name = $audio['name'];
        $audio_tmp_name = $audio['tmp_name'];
        $audio_error = $audio['error'];

        if ($audio_error === 0) {
            $audio_destination = 'public/assets/audio/' . $audio_name;
            move_uploaded_file($audio_tmp_name, $audio_destination);
            return $audio_destination;
        }
    }

    public function fetch($data = [])
    {
        if ($data['mode'] == 'add') {
            $data['content'] = 'song/add';
            $albums = $this->model('Album_model')->getAllAlbums();
            $this->view($data['content'], [
                'albums' => $albums,
            ]);
        } elseif ($data['mode'] == 'index') {
            $data['content'] = 'song/index';
            $song = $this->model('Song_model')->getSongById($data['id']);
            $this->view($data['content'], [
                'song' => $song,
            ]);
        } elseif ($data['mode'] == 'edit') {
            $data['content'] = 'song/edit';
            $song = $this->model('Song_model')->getSongById($data['id']);
            $albums = $this->model('Album_model')->getAllAlbums();
            $this->view($data['content'], [
                'song' => $song,
                'albums' => $albums,
            ]);
        }
    }
}
