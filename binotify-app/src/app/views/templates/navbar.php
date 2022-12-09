<div class="navbar-container">
	<div class="navbar-group">
		<button id="drawer-button" class="icon-button-outline" onclick="showDrawer()">
			<svg width="28" height="18" viewBox="0 0 28 18" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M0.5 18H27.5V15H0.5V18ZM0.5 10.5H27.5V7.5H0.5V10.5ZM0.5 0V3H27.5V0H0.5Z" fill="#FFFFFF" />
			</svg>
		</button>
		<a href="<?= BASE_URL ?>/">
			<h1 class="desktop-only" id="logo">binotify</h1>
		</a>
		<form method="post" id="search-bar-container" class="search-bar-container" action="<?= BASE_URL ?>/search">
			<div id="search-bar" class="input-solid search-bar">
				<svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M20.5417 18.1667H19.2908L18.8475 17.7392C20.3992 15.9342 21.3333 13.5908 21.3333 11.0417C21.3333 5.3575 16.7258 0.75 11.0417 0.75C5.3575 0.75 0.75 5.3575 0.75 11.0417C0.75 16.7258 5.3575 21.3333 11.0417 21.3333C13.5908 21.3333 15.9342 20.3992 17.7392 18.8475L18.1667 19.2908V20.5417L26.0833 28.4425L28.4425 26.0833L20.5417 18.1667ZM11.0417 18.1667C7.09917 18.1667 3.91667 14.9842 3.91667 11.0417C3.91667 7.09917 7.09917 3.91667 11.0417 3.91667C14.9842 3.91667 18.1667 7.09917 18.1667 11.0417C18.1667 14.9842 14.9842 18.1667 11.0417 18.1667Z" fill="#1E1F22" />
				</svg>
				<input id="search-keyword" name="search_keyword" onkeyup="changeSearchAction()" />
			</div>
			<input type="submit">
		</form>
	</div>

	<div class="navbar-group">
		<?php
		if (!isset($_SESSION['username'])) {
		?>
		<div class="auth">
			<a href="<?= BASE_URL ?>/login">
				<button class="button-outline">log in</button>
			</a>
			<a href="<?= BASE_URL ?>/register">
				<button class="button-solid">sign up</button>
			</a>
			<!-- <button class="button-solid">log out</button> -->
		</div>
		<?php
		} else {
		?>
		<div class="auth">
			<?php if ($_SESSION['isAdmin']) { ?>
				<p class="greetings">Hello, <?= $_SESSION['username'] ?></p>
				<a href="<?= BASE_URL ?>/song/add">
					<button class="button-solid">add song</button>
				</a>
				<a href="<?= BASE_URL ?>/album/add">
					<button class="button-solid">add album</button>
				</a>
				<a href="<?= BASE_URL ?>/admin">
					<button class="button-solid">admin page</button>
				</a>
			<?php } else { ?>
				<p class="greetings">Hello, <?= $_SESSION['username'] ?></p>
				<a href="<?= BASE_URL ?>/user">
					<button class="button-solid">profile</button>
				</a>
				<a href="<?= BASE_URL ?>/logout">
					<button class="button-solid">log out</button>
				</a>
			<?php } ?>
		</div>
		<?php
		}
		?>
		<button id="close-search" onClick="hideSearch()">
			<svg width="29" height="29" viewBox="0 0 29 29" xmlns="http://www.w3.org/2000/svg">
				<path d="M29 2.92071L26.0793 0L14.5 11.5793L2.92071 0L0 2.92071L11.5793 14.5L0 26.0793L2.92071 29L14.5 17.4207L26.0793 29L29 26.0793L17.4207 14.5L29 2.92071Z" fill="white" />
			</svg>
		</button>
	</div>


</div>

<!-- Drawer -->
<div id="drawer">
	<div class="drawer-close-container">
		<button id="drawer-close" onclick="closeDrawer()" class="icon-button">
			<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
				<path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z" />
			</svg>
		</button>
	</div>

	<div class="drawer-body">
		<h1 id="logo">binotify</h1>
		<?php
		if (!isset($_SESSION['username'])) {
		?>
			<a href="<?= BASE_URL ?>/login">
				<button class="button-outline">log in</button>
			</a>
			<a href="<?= BASE_URL ?>/register">
				<button class="button-solid">sign up</button>
			</a>
		<?php
		} else {
		?>
			<p>Hello, <?= $_SESSION['username'] ?></p>
			<a href="<?= BASE_URL ?>/user">
				<button class="button-solid">profile</button>
			</a>
			<a href="<?= BASE_URL ?>/logout">
				<button class="button-solid">log out</button>
			</a>
			<?php
			if ($_SESSION['isAdmin']) {
			?>
			<a href="<?= BASE_URL ?>/admin">
				<button class="button-solid">admin page</button>
			</a>
			<?php
			}
			?>
		<?php
		}
		?>
	</div>
</div>