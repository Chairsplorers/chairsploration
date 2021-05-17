<?php
if(isset($_COOKIE['username'])){
	$cid = $_GET['cid'];
	$imgid = $_GET['imgid'];
	$remove = $_GET['remove'];
	$user = $_COOKIE['username'];

	$dbserver = "spring-2021.cs.utexas.edu";
	$dbuser = "cs329e_bulko_wsale";
	$dbpwd = "Offend_German-might";
	$dbName = "cs329e_bulko_wsale";
	$mysqli = new mysqli ($dbserver,$dbuser,$dbpwd,$dbName);

	if ($mysqli->connect_errno) {
		die('Connect Error: ' . $mysqli->connect_errno .": " . $mysqli->connect_error);
	}

	$command = sprintf("SELECT * FROM cimg WHERE cid=%s AND imgid=%s;",$mysqli->real_escape_string($cid),$mysqli->real_escape_string($imgid));
	$result = $mysqli -> query($command);
	if (!$result) {echo "Failed.";}

	if ($result->num_rows>0){
		if($remove == 0){
			$command = "UPDATE cimg SET rate=rate+1 WHERE cid = $cid AND imgid = $imgid;";
			$result = $mysqli -> query($command);
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
			
			$command = "INSERT INTO imgrates (cid,imgid,rater) VALUES ($cid,$imgid,'$user');";
			$result = $mysqli -> query($command);
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		}
		else if($remove == 1){
			$command = "UPDATE cimg SET rate=rate-1 WHERE cid = $cid AND imgid = $imgid;";
			$result = $mysqli -> query($command);
			if (!$result) {echo "Failed.";}
			
			$command = "DELETE FROM imgrates WHERE cid = $cid AND imgid=$imgid AND rater='$user';";
			$result = $mysqli -> query($command);
			if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
		}
	}
}


?>