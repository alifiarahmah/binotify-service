<div>
	<script>
		function renderArtist(data) {
			// get subscription from XHTTP request
			let user_subscriptions;
			let xhttp2 = new XMLHttpRequest();
			xhttp2.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					let raw_data = JSON.parse(this.responseText);
					subscription = raw_data.data.filter(sub => sub.subscriberId == <?= $_SESSION['user_id'] ?>);

					// render artis list to HTML
					let container = document.getElementById('premium-artist-container')
					let html = '';
					console.log(subscription);

					for (let i = 0; i < data.length; i++) {
						html += '<div id="premium-artist-items" class="artist-item-container">';
						html += '<div>' + data[i].name + '</div>';
						// find in subscription array if user is subscribed to artist
						// if user is subscribed to artist with id data[i].user_id, show see songs button
						if (subscription.find(sub => sub.creatorId == data[i].user_id && sub.status == 'ACCEPTED')) {
							html += `<div><a href="<?= BASE_URL ?>/premium/artist/${data[i].user_id}"><button class="button-outline">See songs</button></a></div>`;
						} else if (subscription.find(sub => sub.creatorId == data[i].user_id && sub.status == 'PENDING')) {
							html += `<div>Waiting for approval</div>`;
						} else {
							// TODO: POST request to SOAP server to create subscription
							html += '<div><button class="button-solid">Subscribe</button></div>';
						}

						html += '</div>';
					}

					container.innerHTML = html;

				}
			}
			xhttp2.open("GET", "<?= REST_BASE_URL ?>/subscriptions?page=all", true);
			xhttp2.send();
		}

		// get artists from REST
		let xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let raw_data = JSON.parse(this.responseText);
				renderArtist(raw_data.data);
			}
		}
		xhttp.open("GET", "<?= REST_BASE_URL ?>/artist", true);
		xhttp.send();
	</script>

	<h1>Premium Artists</h1>
	<div id="premium-artist-container">
		<div class="premium-artist-header">
			<div class=" header-row">name</div>
			<div class=" header-row">action</div>
		</div>
	</div>

</div>