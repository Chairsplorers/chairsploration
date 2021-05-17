<?php
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", "on");

	$server = "spring-2021.cs.utexas.edu";
	$user = "cs329e_bulko_wsale";
	$pwd = "Offend_German-might";
	$dbName = "cs329e_bulko_wsale";

	if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
	}


	$mysqli = new mysqli ($server, $user, $pwd, $dbName);

	if ($mysqli->connect_errno) {
		die('Connect Error: ' . $mysqli->connect_errno . ": " .  $mysqli->connect_error);
	}

	$mysqli->select_db($dbName) or die($mysqli->error);

	$username = $_GET['user'];
	$email = $_GET['email'];
	$last = $_GET['last'];
	$first = $_GET['first'];

	$username = $mysqli->real_escape_string($username);
	$email = $mysqli->real_escape_string($email);
	$last = $mysqli->real_escape_string($last);
	$first = $mysqli->real_escape_string($first);

	$command = "SELECT * FROM userinfo WHERE username='$username';";
	$result = $mysqli->query($command) or die($mysqli->error);

	if ($email == "" || $last == "" || $first == ""){
		echo "Fields can not be empty.";
	}

	else if ($result->num_rows == 1) {
		$row = $result->fetch_row();

		if ($row[2] == $last && $row[3] == $first && $row[4] == $email) {
			echo "";
		}

		if ($row[2] != $last){
			$command = "UPDATE userinfo SET last='$last' WHERE username='$username';";
			$result = $mysqli->query($command) or die($mysqli->error);
			echo "Last Name has been changed.<br>";
			
		}

		if ($row[3] != $first){
			$command = "UPDATE userinfo SET first='$first' WHERE username='$username';";
			$result = $mysqli->query($command) or die($mysqli->error);
			echo "First Name has been changed.<br>";
			
		}


		if ($row[4] != $email){
			if (strpos($email, "@")){
				$command = "UPDATE userinfo SET email='$email' WHERE username='$username';";
				$result = $mysqli->query($command) or die($mysqli->error);
				echo "Email has been changed.<br>";

			} else{
				echo "Please enter a valid email address.";
			}
			
		} 
	}


?>