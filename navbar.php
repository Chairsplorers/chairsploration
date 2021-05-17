<div class="dropdown">
	<p>
		Browse
	</p>
	<div class="dropdown-content">
		<a href="./images.php">Images</a>
		<a href="./reviews.php">Reviews</a>
		<a href="./videos.html">Videos</a>
		<a href="./discover.html">Discover</a>
	</div>
</div>
<div class="dropdown">
	<a href="./leaderboard.php">
		Leaderboard
	</a>
</div>
<div class="dropdown">
	<a href="./chairmap.html">
		Chair Map
	</a>
</div>
<div class="dropdown">
	<a href="./contact-us.php">
		About Us
	</a>
</div>
<div class="searchwithbarandsettings">
<!-- probably a form element-->
<button class = 'button'><a href = "./randomchair.php">I&#x27m Feeling Lucky!</a></button>
<!-- button -->
<div class="settings">
	<button class="hamb">
		<div class="ham-image">
			<img src="./hamburger.png" alt="hamburger" height="40px">
		</div>
	</button>
	<div class="dropdown-content">
		<?php
			if(isset($_COOKIE['username'])) {
				print <<<LOGIN
				<a href="./logout.php">Logout</a>
				<a href="./settings.php">Settings</a>
				<a href="./chairs/newchair.php">Add Chair</a>
LOGIN;
			}else{
				print <<<LOGOUT
				<a href="./login.php">Login</a>
				<a href="./newuser.php">New User</a>
LOGOUT;
			}
		?>
	</div>
	</div>
</div>
