<?php if ($data['album'] && $_SESSION['isAdmin']) { ?>
    <h1>Edit Album</h1>
    <div class="form-container">
        <form action="<?= BASE_URL ?>/album/save/<?= $data['album']['album_id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="album-title">Title</label>
                <input type="text" name="album-title" id="album-title" class="input-outline" placeholder="Album Title" value="<?= $data['album']['album_title'] ?>" required>
            </div>
            <div class="form-group">
                <label for="album-artist">Artist</label>
                <input type="text" name="album-artist" id="album-artist" class="input-outline" placeholder="Album Artist" value="<?= $data['album']['album_artist'] ?>" required>
            </div>
            <div class="form-group">
                <label for="album-release-date">Release Date</label>
                <input type="date" name="release-date" id="album-release-date" class="input-outline" placeholder="Album Release Date" value="<?= $data['album']['tanggal_terbit'] ?>" required>
            </div>
            <div class="form-group">
                <label for="album-genre">Genre</label>
                <input type="text" name="genre" id="album-genre" class="input-outline" placeholder="Album Genre" value="<?= $data['album']['genre'] ?>" required>
            </div>
            <div class="form-group">
                <label for="album-image">Cover</label>
                <input type="file" name="album-image" id="album-image" accept=".jpg, .jpeg, .png" class="form-control">
            </div>
            <div class="album-actions">
                <button type="submit" class="button-solid">Save</button>
                <button type="button" class="button-outline" onclick="window.location.href='<?= BASE_URL ?>/album/detail/<?=$data['album']['album_id']?>'">Cancel</button>
            </div>
        </form>
    </div>
<?php } else { ?>
    <h1>404 Not Found</h1>
<?php } ?>