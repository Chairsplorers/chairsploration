<?php
if (!isset ($_COOKIE['username']) || ($_COOKIE["username"] == '')) {
    $_SESSION['redir'] = "chairs/newchair.php";
    header ("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="icon" type="image/jpg" href="../logo.jpg"/>
	<script src="./newchair.js"></script>
	<link rel="stylesheet" href="./stylechair.css">
	<style>
		.ncborder{
			border: 5px solid;
			border-color: #473d4f;
			background-color: #b0a1b9;
			width: fit-content;
			max-width: 60%;
			margin: 2em auto;
			background-clip: padding-box;
		}
		.newchair{
			text-align: center;
			background-color: #f5dfe6;
			padding: 2em;
			padding-bottom: 1em;
			margin: 2em;
		}
		.newchair h2{
			margin-top: 0;
			font-family: "Merriweather", "Lato", Helvetica, sans-serif;
		}
		#newchair{
			display: flex;
			flex-direction: column;
			align-content: center;
			justify-content: center;
		}
		.ncform {
			font-family: "Merriweahter", "Lato", Helvetica, sans-serif;
			text-align: center;
		}
		.ncform tr{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			margin-bottom: 0.5em;
		}
		.ncform td{
			font-size: 1.1em;
			font-weight: bold;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		.ncform .textbox {
			flex: 0 1 auto;
			margin: 0 0.5em;
		}
		.ncform .button {
			font-family: "Open Sans", sans-serif;
			font-weight: bold;
			font-size: 0.85em;
			padding 0.25em 0.5em;
			background-color: #f5dfe6;
			color: black;
			border: 3px solid;
			border-color: #473d4f;
			border-radius: 3em;
		}
		.ncform .button:hover {
			background-color: #5253c8;
			color: #f5dfe6;
		}
	</style>
	
    </head>


   <body>
        <!--Title-->
        <div class="header">
            <div class = "image">
                <a href="../mainpage.html"><img src="../logo.jpg" alt="logo"></a>
            </div>
            <div class = "text">
                HAIRSPLORATION
            </div>
        </div>
        
        <!--Nav bar w dropdown menus-->
        <div class="navbar"> 
			<div class="dropdown">
				<a href="../images.php">
					Browse
				</a>
				<div class="dropdown-content">
					<a href="../images.php">Images</a>
					<a href="../reviews.php">Reviews</a>
					<a href="../videos.html">Videos</a>
				</div>
			</div>
			<div class="dropdown">
				<a href="../leaderboard.php">
					Leaderboard
				</a>
			</div>
			<div class="dropdown">
				<a href="../chairmap.html">
					Chair Map
				</a>
			</div>
			<div class="dropdown">
				<a href="../contact-us.php">
					About Us
				</a>
				<div class="dropdown-content">
					<a href='../contact-us.php'>Contact Us!</a>
					<a href='../site-updates.html'>Site Updates</a>
				</div>
			</div>
			<div class="searchwithbarandsettings">
			<input type = "text" class = "input" style = "margin-left:10px;">
			<input type = "button" class = "search" value = "search">
			<!-- probably a form element-->
			<button class = 'button'>
				<a href= "../randomchair.php">I&#x27m Feeling Lucky!</a>
			</button>
			<!-- button -->
			<div class="settings">
				<button class="hamb">
					<div class="ham-image">
						<img src="../hamburger.png" alt="hamburger" height="40px">
					</div>
				</button>
				<div class="dropdown-content">
					<?php
						if(isset($_COOKIE['username'])) {
							print <<<LOGIN
							<a href="../logout.php">Logout</a>
							<a href="../settings.html">Settings</a>
LOGIN;
						}else{
							print <<<LOGOUT
							<a href="../login.php">Login</a>
							<a href="../newuser.php">New User</a>
							<a href="../settings.html">Settings</a>
LOGOUT;
						}
					?>
				</div>
				</div>
			</div>
        </div>
		<div class="ncborder">
		<div class="newchair">
		<h2> New Chair </h2>	
		<form method='post' id='newchair' action='addnewchair.php' enctype="multipart/form-data">
		<table class = "ncform">
			<tr>
			<td>Chair Name:</td>
			<td style="flex-grow: 1;"><input type="text" class="textbox" name = "name"></td>
			</tr>
			<tr style="justify-content: left;">
			<td>Description:</td>
			</tr>
			<tr style="height: auto; margin: 0.5em 0;">
			<td style="flex-grow: 1;"><textarea name = "desc" rows=4></textarea></td>
			</tr>
			<tr>
			<td>Address:</td>
			<td style="flex-grow: 1;"><input class="textbox" type="text" name = "loc"></td>
			</tr>
			<tr>
			<td>Upload Image:</td>
			<td style="flex-grow: 1; margin: 0 0.5em;"><input type="file" name="fileToUpload" id="fileToUpload"></td>
			</tr>
			<tr style="margin-top: 0.75em;">
			<td><input type="submit" value = "Add New Chair" name = "newchair" class = "button"></td>
			<td><input type="reset" name="reset" value="Reset" class= "button"></td>
			</tr>
		</table>
			
			
			
		</form>
		</div>
		</div>
		
	</body>
</html>
