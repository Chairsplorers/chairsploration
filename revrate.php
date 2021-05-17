<?php
echo "SOCIETY: ";

$dbserver = "spring-2021.cs.utexas.edu";
$dbuser = "cs329e_bulko_wsale";
$dbpwd = "Offend_German-might";
$dbName = "cs329e_bulko_wsale";
$mysqli = new mysqli ($dbserver,$dbuser,$dbpwd,$dbName);

if ($mysqli->connect_errno) {
	die('Connect Error: ' . $mysqli->connect_errno .": " . $mysqli->connect_error);
}

$cid = $_GET['cid'];
$user = $_COOKIE['username'];
$reviewer = $_GET["rev"];

if($_GET['unhelpful']==0){
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
	
if($_GET['unhelpful']==1){
	echo "SDKFLJSLDKFJS";
	
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
?>