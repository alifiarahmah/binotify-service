var drawer = document.getElementById("drawer");

function showDrawer() {
	drawer.style.animationName = "slideIn";
	drawer.style.display = "block";
}

function closeDrawer() {
	drawer.style.display = "none";
}
