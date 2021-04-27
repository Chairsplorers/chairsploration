<?php
$dbserver = "spring-2021.cs.utexas.edu";
$dbuser = "cs329e_bulko_wsale";
$dbpwd = "Offend_German-might";
$dbName = "cs329e_bulko_wsale";
$mysqli = new mysqli ($dbserver,$dbuser,$dbpwd,$dbName);

if ($mysqli->connect_errno) {
	die('Connect Error: ' . $mysqli->connect_errno .": " . $mysqli->connect_error);
}

$command = "SELECT MAX(cid) FROM chairs;";
$result = $mysqli -> query($command);
if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
$max = $result->fetch_assoc()["MAX(cid)"];

$rmax = rand(1,$max);

$command = "SELECT cid FROM chairs WHERE cid >= $rmax;";
$result = $mysqli -> query($command);
if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}

$rcid = $result->fetch_assoc()["cid"];

header ("Location: ./chairs/chair.php?id=$rcid");
?>