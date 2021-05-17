<?php
$dbserver = "spring-2021.cs.utexas.edu";
$dbuser = "cs329e_bulko_wsale";
$dbpwd = "Offend_German-might";
$dbName = "cs329e_bulko_wsale";
$mysqli = new mysqli ($dbserver,$dbuser,$dbpwd,$dbName);

if ($mysqli->connect_errno) {
	die('Connect Error: ' . $mysqli->connect_errno .": " . $mysqli->connect_error);
}

$command = "UPDATE chairs SET description = 'This location is south of the Norman Hackerman building off of W 24th street. This area is outdoors, but protected from the rain by the patio formed by the building.  There are two varieties of chairs here currently. Firstly are the rather normal looking benches with large tables. There are also large rather concrete artistic chairs in a variety of sizes which occasionally have artistic metal end-tables. This area tends to be occupied regularly as it is a central campus location.' WHERE cid=12;";
$result = $mysqli -> query($command);
if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}

?>