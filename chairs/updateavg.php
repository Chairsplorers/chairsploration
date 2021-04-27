<?php
$dbserver = "spring-2021.cs.utexas.edu";
$dbuser = "cs329e_bulko_wsale";
$dbpwd = "Offend_German-might";
$dbName = "cs329e_bulko_wsale";
$mysqli = new mysqli ($dbserver,$dbuser,$dbpwd,$dbName);

if ($mysqli->connect_errno) {
	die('Connect Error: ' . $mysqli->connect_errno .": " . $mysqli->connect_error);
}

$command = "SELECT cid FROM chairs;";
$result = $mysqli -> query($command);
if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}

while($row = $result->fetch_assoc()) {
	$cid = $row['cid'];
	
	$command2 = "SELECT rating FROM crandr WHERE cid = $cid AND rating > 0;";
	$result2 = $mysqli -> query($command2);
	if (!$result2) {die("Query failed: ($mysqli->error <br> SQL command= $command2");}
	
	$nusers = $result2->num_rows;
	
	
	
	$command3 = "SELECT SUM(rating) FROM crandr WHERE cid=$cid";
	$result3 = $mysqli -> query($command3);
	if (!$result3) {die("Query failed: ($mysqli->error <br> SQL command= $command3");}
	
	$total = $result3->fetch_assoc()["SUM(rating)"];
	if(empty($total)){$total = 0;}
	
	$avg = 0;
	if ($nusers >0){
		$avg = $total/$nusers;
	}
	
	$wavg = $avg*min($nusers,10);
	
	$command3 = "UPDATE chairs SET nusers = $nusers, sum = $total, avg = $avg, wavg=$wavg WHERE cid = $cid";
	$result3 = $mysqli -> query($command3);
	if (!$result3) {die("Query failed: ($mysqli->error <br> SQL command= $command3");}
}

?>