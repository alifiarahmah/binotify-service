<?php

class Album extends Controller
{
	function __construct() {
        session_start();
    }
	
	public function index($current_page = 1)
	{
		$data['title'] = 'All Albums';
		$this->view('templates/layout', [
			'mode' => 'all',
			'current_page' => $current_page
		]);
	}

	public function detail($id = 0)
	{
		$data['title'] = 'Album';
		$this->view('templates/layout', [
			'mode' => 'detail',
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
		$this->model('Album_model')->deleteAlbum($id);
		header('Location: ' . BASE_URL . '/album/1');
	}

	public function submit()
	{
		if ($_FILES['album-image']['error'] == 0) {
			$album_image = $_FILES['album-image'];
			$album_image_path = $this->store_image($album_image);
			$_POST['image-path'] = $album_image_path;
		}

		if ($this->model('Album_model')->addAlbum($_POST) > 0) {
			header('Location: ' . BASE_URL . '/album/1');
			exit;
		}
	}

	public function save($id)
	{
		if ($_FILES['album-image']['error'] == 0) {
			$album_image = $_FILES['album-image'];
			$album_image_path = $this->store_image($album_image);
			$_POST['image-path'] = $album_image_path;
		} else {
			$_POST['image-path'] = $this->model('Album_model')->getAlbumById($id)['image_path'];
		}

		$_POST['album-id'] = $id;
		$_POST['tanggal-terbit'] = $this->model('Album_model')->getAlbumById($id)['tanggal_terbit'];
		$_POST['total-duration'] = $this->model('Album_model')->getAlbumById($id)['total_duration'];

		if ($this->model('Album_model')->updateAlbum($_POST, $id) > 0) {
			header('Location: ' . BASE_URL . '/album/detail/' . $id);
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

	public function fetch($data = [])
	{
		if ($data['mode'] == 'detail') {
			$data['content'] = 'album/detail';
			$album = $this->model('Album_model')->getAlbumById($data['id']);
			$songs = $this->model('Song_model')->getSongByAlbumId($data['id']);
			$this->view($data['content'], [
				'album' => $album,
				'songs' => $songs
			]);
		} elseif ($data['mode'] == 'all') {
			$current_page = $data['current_page'];
			
			$data['content'] = 'album/index';
			$this->view($data['content'], [
				'current_page' => $current_page,
			]);
		} elseif ($data['mode'] == 'add') {
			$data['content'] = 'album/add';
			$this->view($data['content']);
		} elseif ($data['mode'] == 'edit') {
			$data['content'] = 'album/edit';
			$album = $this->model('Album_model')->getAlbumById($data['id']);
			$this->view($data['content'], [
				'album' => $album
			]);
		}
	}
}
