<section id="search">
	<script>
		function renderSongs(data, current_page, total_page) {
			let result = document.getElementById('song-item-container');
			let firstButton = document.getElementById('first-button');
			let prevButton = document.getElementById('prev-button');
			let nextButton = document.getElementById('next-button');
			let lastButton = document.getElementById('last-button');
			let paginationPages = document.getElementById('song-pagination');

			let temp = '<div class="header-row"></div>' +
				'<div class="header-row header-title">album title</div>' +
				'<div class="header-row header-artist">artist</div>' +
				'<div class="header-row header-date">date</div>' +
				'<div class="header-row header-genre">genre</div>';
			let html = '';
			for (let i = 0; i < data.length; i++) {
				html +=
					'<a class="content-row" href="<?= BASE_URL ?>/album/detail/' +
					data[i].song_id +
					'">';
				html += '<div class="song-picture">';
				html += '<image src="<?= BASE_URL ?>/' + (data[i].image_path !== null ? data[i].image_path : 'public/assets/image/placeholder.jpg') + '" width="42px" height="42px">';
				html += "</div>";
				html += '<div class="song-title">' + data[i].song_title + "</div>";
				html += '<div class="song-artist">' + data[i].song_artist + "</div>";
				html += '<div class="song-date">' + data[i].release_date + "</div>";
				html += '<div class="song-genre">' + data[i].genre + "</div>";
				html += "</a>";
			}
			result.innerHTML = temp + html;
			paginationPages.innerHTML = current_page + " / " + total_page;
		}

		let xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let raw_data = JSON.parse(this.responseText);
				console.log(raw_data);
				data = raw_data.songs;
				current_page = raw_data.current_page;
				total_page = raw_data.total_page;
				sort = raw_data.sort;
				filter = raw_data.filter;
				renderSongs(data, current_page, total_page);
			}
		};
		console.log("<?= BASE_URL ?>/api/search/<?= $data['search'] ?>/<?= $data['current_page'] ?>")
		xhttp.open("GET", "<?= BASE_URL ?>/api/search/<?= $data['search'] ?>/<?= $data['current_page'] ?>", true);
		xhttp.send();

		function prevButtonHandler() {
			if (current_page > 1) {
				current_page--;
				let xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						let raw_data = JSON.parse(this.responseText);
						data = raw_data.songs;
						current_page = raw_data.current_page;
						total_page = raw_data.total_page;
						total_page = raw_data.total_page;
						sort = raw_data.sort;
						filter = raw_data.filter;
						renderSongs(data, current_page, total_page);
					}
				};
				xhttp.open("GET", "<?= BASE_URL ?>/api/search/<?= $data['search'] ?>/" + current_page, true);
				xhttp.send();
			}
		}

		function nextButtonHandler() {
			if (current_page < total_page) {
				current_page++;
				let xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						let raw_data = JSON.parse(this.responseText);
						data = raw_data.songs;
						current_page = raw_data.current_page;
						total_page = raw_data.total_page;
						total_page = raw_data.total_page;
						sort = raw_data.sort;
						filter = raw_data.filter;
						renderSongs(data, current_page, total_page);
					}
				};
				xhttp.open("GET", "<?= BASE_URL ?>/api/search/<?= $data['search'] ?>/" + current_page, true);
				xhttp.send();
			}
		}

		function firstButtonHandler() {
			if (current_page > 1) {
				current_page = 1;
				let xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						let raw_data = JSON.parse(this.responseText);
						data = raw_data.songs;
						current_page = raw_data.current_page;
						total_page = raw_data.total_page;
						sort = raw_data.sort;
						filter = raw_data.filter;
						renderSongs(data, current_page, total_page);
					}
				};
				xhttp.open("GET", "<?= BASE_URL ?>/api/search/<?= $data['search'] ?>/" + current_page, true);
				xhttp.send();
			}
		}

		function lastButtonHandler() {
			if (current_page < total_page) {
				current_page = total_page;
				let xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						let raw_data = JSON.parse(this.responseText);
						data = raw_data.songs;
						current_page = raw_data.current_page;
						total_page = raw_data.total_page;
						total_page = raw_data.total_page;
						sort = raw_data.sort;
						filter = raw_data.filter;
						renderSongs(data, current_page, total_page);
					}
				};
				xhttp.open("GET", "<?= BASE_URL ?>/api/search/<?= $data['search'] ?>/" + current_page, true);
				xhttp.send();
			}
		}

		function handleSort() {
			let filter = document.getElementById("filter").value;
			let sort = document.getElementById("sort").value;
			let xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					let raw_data = JSON.parse(this.responseText);
					data = raw_data.songs;
					current_page = raw_data.current_page;
					total_page = raw_data.total_page;
					sort = raw_data.sort;
					filter = raw_data.filter;
					renderSongs(data, current_page, total_page);
				}
			};
			xhttp.open("GET", "<?= BASE_URL ?>/api/search/<?= $data['search'] ?>/" + current_page + "/" + sort, true);
			xhttp.send();
		}

		function handleFilter() {
			let filter = document.getElementById("filter").value;
			let sort = document.getElementById("sort").value;
			let xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					let raw_data = JSON.parse(this.responseText);
					data = raw_data.songs;
					current_page = raw_data.current_page;
					total_page = raw_data.total_page;
					sort = raw_data.sort;
					filter = raw_data.filter;
					renderSongs(data, current_page, total_page);
				}
			};
			xhttp.open("GET", "<?= BASE_URL ?>/api/search/<?= $data['search'] ?>/" + current_page + "/" + sort + "/" + filter, true);
			xhttp.send();
		}
	</script>

	<div class="search-header">
		<div>
			<h1>Searching for "<?= $data['search'] ?>"</h1>
			<p>Found <?= $data['item_count']; ?> songs</p>
		</div>
		<div class="search-option-container">
			<select title="Sort" name="sort" id="sort" class="button-solid" onchange="handleSort()">
				<option value="" disabled>Sort by</option>
				<option value="">Unsorted</option>
				<option value="title-asc">Title (A-Z)</option>
				<option value="title-desc">Title (Z-A)</option>
				<option value="date-desc">Release Date (Newest First)</option>
				<option value="date-asc">Release Date (Oldest First)</option>
			</select>
			<select title="Filter" name="filter" id="filter" class="button-solid" onchange="handleFilter()">
				<option value="" disabled>Genre</option>
				<option value="all">All genres</option>
				<?php foreach ($data['genres'] as $genre) { ?>
					<option value="<?= $genre['genre']; ?>"><?= $genre['genre']; ?></option>
				<?php } ?>
				<option value="NULL">-</option>
			</select>
		</div>
	</div>

	<div class="song-item-container" id="song-item-container">
		<div class="header-row"></div>
		<div class="header-row header-title">album title</div>
		<div class="header-row header-artist">artist</div>
		<div class="header-row header-date">date</div>
		<div class="header-row header-genre">genre</div>
	</div>

