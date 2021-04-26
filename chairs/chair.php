<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if (!isset($_GET['id'])){
	header("Location: ../mainpage.html");
}
$id = $_GET['id'];

if (!isset ($_COOKIE['username']) || ($_COOKIE["username"] == '')) {
    $_SESSION['redir'] = "chairs/chair.php?id=$id";
    header ("Location: ../login.php");
}
$user = $_COOKIE['username'];

$dbserver = "spring-2021.cs.utexas.edu";
$dbuser = "cs329e_bulko_wsale";
$dbpwd = "Offend_German-might";
$dbName = "cs329e_bulko_wsale";
$mysqli = new mysqli ($dbserver,$dbuser,$dbpwd,$dbName);

if ($mysqli->connect_errno) {
	die('Connect Error: ' . $mysqli->connect_errno .": " . $mysqli->connect_error);
}



$command = "SELECT * FROM chairs WHERE cid = $id";
$result = $mysqli -> query($command);
if (!$result) {header("Location: ../mainpage.html");}

if ($result->num_rows == 1) {
	$row = $result->fetch_assoc();
	$name = $row["name"];
	$description = $row["description"];
}
else {
	header("Location: ../mainpage.html");
}
?>

<?php
$command = "SELECT * FROM crandr WHERE cid = $id AND user = '$user'";
$result = $mysqli -> query($command);
if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}

if ($result->num_rows == 0 and (isset($_POST["rating"]) || isset($_POST["review"]))){
	$command = "INSERT INTO crandr (cid,user,rating,review) VALUES ($id,'$user',0,'');";
	$result = $mysqli -> query($command);
	if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
}

if (isset($_POST["rating"])){
	$rate = $_POST["ratingtxt"];
	
	$command = "UPDATE crandr SET rating = $rate WHERE cid = $id AND user = '$user'";
	$result = $mysqli -> query($command);
	if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
}

if (isset($_POST["review"]) && !empty($_POST['reviewtxt'])){
	$comm = $_POST["reviewtxt"];

	$command = sprintf("UPDATE crandr SET review = '%s' WHERE cid = $id AND user = '$user'",$mysqli->real_escape_string($comm));
	$result = $mysqli -> query($command);
	if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}

}

if(isset($_POST["dreview"])){
	$command = "UPDATE crandr SET review = '' WHERE cid = $id AND user = '$user'";
	$result = $mysqli -> query($command);
	if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="icon" type="image/jpg" href="../logo.jpg"/>
		<script src="./chairjs.js"></script>
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
                <a href="../mainpage.html"><img src="../logo.jpg" alt="logo"></a>
            </div>
            <div class = "text">
                HAIRSPLORATION
            </div>
        </div>
        
        <!--Nav bar w dropdown menus-->
        <div class="navbar"> 
            <div class="dropdown">
                <a href="../reviews.html"><button class="dropbtn">
                    Reviews
                </button></a>
                <div class="dropdown-content">
                    <a href="../reviews.html">Reviews</a>
                    <a href="../videos.html">Videos</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">
                    Superlatives
                </button>
                <div class="dropdown-content">
                    <a href="../art.html">Art</a>
                    <a href="../leaderboard.html">Leaderboard</a>
                </div>
            </div>
			<div class="dropdown">
				<a href="../chairmap.html"><button class="dropbtn">
					Chair Map
				</button></a>
			</div>
            <div class="dropdown">
                <a href="../contact-us.html"><button class="dropbtn">
					About Us
                </button></a>
                <div class="dropdown-content">
                    <a href='../contact-us.html'>Contact Us!</a>
                    <a href='../site-updates.html'>Site Updates</a>
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
                        <img src="../hamburger.png" alt="hamburger" height="40px">
                    </div>
                </button>
                <div class="dropdown-content">
                    <a href="../login.php">Login</a>
                    <a href="../newuser.php">New User</a>
                    <a href="../settings.html">Settings</a>
                </div>
            </div>
        </div>

		<?php echo "<h1 align=\"center\"> $name </h1>"; ?>

		<div class = "chairimg">
			<?php echo "<img src = '$id/mainimg.jpg' alt = 'chair' width = 90%></img>"; ?>
			<p>The chair.</p>
		</div>
		
		<div class="content">
			<h3>Description:</h3>
			
			<?php echo "<p> $description </p>" ?>
			
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
			
			<?php print "<form method='post' id='review'  action='chair.php?id=$id'>"; ?>
				<input id="ratingform" name = "ratingtxt" type="text" value="" style = "display:none;">
				<input type = "submit" name = "rating" value = "Update Rating">
			</form>
			
			<?php
			$command = "SELECT * FROM crandr WHERE cid = $id AND user = '$user'";
			$result = $mysqli -> query($command);
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}			
			
			if($result->num_rows == 1){
				$row = $result->fetch_assoc();
				$rating = $row['rating'];
				if($rating>0){
					print <<<SETRATE
						<script>
						changeRate($rating);
						setRate();
						</script>
SETRATE;
				}
			}
			?>
			
			<?php 
			$command = "SELECT user,review FROM crandr WHERE cid = $id AND user = '$user';";
			$result = $mysqli -> query($command);	
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
			
			if($result->num_rows == 0){
				print <<<LAR
					<h3> Leave a review: </h3>
			
					<form method="post" id="review"  action="chair.php?id=$id">
					Review:
					<br>
					<input type="text" name="reviewtxt">
					<br>
					<br>
					<input type="submit" name="review">
					<br>
					
					</form>
LAR;
			}
			else{
				$row = $result->fetch_assoc();
				$review = $row['review'];
				
				if ($review == ""){
					print <<<LAR
						<h3> Leave a review: </h3>
				
						<form method="post" id="review"  action="chair.php?id=$id">
						Review:
						<br>
						<input type="text" name="reviewtxt">
						<br>
						<br>
						<input type="submit" name="review">
						<br>
						
						</form>
LAR;
				}
				else{
					print <<<LAR
						<h3> Your review: </h3>
				
						<div id="yreview">
							$review
							
							<br><br>
							
							<button onclick = "editReview()">Edit</button>
						</div>
						
						<div id="edit" style = "display:none; margin-top:10px;">
							<form method="post" id="review"  action="chair.php?id=$id">
							Review:
							<br>
							<input type="text" name="reviewtxt" value = "$review">
							<br>
							<br>
							<input type="submit" name="review" value = "Update">
							<input type="submit" name="dreview" value = "Delete">
							<br>
							
							</form>
						</div>
LAR;
				}
			}
			
			?>
			
			<p><h4>Reviews</h4></p>
        
			<?php
			$command = "SELECT user,review FROM crandr WHERE cid = $id";
			$result = $mysqli -> query($command);	
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
			
			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc()) {
					$user = $row['user'];
					$review = $row['review'];
					if ($review != ""){
						echo "<div class = 'review'>$user <br><br> $review</div>\n";
					}
				}
			}
			?>
		
        </div>

        <div class="footer" >
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>

    </body>
</html>