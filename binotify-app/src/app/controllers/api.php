<?php

class Api extends Controller
{

	public function index()
	{
		echo "";
	}

	public function album($current_page = 1)
	{
		if (isset($current_page)) {
			// pagination
			$item_per_page = 5;
			$item_count = $this->model('Album_model')->getAlbumNums();
			$total_page = ceil($item_count / $item_per_page);
			$first_item = ($item_per_page * $current_page) - $item_per_page;
			$albums = $this->model('Album_model')->getNAlbums($first_item, $item_per_page);

			$data = [
				'current_page' => intval($current_page),
				'total_page' => $total_page,
				'albums' => $albums,
			];
			echo json_encode($data);
		} else {
			$albums = $this->model('Album_model')->getAllAlbums();
			echo json_encode($albums);
		}
	}

	public function search($keyword = "", $current_page = 1, $sort = "", $filter = "all")
	{
		$query = $this->model('Song_model')->searchSong($keyword, $sort, $filter, $current_page);

		// pagination
		$item_per_page = 5;
		$item_count = $query['count'];
		$total_page = ceil($item_count / $item_per_page);
		$songs = $this->model('Song_model')->getNSearchSongs($keyword, $sort, $filter, $current_page);

		echo json_encode([
			'search' => $keyword,
			'songs' => $songs,
			'item_count' => $item_count,
			'current_page' => intval($current_page),
			'total_page' => $total_page,
			'sort' => $sort,
			'filter' => $filter
		]);
	}

	public function user($user_id = null)
	{
		if (isset($user_id)) {
			$user = $this->model('User_model')->getUserById($user_id);
			echo json_encode($user);
		} else {
			$users = $this->model('User_model')->getAllUsers();
			echo json_encode($users);
		}
	}

	public function callback()
	{
		// TODO: add callback from SOAP subscriber to update subscription database

		$webservice_url = "http://localhost:9999/binotify/services/subscription";

		$request_param = '<?xml version="1.0" encoding="utf-8"?>
<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"
xmlns:m="http://soap.binotify.com/">
    <s:Body>
        <m:generateSubscription>
		</m:generateSubscription>
    </s:Body>
</s:Envelope>';

		$headers = array(
			'Content-Type: text/xml; charset=utf-8',
			'Content-Length: ' . strlen($request_param)
		);

		$ch = curl_init($webservice_url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request_param);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$data = curl_exec($ch);

		$result = $data;

		if ($result === FALSE) {
			printf(
				"CURL error (#%d): %s<br>\n",
				curl_errno($ch),
				htmlspecialchars(curl_error($ch))
			);
		}

		echo $result;

		curl_close($ch);
	}
}
