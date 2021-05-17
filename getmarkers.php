<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$server = "spring-2021.cs.utexas.edu";
$user   = "cs329e_bulko_wsale";
$pwd    = "Offend_German-might";
$dbName = "cs329e_bulko_wsale";

//Connect to server
$mysqli = new mysqli($server, $user, $pwd, $dbName);

if ($mysqli->connect_errno) {
	die('Connect Error: ' . $mysqli->connect_errno . ": " .  $mysqli->connect_error);
} else {
	//echo "<code>...Connection successful</code> <br>";
}

//Select Database
$mysqli->select_db($dbName) or die($mysqli->error);

//Build Query
$query = "SELECT cid, name, loc, description, avg FROM chairs";

//Execute Query
$result = $mysqli->query($query) or die($mysqli->error);

//Result String
$retstr = "";

//append for each row returned
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$retstr .= $row['name']."^";
	$retstr .= $row['loc']."^";
	$retstr .= $row['description']."^";
	$retstr .= $row['avg']."^";
	$retstr .= $row['cid']."%";
}

//Assume this is responsetext
echo $retstr;
?>
