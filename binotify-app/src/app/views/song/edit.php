<?php if ($data['song'] && $_SESSION['isAdmin']) { ?>
    <h1>Edit Song</h1>
    <div class="form-container">
        <form action="<?= BASE_URL ?>/song/save/<?= $data['song']['song_id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="song-title">Title</label>
                <input type="text" name="song-title" id="song-title" class="input-outline" placeholder="Song Title" value="<?= $data['song']['song_title'] ?>" required>
            </div>
            <div class="form-group">
                <label for="song-artist">Artist</label>
                <input type="text" name="song-artist" id="song-artist" class="input-outline" placeholder="Song Artist" value="<?= $data['song']['song_artist'] ?>" disabled>
            </div>
            <div class="form-group">
                <label for="song-release-date">Release Date</label>
                <input type="date" name="release-date" id="song-release-date" class="input-outline" placeholder="Song Release Date" value="<?= $data['song']['release_date'] ?>" required>
            </div>
            <div class="form-group">
                <label for="song-genre">Genre</label>
                <input type="text" name="genre" id="song-genre" class="input-outline" placeholder="Song Genre" value="<?= $data['song']['genre'] ?>" required>
            </div>
            <div class="form-group">
                <label for="song-duration">Duration</label>
                <input type="number" name="duration" id="song-duration" class="input-outline" placeholder="Song Duration" value="<?= $data['song']['duration'] ?>" disabled>
            </div>
            <div class="form-group">
                <label for="song-album">Album</label>
                <select name="song-album" id="song-album" class="form-control">
                    <option value=0 selected></option>
                    <?php foreach ($data['albums'] as $album) { ?>
                        <option value="<?= $album['album_id'] ?>" <?= $album['album_id'] == $data['song']['album_id'] ? 'selected' : '' ?>><?= $album['album_title'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="song-image">Cover</label>
                <input type="file" name="song-image" id="song-image" class="form-control" accept=".jpg, .jpeg, .png">
            </div>
            <div class="form-group">
                <label for="song-file">Audio</label>
                <input type="file" name="song-audio" id="song-file" class="form-control" accept=".mp3">
            </div>
            <div class="song-actions">
                <button type="submit" class="button-solid">Save</button>
                <button type="button" class="button-outline" onclick="window.location.href='<?= BASE_URL ?>/song/<?= $data['song']['song_id'] ?>'">Cancel</button>
            </div>
        </form>
    </div>
<?php } else { ?>
    <h1>404 Not Found</h1>
<?php } ?>