</section>

<div class="pagination-container">
	<div class="pagination">
		<button onclick="firstButtonHandler()" id="first-button" class="icon-button-outline">
			<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path d="M14.82 2.82L12 0L0 12L12 24L14.82 21.18L5.66 12L14.82 2.82Z" />
				<path d="M24.64 2.82L21.82 0L9.82001 12L21.82 24L24.64 21.18L15.48 12L24.64 2.82Z" />
			</svg>
		</button>
		<button onclick="prevButtonHandler()" id="prev-button" class="icon-button-outline">
			<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path d="M14.82 2.82L12 0L0 12L12 24L14.82 21.18L5.66 12L14.82 2.82Z" />
			</svg>
		</button>
		<p id="song-pagination"></p>
		<button onclick="nextButtonHandler()" id="next-button" class="icon-button-outline">
			<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path d="M3.00005 0L0.180054 2.82L9.34005 12L0.180054 21.18L3.00005 24L15.0001 12L3.00005 0Z" />
			</svg>
		</button>
		<button onclick="lastButtonHandler()" id="last-button" class="icon-button-outline">
			<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path d="M2.82 0L0 2.82L9.16 12L0 21.18L2.82 24L14.82 12L2.82 0Z" />
				<path d="M12.6399 0L9.81995 2.82L18.9799 12L9.81995 21.18L12.6399 24L24.6399 12L12.6399 0Z" />
			</svg>
		</button>
	</div>
</div>