<?php

class Search extends Controller
{
	function __construct() {
        session_start();
    }

	public function index($keyword = "", $current_page = 1)
	{
		$data['title'] = 'Search';
		$this->view('templates/layout', [
			'keyword' => $keyword,
			'current_page' => $current_page,
			'sort' => $_POST['sort'] ?? '',
			'filter' => $_POST['filter'] ?? 'all'
		]);
	}

	public function fetch($data = [])
	{
		// note: bisa pake $_SERVER['REQUEST_URI'] untuk ambil data dari url

		$data['content'] = 'search/index';
		$keyword = $data['keyword'];
		$current_page = $data['current_page'] ?? 1;
		$sort = $data['sort'];
		$filter = $data['filter'];

		$query = $this->model('Song_model')->searchSong($keyword, $sort, $filter, $current_page);

		// pagination
		$item_per_page = 5;
		$item_count = $query['count'];
		$total_page = ceil($item_count / $item_per_page);
		$songs = $this->model('Song_model')->getNSearchSongs($keyword, $sort, $filter, $current_page);

		$this->view($data['content'], [
			'search' => $keyword,
			'songs' => $songs,
			'item_count' => $item_count,
			'genres' => $this->model('Song_model')->getAllSongGenres(),
			'current_page' => $current_page,
			'total_page' => $total_page,
			'sort' => $sort,
			'filter' => $filter
		]);
	}
}
