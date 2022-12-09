<?php

class Home extends Controller
{
    function __construct() {
        session_start();
    }
    public function index()
    {
        $data['title'] = 'Listen to all songs';
        $this->view('templates/layout');
    }

    public function fetch()
    {
        // get 10 latest songs from database
        $this->view('home/index', [
            'content' => 'home/index',
            'songs' => $this->model('Song_model')->get10LatestSongs()
        ]);
    }
}
