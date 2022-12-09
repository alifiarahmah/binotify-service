<div>
    <h1>
        Welcome to Admin Dashboard page, 
        <?php
        echo $_SESSION['username'];
        ?>
    </h1>
    <div class="admin-button-container">
        <a href="<?php echo BASE_URL; ?>/admin/users">
            <svg width="80" height="56" viewBox="0 0 80 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M58 28C63.52 28 67.96 23.52 67.96 18C67.96 12.48 63.52 8 58 8C52.48 8 48 12.48 48 18C48 23.52 52.48 28 58 28ZM28 24C34.64 24 39.96 18.64 39.96 12C39.96 5.36 34.64 0 28 0C21.36 0 16 5.36 16 12C16 18.64 21.36 24 28 24ZM58 36C50.68 36 36 39.68 36 47V56H80V47C80 39.68 65.32 36 58 36ZM28 32C18.68 32 0 36.68 0 46V56H28V47C28 43.6 29.32 37.64 37.48 33.12C34 32.4 30.64 32 28 32Z" fill="#FFDD3C"/>
            </svg>
            <div>Daftar User</div>
        </a>
    </div>
    <button class="button-outline" onclick="window.location.href='<?php echo BASE_URL; ?>/logout'">Log Out</button>
</div>