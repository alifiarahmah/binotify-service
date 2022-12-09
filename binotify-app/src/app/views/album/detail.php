<section id="album">
    <?php if ($data['album']) { ?>
        <div class="album-details">
            <div class="album-details" id="album-picture">
                <img src="<?= BASE_URL ?>/<?= $data['album']['image_path'] ?? "public/assets/image/placeholder.jpg" ?>" width="150" height="150">
            </div>
            <div class="album-info">
                <h1><?= $data['album']['album_title'] ?></h1>
                <p><?= $data['album']['album_artist'] ?> - <?= $data['album']['tanggal_terbit'] ?> - <?= floor($data['album']['total_duration']/60) ?> m <?= $data['album']['total_duration']%60 ?> s total</p>
                <?php
                if (isset ($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                ?>
                <div class="album-actions">
                    <a class="edit-button" href="<?= BASE_URL ?>/album/edit/<?= $data['album']['album_id'] ?>">
                        <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 29.5001V37.0001H7.5L29.62 14.8801L22.12 7.38012L0 29.5001ZM35.42 9.08012C36.2 8.30012 36.2 7.04012 35.42 6.26012L30.74 1.58012C29.96 0.800117 28.7 0.800117 27.92 1.58012L24.26 5.24012L31.76 12.7401L35.42 9.08012Z" fill="#FFDD3C"/>
                        </svg>
                    </a>
                    <a class="delete-button" href="<?= BASE_URL ?>/album/delete/<?= $data['album']['album_id'] ?>">
                        <svg width="28" height="36" viewBox="0 0 28 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 32C2 34.2 3.8 36 6 36H22C24.2 36 26 34.2 26 32V8H2V32ZM28 2H21L19 0H9L7 2H0V6H28V2Z" fill="#FF646C"/>
                        </svg>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php if (count($data['songs']) > 0) { ?>
            <div class="song-item-container">
                <div class="header-row"></div>
                <div class="header-row header-title">song title</div>
                <div class="header-row header-artist">artist</div>
                <div class="header-row header-date">date</div>
                <div class="header-row header-genre">genre</div>
                <?php foreach ($data['songs'] as $i => $song) { ?>
                    <a class="content-row" href="<?= BASE_URL ?>/song/<?= $song['song_id'] ?>">
                        <div class="song-picture">
                            <image src="<?= BASE_URL ?>/<?= $song['image_path'] ?? "public/assets/image/placeholder.jpg" ?>" width="42px" height="42px">
                        </div>
                        <div class="song-title"><?= $song['song_title']; ?></div>
                        <div class="song-artist"><?= $song['song_artist']; ?></div>
                        <div class="song-date"><?= $song['release_date']; ?></div>
                        <div class="song-genre"><?= $song['genre']; ?></div>
                    </a>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>no songs found</p>
        <?php } ?>
    <?php } else { ?>
        <h1>404 not found</h1>
    <?php } ?>
</section>