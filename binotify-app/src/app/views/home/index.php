<section id="home">
    <h1>
        Listen now
    </h1>

    <div class="song-item-container">
        <div class="header-row"></div>
        <div class="header-row header-title">song title</div>
        <div class="header-row header-artist">artist</div>
        <div class="header-row header-date">date</div>
        <div class="header-row header-genre">genre</div>
        <?php if (count($data) > 0) { ?>
            <?php foreach ($data['songs'] as $i => $song) { ?>
                <a class="content-row" href="<?= BASE_URL ?>/song/<?= $song['song_id'] ?>">
                    <div class="song-picture">
                        <image src="<?= $song['image_path'] ?? "public/assets/image/placeholder.jpg" ?>" width="42px" height="42px">
                    </div>
                    <div class="song-title"><?= $song['song_title']; ?></div>
                    <div class="song-artist"><?= $song['song_artist']; ?></div>
                    <div class="song-date"><?= $song['release_date']; ?></div>
                    <div class="song-genre"><?= $song['genre']; ?></div>
                </a>
            <?php } ?>
        <?php } else { ?>
            <p>no songs found</p>
        <?php } ?>
    </div>
</section>