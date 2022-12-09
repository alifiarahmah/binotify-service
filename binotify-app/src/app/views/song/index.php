<section id="song">
    <?php if ($data['song']) { ?>
        <div class="song-details">
            <div class="song-details" id="album-picture">
                <img src="<?= BASE_URL?>/<?=$data['song']['image_path'] ?? "public/assets/image/placeholder.jpg" ?>" width="150" height="150">
            </div>
            <div class="song-info">
                <h1><?= $data['song']['song_title'] ?></h1>
                <p><?= $data['song']['song_artist'] ?> - <?= $data['song']['release_date'] ?> - <?= floor($data['song']['duration'] / 60) ?> m <?= $data['song']['duration'] % 60 ?> s</p>
                <?php if (!is_null($data['song']['album_id'])) { ?>
                    <p><a href="<?= BASE_URL ?>/album/detail/<?= $data['song']['album_id'] ?>">View album</a></p>
                <?php } ?>
                <?php
                if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
                ?>
                <div class="song-actions">
                    <a class="edit-button" href="<?= BASE_URL ?>/song/edit/<?= $data['song']['song_id'] ?>">
                        <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 29.5001V37.0001H7.5L29.62 14.8801L22.12 7.38012L0 29.5001ZM35.42 9.08012C36.2 8.30012 36.2 7.04012 35.42 6.26012L30.74 1.58012C29.96 0.800117 28.7 0.800117 27.92 1.58012L24.26 5.24012L31.76 12.7401L35.42 9.08012Z" fill="#FFDD3C"/>
                        </svg>
                    </a>
                    <a class="delete-button" href="<?= BASE_URL ?>/song/delete/<?= $data['song']['song_id'] ?>">
                        <svg width="28" height="36" viewBox="0 0 28 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 32C2 34.2 3.8 36 6 36H22C24.2 36 26 34.2 26 32V8H2V32ZM28 2H21L19 0H9L7 2H0V6H28V2Z" fill="#FF646C"/>
                        </svg>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="audio-player-container">
            <?php if (!isset($_SESSION['username'])) { ?>
                <audio controls onplay="incrementNumPlay()" id="audio_player">
                    <source src="<?= BASE_URL?>/<?=$data['song']['audio_path']?>" type="audio/mpeg">
                </audio>
            <?php } else { ?>
                <audio controls id="audio-player">
                    <source src="<?= BASE_URL ?>/<?= $data['song']['audio_path'] ?>" type="audio/mpeg">
                </audio>
            <?php } ?>
        </div>
    <?php } else { ?>
        <h1>404 not found</h1>
    <?php } ?>
</section>

<script>
    function incrementNumPlay() {
        player = document.getElementById("audio_player");
        if (!document.cookie.includes('numplay')) {
            var d = new Date();
            d.setTime(d.getTime() + 5*60*1000); // 5 minutes
            document.cookie = "numplay=1;" + "expires=" + d.toUTCString() + ";path=/";
        } else {
            if (document.cookie.includes('numplay=3')) {
                player.load();
                alert('You have reached the maximum number of plays. Please login to continue listening.');
            } else {
                let numplay = parseInt(document.cookie.split('numplay=')[1]);
                numplay++;
                var d = new Date();
                d.setTime(d.getTime() + 5*60*1000); // 5 minutes
                document.cookie = "numplay=" + numplay + ";" + "expires=" + d.toUTCString() + ";path=/";
            }
        }
    }
</script>