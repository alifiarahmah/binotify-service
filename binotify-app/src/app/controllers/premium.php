<?php

class Premium extends Controller
{
	function __construct()
	{
		session_start();
	}

	public function index()
	{
		// get all premium artist implemented in AJAX
		$data['title'] = 'Premium Artists';
		$this->view('templates/layout', [
			'mode' => 'index',
			'user_id' => $_SESSION['user_id'],
		]);
	}

	public function artist($artist_id)
	{
		$data['title'] = 'Premium Artist';
		$this->view('templates/layout', [
			'mode' => 'artist_songs',
			'artist_id' => $artist_id,
		]);
	}

	public function fetch($data = [])
	{
		if ($data['mode'] == 'index') {
			$data['content'] = 'premium/index';
			$this->view($data['content'], []);
		} elseif ($data['mode'] == 'artist_songs') {
			$data['content'] = 'premium/songs';
			$this->view($data['content'], [
				'artist_id' => $data['artist_id'],
			]);
		}
	}
}
