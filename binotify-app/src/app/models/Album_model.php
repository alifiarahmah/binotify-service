<?php

class Album_model
{

	private $table = 'album';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getAllAlbums()
	{
		$this->db->query("SELECT 
            album_id, album_title, album_artist, total_duration, image_path, tanggal_terbit, genre
            FROM $this->table ORDER BY album_title ASC");
		return $this->db->resultSet();
	}

	public function getAlbumById($id)
	{
		$this->db->query("SELECT 
			album_id, album_title, album_artist, total_duration, image_path, tanggal_terbit, genre 
			FROM $this->table 
			WHERE album_id=:album_id");
		$this->db->bind('album_id', $id);
		return $this->db->single();
	}

	public function getAlbumNums()
	{
		$this->db->query("SELECT COUNT(*) FROM $this->table");
		return $this->db->single()['COUNT(*)'];
	}

	public function getNAlbums($first_item, $item_per_page)
	{
		$this->db->query("SELECT 
						album_id, album_title, album_artist, total_duration, image_path, tanggal_terbit, genre
						FROM $this->table ORDER BY album_title ASC LIMIT $first_item, $item_per_page");
		return $this->db->resultSet();
	}

	public function searchAlbum($search_query)
	{
		$query_tail = "FROM $this->table WHERE album_title LIKE '%$search_query%' ORDER BY album_title ASC";
		$this->db->query("SELECT 
						album_id, album_title, album_artist, total_duration, image_path, tanggal_terbit, genre " . $query_tail);
		$search_result = $this->db->resultSet();
		$this->db->query("SELECT COUNT(*) " . $query_tail);
		$search_result_count = $this->db->single()['COUNT(*)'];
		return ['result' => $search_result, 'count' => $search_result_count];
	}

	public function addAlbum($data)
	{
		$query = "INSERT INTO $this->table
										VALUES
									(NULL, :album_title, :album_artist, :total_duration, :image_path, :tanggal_terbit, :genre)";

		$this->db->query($query);
		$this->db->bind('album_title', $data['album-title']);
		$this->db->bind('album_artist', $data['album-artist']);
		$this->db->bind('total_duration', 0);
		$this->db->bind('image_path', $data['image-path']);
		$this->db->bind('tanggal_terbit', $data['tanggal-terbit']);
		$this->db->bind('genre', $data['genre']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deleteAlbum($id)
	{
		$query = "DELETE FROM $this->table WHERE album_id = :album_id";
		$this->db->query($query);
		$this->db->bind('album_id', $id);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function updateAlbum($data)
	{
		$query = "UPDATE $this->table SET
					album_title = :album_title,
					album_artist = :album_artist,
					total_duration = :total_duration,
					image_path = :image_path,
					tanggal_terbit = :tanggal_terbit,
					genre = :genre
					WHERE album_id = :album_id";

		$this->db->query($query);
		$this->db->bind('album_title', $data['album-title']);
		$this->db->bind('album_artist', $data['album-artist']);
		$this->db->bind('total_duration', $data['total-duration']);
		$this->db->bind('image_path', $data['image-path']);
		$this->db->bind('tanggal_terbit', $data['tanggal-terbit']);
		$this->db->bind('genre', $data['genre']);
		$this->db->bind('album_id', $data['album-id']);

		$this->db->execute();

		return $this->db->rowCount();
	}
}
