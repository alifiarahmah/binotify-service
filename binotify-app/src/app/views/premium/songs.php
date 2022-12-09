<div>
	<script>
		function renderArtist(data) {
			let artistName = data.artist.name;
			let artistContainer = document.getElementById('premium-singer');
			artistContainer.innerHTML = `Songs by ${artistName}`;

			let container = document.getElementById('premium-song-container')
			let songs = data.data;
			let html = ''

			for (let i = 0; i < songs.length; i++) {
				html += '<tr>';
				html += `<td><h5>${songs[i].song_title}</h5></td>`;
				html += '<td><audio controls>';
				html += `<source src = "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3">`;
				html += '</audio></td>';
				html += '</tr>';
			}
			container.innerHTML += html;

			if (songs.length == 0) {
				container.innerHTML = 'No songs available';
			}
		}

		let xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let raw_data = JSON.parse(this.responseText);
				console.log(raw_data);
				renderArtist(raw_data);
			}
		}
		xhttp.open("GET", "<?= REST_BASE_URL ?>/artist_song?artist_id=<?= $data['artist_id'] ?>&user_id=<?= $_SESSION['user_id'] ?>", true);
		xhttp.send();
	</script>

	<h1 id="premium-singer"></h1>

	<table id="premium-song-container">
		<th>
			<tr>
				<td>Title</td>
				<td>Song</td>
			</tr>
		</th>
	</table>
</div>