<?php if ($_SESSION['isAdmin']) { ?>
    <h1>Add Song</h1>
    <div class="form-container">
        <form action="<?= BASE_URL ?>/song/submit" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="song-title">Title</label>
                <input type="text" name="song-title" id="song-title" class="input-outline" placeholder="Song Title" required>
            </div>
            <div class="form-group">
                <label for="song-artist">Artist</label>
                <input type="text" name="song-artist" id="song-artist" class="input-outline" placeholder="Song Artist" required>
            </div>
            <div class="form-group">
                <label for="song-release-date">Release Date</label>
                <input type="date" name="release-date" id="song-release-date" class="input-outline" placeholder="Song Release Date" required>
            </div>
            <div class="form-group">
                <label for="song-genre">Genre</label>
                <input type="text" name="genre" id="song-genre" class="input-outline" placeholder="Song Genre" required>
            </div>
            <div class="form-group">
                <label for="song-album">Album</label>
                <select name="song-album" id="song-album" class="form-control" required>
                    <option value="" selected disabled>Select Album</option>
                    <?php foreach ($data['albums'] as $album) { ?>
                        <option value="<?= $album['album_id'] ?>"><?= $album['album_title'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="song-image">Cover</label>
                <input type="file" name="song-image" id="song-image" class="form-control" accept=".jpg, .jpeg, .png" required>
            </div>
            <div class="form-group">
                <label for="song-file">Audio</label>
                <input type="file" name="song-file" id="song-file" class="form-control" accept=".mp3" required>
            </div>
            <div class="song-actions">
                <button type="submit" class="button-solid">Submit</button>
                <button type="button" class="button-outline" onclick="window.location.href='<?= BASE_URL ?>'">Cancel</button>
            </div>
        </form>
    </div>
<?php } else { ?>
    <h1>404 Not Found</h1>
<?php } ?>