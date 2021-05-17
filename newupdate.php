<?php
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", "on");


	if (!isset($_SESSION['redir'])){
		$_SESSION['redir'] = "mainpage.html";
	}

	$server = "spring-2021.cs.utexas.edu";
	$user = "cs329e_bulko_wsale";
	$pwd = "Offend_German-might";
	$dbName = "cs329e_bulko_wsale";

	$mysqli = new mysqli ($server, $user, $pwd, $dbName);

	if ($mysqli->connect_errno) {
		die('Connect Error: ' . $mysqli->connect_errno . ": " .  $mysqli->connect_error);
	}

	$mysqli->select_db($dbName) or die($mysqli->error);

	$username = $_GET['user'];
	$password = $_GET['pass'];
	$first    = $_GET['first'];
	$last     = $_GET['last'];
	$email    = $_GET['email'];

	$username = $mysqli->real_escape_string($username);
	$password = $mysqli->real_escape_string($password);
	$first    = $mysqli->real_escape_string($first);
	$last     = $mysqli->real_escape_string($last);
	$email    = $mysqli->real_escape_string($email);

	$command = "SELECT * FROM userinfo WHERE username='$username';";
	$result = $mysqli->query($command) or die($mysqli->error);

	if ($result->num_rows > 0) {
		$row = $result->fetch_row();

		if ($row[0] == $username) {
			echo "That username has already been taken. Please try a different one.";
		}
	} else {
		$command = "INSERT INTO userinfo VALUES ('$username', '$password', '$last', '$first', '$email');";
		$result = $mysqli->query($command) or die($mysqli->error);
		echo "New user registered. Please Login in order to continue using our Website.";
	}

?>