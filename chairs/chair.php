<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if (!isset($_GET['cid'])){
	header("Location: ../mainpage.html");
}
$cid = $_GET['cid'];

if (!isset ($_COOKIE['username']) || ($_COOKIE["username"] == '')) {
    $_SESSION['redir'] = "chairs/chair.php?cid=$cid";
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

$command = sprintf("SELECT * FROM chairs WHERE cid = %s",$mysqli->real_escape_string($cid));
$result = $mysqli -> query($command);
if (!$result) {header("Location: ../mainpage.html");}

if ($result->num_rows == 1) {
	$row = $result->fetch_assoc();
	$name = $row["name"];
	$loc = $row['loc'];
	$description = $row["description"];
}
else {
	header("Location: ../mainpage.html");
}
?>

<?php
$command = "SELECT MAX(rid) FROM crandr;";
$result = $mysqli -> query($command);
if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
$nrid = $result->fetch_assoc()["MAX(rid)"]+1;

$command = "SELECT * FROM crandr WHERE cid = $cid AND user = '$user'";
$result = $mysqli -> query($command);
if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}

if ($user != ""){
	if ($result->num_rows == 0 and (isset($_POST["rating"]) || isset($_POST["review"]))){
		$command = "INSERT INTO crandr (cid,user,rating,review,rid,revpts) VALUES ($cid,'$user',0,'',$nrid,0);";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
	}

	if (isset($_POST["rating"])){
		$rate = $_POST["ratingtxt"];
		
		$command = "SELECT rating FROM crandr WHERE cid=$cid AND user = '$user'";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		$oldrating = $result->fetch_assoc()["rating"];
		
		$command = "SELECT sum,nusers FROM chairs WHERE cid=$cid";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		$row = $result->fetch_assoc();
		$sum = $row['sum'];
		$nusers = $row['nusers'];
		
		$sum = $sum-$oldrating+$rate;
		
		if ($oldrating == 0 and $rate > 0){
			$nusers = $nusers+1;
		}
		else if ($oldrating > 0 and $rate == 0) {
			$nusers = $nusers-1;
		}
		
		$avg = 0;
		if ($nusers > 0){
			$avg = $sum/$nusers;
		}
		
		$wavg = $avg * min($nusers,10);
		
		$command = "UPDATE chairs SET sum=$sum, nusers=$nusers, avg=$avg, wavg=$wavg WHERE cid=$cid";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		
		$command = "UPDATE crandr SET rating = $rate WHERE cid = $cid AND user = '$user'";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
	}

	if (isset($_POST["review"]) && !empty($_POST['reviewtxt'])){
		$comm = $_POST["reviewtxt"];

		$command = sprintf("UPDATE crandr SET review = '%s' WHERE cid = $cid AND user = '$user'",$mysqli->real_escape_string($comm));
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		
		$command = "UPDATE crandr SET rid=$nrid WHERE cid = $cid AND user = '$user';";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
	}

	if(isset($_POST["dreview"])){
		$command = "UPDATE crandr SET review = '' WHERE cid = $cid AND user = '$user'";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
	}
	
	if(isset($_POST["helpful"])){
		$reviewer = $_POST["helpful"];
		$command = "SELECT * FROM revrates WHERE cid = $cid AND rater = '$user' AND reviewer = '$reviewer';";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		
		if ($result->num_rows == 0){
			$command = "UPDATE crandr SET revpts = revpts+1 WHERE cid = $cid AND user = '$reviewer';";
			$result = $mysqli -> query($command);
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		
			$command = "INSERT INTO revrates (cid,rater,reviewer) VALUES ($cid,'$user','$reviewer');";
			$result = $mysqli -> query($command);
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		}
	}
	
	if(isset($_POST["unhelpful"])){
		$reviewer = $_POST["unhelpful"];
		$command = "SELECT * FROM revrates WHERE cid = $cid AND rater = '$user' AND reviewer = '$reviewer';";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		
		if ($result->num_rows == 1){
			$command = "UPDATE crandr SET revpts = revpts-1 WHERE cid = $cid AND user = '$reviewer';";
			$result = $mysqli -> query($command);
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		
			$command = "DELETE FROM revrates WHERE cid=$cid AND rater = '$user' AND reviewer = '$reviewer';";
			$result = $mysqli -> query($command);
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		}
	}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="icon" type="image/jpg" href="../logo.jpg"/>
	<script src="./chairjs.js"></script>
	<script src="./imgrate.js"></script>
	<link rel="stylesheet" href="./stylechair.css">
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
							<a href="./newchair.php">Add Chair</a>
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
		
		<div class="content">
		<div class="chairinfo">
		<div class="chaircontent">
			<?php echo "<h1> $name </h1>"; ?>
			<div class = "ratings">
			<div class = "avg">
				<h4>Average score:</h4>
				
				<?php
				$command = "SELECT avg,nusers FROM chairs WHERE cid=$cid";
				$result = $mysqli -> query($command);
				if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
				$row = $result->fetch_assoc();
				$nusers = $row['nusers'];
				$avg = round($row['avg'],2);
				
				print "$avg / 10 from $nusers users.";
				
				?>
			</div>
			
			
			<div class="starrating">	
			<h4>	Rate this chair: </h4>
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
			</div>
			<?php print "<div class='ratingformdiv'><form method='post' id='review'  action='chair.php?cid=$cid'>"; ?>
				<input id="ratingform" name = "ratingtxt" type="text" value="" style = "display:none;">
				<input id="submitbutton" type = "submit" name = "rating" value = "Update Rating">
			</form>
			</div>
			
			<?php
			$command = "SELECT * FROM crandr WHERE cid = $cid AND user = '$user'";
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
			</div>
			<div class="location">
				<h3>Location:</h3>
				<?php echo "<p> $loc </p>" ?>
			</div>
			<div class = "description">
				<h3>Description:</h3>
				
				<?php echo "<p> $description </p>" ?>
			</div>

			<?php 
			$command = "SELECT user,review FROM crandr WHERE cid = $cid AND user = '$user';";
			$result = $mysqli -> query($command);	
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
			
			if($result->num_rows == 0){
				print <<<LAR
					<div id="make">
					<h3> Leave a review: </h3>
			
					<form method="post" id="review"  action="chair.php?cid=$cid">
					<input id="revtext" type="text" name="reviewtxt">
					<input id="submit" type="submit" name="review">
					
					</form>
					</div>
LAR;
			}
			else{
				$row = $result->fetch_assoc();
				$review = $row['review'];
				
				if ($review == ""){
					print <<<LAR
						<div id="make">
						<h3> Leave a review: </h3>
				
						<form method="post" id="review"  action="chair.php?cid=$cid">
						<input id="tryagaintext" type="text" name="reviewtxt">
						<input id="tryagainsubmit" type="submit" name="review">
						
						</form>
						</div>
LAR;
				}
				else{
					print <<<LAR
				
						<div id="yreview">
						<h3> Your review: </h3>
						<div class="yrev">
						<p>$review</p>
							
						<div class="buttondev"><button id="editit" onclick = "editReview()">Edit</button></div>
						</div>
						</div>
						
						<div id="edit" style = "display:none; margin-top:10px;">
							<h3>Review:</h3>
							<form method="post" id="review"  action="chair.php?cid=$cid">
							<input id="reviewtxt" type="text" name="reviewtxt" value = "$review">
							<input id="update" type="submit" name="review" value = "Update">
							<input id="delete" type="submit" name="dreview" value = "Delete">
							
							</form>
						</div>
LAR;
				}
			}
			
			?>
			</div>
			 
			<div class="chairimgs">
			<?php 
				$command = "SELECT * FROM cimg WHERE cid = $cid ORDER BY rate DESC, imgid ASC;";
				$result = $mysqli -> query($command);
				if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}	
				
				if($result->num_rows > 0){
					$row = $result->fetch_assoc();
					$imgid = $row['imgid'];
					$filetype = $row['filetype'];
					
					$command2 = "SELECT * FROM imgrates WHERE cid=$cid AND imgid=$imgid AND rater='$user';";
					$result2 = $mysqli -> query($command2);
					if (!$result2) {die("Query failed: ($mysqli->error <br> SQL command2= $command2 <br> $img");}
					
					$fid = "c$cid"."i$imgid";
					
					echo "<div class='primchairimg' ><div style = 'position: relative;'  onmouseover='HdispHeart($cid,$imgid)' onmouseleave='HhideHeart($cid,$imgid)'><img src = '$cid/$fid.$filetype' alt = 'chair'></img>";
					if ($result2->num_rows == 0){
						echo "<script>HaddSet($cid,$imgid,0);</script>";
						echo "<img src='./empheart.png' class = 'heart' id='$fid' onmouseover='HchangeRate($cid,$imgid)' onmouseleave='HresetRate($cid,$imgid)' onclick = 'HtoggleSet($cid,$imgid)' style = 'visibility:hidden;'>";
					}
					else{
						echo "<script>HaddSet($cid,$imgid,1);</script>";
						echo "<img src='./fullheart.png' class = 'heart' id='$fid' onmouseover='HchangeRate($cid,$imgid)' onmouseleave='HresetRate($cid,$imgid)' onclick = 'HtoggleSet($cid,$imgid)' style = 'visibility:visible;'>";
					}
					echo "</div></div>";
					
					if($result->num_rows > 1){
						$img = 0;
						while($row = $result->fetch_assoc() and $img < 4 ){
							$imgid = $row['imgid'];
							$filetype = $row['filetype'];
							echo "<div class='primchairimg'><div style='position:relative;' onmouseover='HdispHeart($cid,$imgid)' onmouseleave='HhideHeart($cid,$imgid)'><img src = '$cid/c$cid"."i$imgid.$filetype' alt = 'chair' min-height= 0px;></img>";
							
							$command2 = "SELECT * FROM imgrates WHERE cid=$cid AND imgid=$imgid AND rater='$user';";
							$result2 = $mysqli -> query($command2);
							if (!$result2) {die("Query failed: ($mysqli->error <br> SQL command2= $command2 <br> $img");}
							
							$fid = "c$cid"."i$imgid";
							
							if ($result2->num_rows == 0){
								echo "<script>HaddSet($cid,$imgid,0);</script>";
								echo "<img src='./empheart.png' class = 'heart' id='$fid' onmouseover='HchangeRate($cid,$imgid)' onmouseleave='HresetRate($cid,$imgid)' onclick = 'HtoggleSet($cid,$imgid)' style = 'visibility:hidden;'>";
							}
							else{
								echo "<script>HaddSet($cid,$imgid,1);</script>";
								echo "<img src='./fullheart.png' class = 'heart' id='$fid' onmouseover='HchangeRate($cid,$imgid)' onmouseleave='HresetRate($cid,$imgid)' onclick = 'HtoggleSet($cid,$imgid)' style = 'visibility:visible;'>";
							}
							echo "</div></div>";	
							$img = $img+1;
					}
					}}
			?>
			</div>
			</div>

			<div class="reviewsheading">
			<h1>Reviews</h1>
        		</div>
			<?php
			$command = "SELECT * FROM crandr WHERE cid = $cid ORDER BY revpts DESC, rid;";
			$result = $mysqli -> query($command);	
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
			
			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc()) {
					$reviewer = $row['user'];
					$review = $row['review'];
					$revpts = $row['revpts'];
					$rating = $row['rating'];
					if ($review != ""){
						echo "<div class = 'dispreview' style = 'margin-top: 10px;'> <h2>$reviewer</h2>";

						if($rating>0){
							echo "<p><b>Score:</b> $rating/10</p>";
						}

						echo "<p>$review</p><div class = 'helpfulness'> <div class = 'reviewscore'>$revpts people have found this review helpful.</div>";
						
						if($reviewer != $user){
							$command = "SELECT * FROM revrates WHERE cid = $cid AND reviewer = '$reviewer' AND rater = '$user';";
							$resultrev = $mysqli -> query($command);	
							if (!$resultrev) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
							
							if($resultrev -> num_rows == 0){
								echo "<form method='post' id='helpful' class = 'revbuttonform' action='chair.php?cid=$cid'><button name='helpful' class = 'revbutton' value='$reviewer'>Mark as helpful</button></form> ";
							}
							else{
								echo "<form method='post' id='unhelpful' class = 'revbuttonform' action='chair.php?cid=$cid'><button name='unhelpful' value='$reviewer' class = 'revbutton'>Unmark as helpful</button></form> ";
							}
						}
						echo "</div></div>";
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
