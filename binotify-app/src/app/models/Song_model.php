<?php

class Song_model
{

	private $table = 'song';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getAllSongs()
	{
		$this->db->query("SELECT 
            song_id, song_title, song_artist, release_date, genre, duration, audio_path, image_path, album_id
            FROM $this->table");
		return $this->db->resultSet();
	}

	public function getNSongs($number)
	{
		$this->db->query("SELECT 
            song_id, song_title, song_artist, release_date, genre, duration, audio_path, image_path, album_id
            FROM $this->table ORDER BY song_title ASC LIMIT $number ");
		return $this->db->resultSet();
	}

	public function getAllSongGenres()
	{
		$this->db->query("SELECT DISTINCT genre FROM $this->table WHERE genre IS NOT NULL ORDER BY genre ASC");
		return $this->db->resultSet();
	}

	public function getSongByAlbumId($id)
	{
		$this->db->query("SELECT 
            song_id, song_title, song_artist, release_date, genre, duration, audio_path, image_path, album_id
            FROM $this->table WHERE album_id=:album_id");
		$this->db->bind('album_id', $id);
		return $this->db->resultSet();
	}

	public function getSongById($id)
	{
		$this->db->query("SELECT 
            song_id, song_title, song_artist, release_date, genre, duration, audio_path, image_path, album_id
            FROM $this->table WHERE song_id=:song_id");
		$this->db->bind('song_id', $id);
		return $this->db->single();
	}

	public function addSong($data)
	{
		$query = "INSERT INTO $this->table
										VALUES
									(NULL, :song_title, :song_artist, :release_date, :genre, :duration, :audio_path, :image_path, :album_id)";

		$this->db->query($query);
		$this->db->bind('song_title', $data['song-title']);
		$this->db->bind('song_artist', $data['song-artist']);
		$this->db->bind('release_date', $data['release-date']);
		$this->db->bind('genre', $data['genre']);
		$this->db->bind('duration', $data['duration']);
		$this->db->bind('audio_path', $data['audio-path']);
		$this->db->bind('image_path', $data['image-path']);
		$this->db->bind('album_id', $data['song-album']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deleteSong($id)
	{
		$query = "DELETE FROM $this->table WHERE song_id = :song_id";
		$this->db->query($query);
		$this->db->bind('song_id', $id);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function updateSong($data)
	{
		$query = "UPDATE $this->table SET
										song_title = :song_title,
										release_date = :release_date,
										genre = :genre,
										image_path = :image_path,
										album_id = :album_id
										WHERE song_id = :song_id";

		$this->db->query($query);
		$this->db->bind('song_title', $data['song-title']);
		$this->db->bind('release_date', $data['release-date']);
		$this->db->bind('genre', $data['genre']);
		$this->db->bind('image_path', $data['image-path']);
		$this->db->bind('album_id', $data['song-album']);
		$this->db->bind('song_id', $data['song-id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	// HOME
	public function get10LatestSongs()
	{
		$this->db->query(
			"SELECT * FROM (
				SELECT song_id, song_title, song_artist, release_date, genre, duration, audio_path, image_path, album_id
				FROM $this->table
				ORDER BY song_id 
				DESC LIMIT 10
			) ten_song ORDER BY song_title ASC;"
		);
		return $this->db->resultSet();
	}

	// SEARCH

	public function searchSong($raw_keyword, $raw_sort, $raw_filter)
	{
		// sanitize
		$keyword = htmlspecialchars($raw_keyword);
		$sort = htmlspecialchars($raw_sort);
		$filter = htmlspecialchars($raw_filter);

		$query_head = "SELECT 
			song_id, song_title, song_artist, release_date, genre, image_path ";
		$query = "FROM $this->table 
			WHERE song_title LIKE '%$keyword%'";

		// filter
		if (isset($filter)) {
			if ($filter == "NULL") {
				$query .= " AND genre IS NULL";
			} else if ($filter != "all") {
				$query .= " AND genre = '$filter'";
			}
		}

		// sort
		if (isset($sort)) {
			switch ($sort) {
				case 'title-asc':
					$query .= " ORDER BY song_title ASC";
					break;
				case 'title-desc':
					$query .= " ORDER BY song_title DESC";
					break;
				case 'date-asc':
					$query .= " ORDER BY release_date ASC";
					break;
				case 'date-desc':
					$query .= " ORDER BY release_date DESC";
					break;
			}
		}

		$this->db->query($query_head . $query);
		$search_result = $this->db->resultSet();
		$this->db->query("SELECT COUNT(*) " . $query);
		$search_result_count = $this->db->single()['COUNT(*)'];
		return ['result' => $search_result, 'count' => $search_result_count];
	}
	// paginate search result
	public function getNSearchSongs($raw_keyword, $raw_sort, $raw_filter, $raw_page = 1)
	{
		// sanitize
		$keyword = htmlspecialchars($raw_keyword);
		$sort = htmlspecialchars($raw_sort);
		$filter = htmlspecialchars($raw_filter);
		$page = htmlspecialchars($raw_page);

		$query_head = "SELECT 
			song_id, song_title, song_artist, release_date, genre, image_path ";
		$query = "FROM $this->table 
			WHERE song_title LIKE '%$keyword%'";

		// filter
		if (isset($filter)) {
			if ($filter == "NULL") {
				$query .= " AND genre IS NULL";
			} else if ($filter != "all") {
				$query .= " AND genre = '$filter'";
			}
		}

		// sort
		if (isset($sort)) {
			switch ($sort) {
				case 'title-asc':
					$query .= " ORDER BY song_title ASC";
					break;
				case 'title-desc':
					$query .= " ORDER BY song_title DESC";
					break;
				case 'date-asc':
					$query .= " ORDER BY release_date ASC";
					break;
				case 'date-desc':
					$query .= " ORDER BY release_date DESC";
					break;
			}
		}

		// pagination
		$limit = 5;
		$offset = ($page - 1) * $limit;
		$query .= " LIMIT $limit OFFSET $offset";

		$this->db->query($query_head . $query);
		return $this->db->resultSet();
	}
}
