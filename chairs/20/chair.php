<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if (!isset ($_COOKIE['username']) || ($_COOKIE["username"] == '')) {
    $_SESSION['redir'] = "chairs/20/chair.php";
    header ("Location: ../../login.php");
}
?>

<?php

if (isset($_POST["comment"]) && !empty($_POST['commenttxt']) && $_POST["commenttxt"] != $_COOKIE["lastcomment"]){
	$user = $_COOKIE["username"];
	$comm = $_POST["commenttxt"];
	$file = fopen("comments.txt", "a");
	fwrite($file, "$user:$comm\n");
	fclose($file);
	setcookie('lastcomment', $comm);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="../../style.css">
        <link rel="icon" type="image/jpg" href="../../logo.jpg"/>
		<script src="rating.js"></script>
		<style type = text/css>
			div.chairimg {width:30%; float:right; margin-right:50px; margin-top:10px;text-align:center;padding:10px;}
			div.content{height:500px}
			img.star{width:30px;}
		</style>
    </head>


    <body>
        <!--Title-->
        <div class="header">
            <div class = "image">
                <a href="../../mainpage.html"><img src="../../logo.jpg" alt="logo"></a>
            </div>
            <div class = "text">
                HAIRSPLORATION
            </div>
        </div>
        
        <!--Nav bar w dropdown menus-->
        <div class="navbar"> 
            <div class="dropdown">
                <a href="../../reviews.html"><button class="dropbtn">
                    Reviews
                </button></a>
                <div class="dropdown-content">
                    <a href="../../reviews.html">Reviews</a>
                    <a href="../../videos.html">Videos</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">
                    Superlatives
                </button>
                <div class="dropdown-content">
                    <a href="../../art.html">Art</a>
                    <a href="../../leaderboard.html">Leaderboard</a>
                </div>
            </div>
			<div class="dropdown">
				<a href="../../chairmap.html"><button class="dropbtn">
					Chair Map
				</button></a>
			</div>
            <div class="dropdown">
                <a href="../../contact-us.html"><button class="dropbtn">
					About Us
                </button></a>
                <div class="dropdown-content">
                    <a href='../../contact-us.html'>Contact Us!</a>
                    <a href='../../site-updates.html'>Site Updates</a>
                </div>
            </div>
            <input type = "text" class = "input" style = "margin-left:10px;">
            <input type = "button" class = "search" value = "search">
            <!-- probably a form element-->
            <input type='button' class='button' value='I&#x27m Feeling Lucky!'>
            <!-- button -->
            <div class="settings">
                <button class="hamb">
                    <div class="ham-image">
                        <img src="../../hamburger.png" alt="hamburger" height="40px">
                    </div>
                </button>
                <div class="dropdown-content">
                    <a href="../../login.php">Login</a>
                    <a href="../../newuser.php">New User</a>
                    <a href="../../settings.html">Settings</a>
                </div>
            </div>
        </div>

		<?php
			$f = fopen("name.txt",'r');
			$name = fgets($f);
			fclose($f);
			
			echo "<h1 align=\"center\"> $name </h1>";
		?>

		<div class = "chairimg">
			<img src = "mainimg.jpg" alt = "chair" width = 90%></img>	
			<p>The chair.</p>
		</div>
		
		<div class="content">
			<h3>Description:</h3>
			
			<p> [Description] </p>
			
			<h3>	Rate this chair: <h3>
			<div id="ratingbar" onmouseleave="resetRate()"  onclick="setRate()">
				<img id="1" class = "star" onmouseover="changeRate(1)">
				<img id="2" class = "star" onmouseover="changeRate(2)">
				<img id="3" class = "star" onmouseover="changeRate(3)">
				<img id="4" class = "star" onmouseover="changeRate(4)">
				<img id="5" class = "star" onmouseover="changeRate(5)">
				<img id="6" class = "star" onmouseover="changeRate(6)">
				<img id="7" class = "star" onmouseover="changeRate(7)">
				<img id="8" class = "star" onmouseover="changeRate(8)">
				<img id="9" class = "star" onmouseover="changeRate(9)">
				<img id="10" class = "star" onmouseover="changeRate(10)">
				<k id="rating"></k>/10
			</div>
		
			<h3> Leave a comment: </h3>
			
			<form method="post" id="comment"  action="samplechair.php">
			Comment:
			<br>
			<input type="text" name="commenttxt">
			<br>
			<br>
			<input type="submit" name="comment">
			<br>
			
			</form>
			
			<p><h4>Comments</h4></p>
        
			<?php

			$login_file = file("comments.txt", FILE_IGNORE_NEW_LINES);

			foreach ($login_file as $line) {
				$line_arr = explode(":", $line);
				echo "<p>$line_arr[0] said $line_arr[1]</p>\n";
			}

			?>
		
        </div>

        <div class="footer" >
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>

    </body>
</html>