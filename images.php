<?php
$dbserver = "spring-2021.cs.utexas.edu";
$dbuser = "cs329e_bulko_wsale";
$dbpwd = "Offend_German-might";
$dbName = "cs329e_bulko_wsale";
$mysqli = new mysqli ($dbserver,$dbuser,$dbpwd,$dbName);

$user = $_COOKIE['username'];

if ($mysqli->connect_errno) {
	die('Connect Error: ' . $mysqli->connect_errno .": " . $mysqli->connect_error);
}

$cid=0;
if(isset($_GET['cid'])){
	$cid = $_GET['cid'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/jpg" href="logo.jpg"/>
		<script src="./navbar.js"></script>
		<script src="./imgrate.js"></script>
		
		<style>
			.imagesheading{
				margin-top: 2em;
				margin-bottom: 1em;
				border: 2em solid;
				border-color: #b0a1b9;
				background-color: #f5dfe6;
				padding: 2em;
			}
			.imagesheading h1{
				font-family: "Merriweather", "Lato", Helvetica, sans-serif;
				text-align: center;
				margin: 0;
			}
			.row {
				display: flex;
			}

			.column {
				flex: 25%;
				border: 1em solid #b0a1b9;
				background-color: #f5dfe6;
				padding: 1em;
				padding-bottom: 0;
				margin: 1em;
				display: flex;
				flex-direction: column;
				justify-content: flex-start;
			}
			.column .link{
				width: 100%;
				text-align:center;
				font-size: 1.2em;
				font-family: "Merriweather", "Lato",Helvetica, sans-serif;
				font-weight: bold;
			}
			@media (min-width: 1000px){
				.column .link{
					font-size: 1.5em;
				}
			}
			.column .link a{
				color: #5253c8;
			}
			.column .img{
				flex: 1 1 auto;
				display: flex;
				flex-direction: column;
				justify-content: center;
			}
			.column .cimg {
				margin-top: 8px;
				width: 100%;
			}
			.column .heart{
				position: relative;
				width: 2em;
				height: 2em;
				top: -2.5em;
				left: 0.5em;
				cursor:pointer;
			}
			
			.link {
				font-family: "Merriweather","Lato", Helvetica, sans-serif;
			}	
			
		</style>
		
    </head>


    <body>
        <!--Title-->
        <div class="header">
            <div class = "image">
                <a href="./mainpage.html"><img src="./logo.jpg" alt="logo"></a>
            </div>
            <div class = "text">
                HAIRSPLORATION
            </div>
        </div>
        
        <!--Nav bar w dropdown menus-->
        <div class="navbar" id = "navbar"></div>
		
	<div class="content">
	<div class="imagesheading">
		<h1> Images </h1>
	</div>	
	<div id="ajaxDiv"></div>
	
	<?php
	if ($cid == 0){
		$command = "SELECT * FROM cimg ORDER BY rate DESC, imgid, cid;";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
	}
	else{
		$command = sprintf("SELECT * FROM cimg WHERE cid=%s ORDER BY rate DESC, imgid, cid;",$mysqli->real_escape_string($cid));
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
	}
	
	print "<div class ='row'>";
	$img = 1;
	while($row = $result->fetch_assoc() and $img<21){
		$cid = $row['cid'];
		$imgid = $row['imgid'];
		$filetype = $row['filetype'];
		
		$command2 = "SELECT name FROM chairs WHERE cid=$cid;";
		$result2 = $mysqli -> query($command2);
		if (!$result2) {die("Query failed: ($mysqli->error <br> SQL command2= $command2 <br> $img");}
		$name = $result2->fetch_assoc()['name'];
		
		$command2 = "SELECT * FROM imgrates WHERE cid=$cid AND imgid=$imgid AND rater='$user';";
		$result2 = $mysqli -> query($command2);
		if (!$result2) {die("Query failed: ($mysqli->error <br> SQL command2= $command2 <br> $img");}
		
		$imgfn = "c".$cid."i".$imgid;
		$imgurl = "./chairs/$cid/$imgfn.$filetype";
		
		if($result2->num_rows == 0){
			print <<<IMAGE
				<div class = "column">
					<div class="link"><a href="./chairs/chair.php?cid=$cid">$name</a></div>
					<script>addSet($cid,$imgid,0);</script>
					<div class = "img" onmouseover="dispHeart($cid,$imgid)" onmouseleave="hideHeart($cid,$imgid)">
					<img src="$imgurl" class = "cimg">
					<img src="./empheart.png" class = "heart" id="$imgfn" onmouseover="changeRate($cid,$imgid)" onmouseleave="resetRate($cid,$imgid)" onclick = "toggleSet($cid,$imgid)" style="visibility:hidden;">
					</div>
				</div>
IMAGE;
		}
		else{
			print <<<IMAGE
				<div class = "column">
					<div class="link"><a href="./chairs/chair.php?cid=$cid">$name</a></div>
					<div class = "img" onmouseover="dispHeart($cid,$imgid)" onmouseleave="hideHeart($cid,$imgid)">
					<script>addSet($cid,$imgid,1);</script>
					<img src="$imgurl" class = "cimg">
					<img src="./fullheart.png" class = "heart" id="$imgfn" onmouseover="changeRate($cid,$imgid)" onmouseleave="resetRate($cid,$imgid)" onclick = "toggleSet($cid,$imgid)" style="visibility:visible;">
					</div>
				</div>
IMAGE;
		}
		
		if($img % 4 == 0){
			print "</div>";
			print "<div class ='row'>";
		}
		
		$img += 1;
	}
	
	print "</div>";
	
	?>
</div>
</body>	
	
</html>
