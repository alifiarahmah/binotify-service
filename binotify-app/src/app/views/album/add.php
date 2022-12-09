<?php if ($_SESSION['isAdmin']) { ?>
    <h1>Add Album</h1>
    <div class="form-container">
        <form action="<?= BASE_URL ?>/album/submit" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="album-title">Title</label>
                <input type="text" name="album-title" id="album-title" class="input-outline" placeholder="Album Title" required>
            </div>
            <div class="form-group">
                <label for="album-artist">Artist</label>
                <input type="text" name="album-artist" id="album-artist" class="input-outline" placeholder="Album Artist" required>
            </div>
            <div class="form-group">
                <label for="album-release-date">Release Date</label>
                <input type="date" name="tanggal-terbit" id="album-release-date" class="input-outline" placeholder="Album Release Date" required>
            </div>
            <div class="form-group">
                <label for="album-genre">Genre</label>
                <input type="text" name="genre" id="album-genre" class="input-outline" placeholder="Album Genre" required>
            </div>
            <div class="form-group">
                <label for="album-image">Image</label>
                <input type="file" name="album-image" id="album-image" class="form-control" accept=".jpg, .jpeg, .png" required>
            </div>
            <div class="album-actions">
                <button type="submit" class="button-solid">Submit</button>
                <button type="button" class="button-outline" onclick="window.location.href='<?= BASE_URL ?>/album/1'">Cancel</button>
            </div>
        </form>
    </div>
<?php } else { ?>
    <h1>404 Not Found</h1>
<?php } ?>