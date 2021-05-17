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

	$username = $mysqli->real_escape_string($username);
	$password = $mysqli->real_escape_string($password);

	$command = "SELECT * FROM userinfo WHERE username='$username';";
	$result = $mysqli->query($command) or die($mysqli->error);

	if ($username == "" || $password == ""){
		echo "Please provide a username and a password.";
	}

	else if ($result->num_rows == 1) {
		$row = $result->fetch_row();

		if ($row[1] != $password) {
			echo "Login failed. Username does not exist or incorrect password.";
		} else {
			$time = 12000;
			setcookie('username', $username, time()+$time);
			echo $_SESSION['redir'];
		}
	} else {
		echo "Login failed. Username does not exist or incorrect password.";
	}


?>
