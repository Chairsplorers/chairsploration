<?php
error_reporting(E_ALL);
ini_set("display_errors", "on");

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

$newmaxcid = $result->fetch_assoc()['MAX(cid)']+1;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false) {
	echo "File is an image - " . $check["mime"] . ". <br>";
	$uploadOk = 1;
} else {
	echo "File is not an image. <br>";
	$uploadOk = 0;
}
  
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2048000) {
  echo "Sorry, your file is too large. <br>";
  $uploadOk = 0;
}

echo "Image type: $imageFileType <br>";

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. <br>";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded. <br>";
}

if(isset($_POST['name']) and isset($_POST['desc']) and isset($_POST['loc']) and $uploadOk){
	$name = $_POST['name'];
	$description = $_POST['desc'];
	$loc = $_POST['loc'];
	$user = $_COOKIE['username'];
	
	$command = "SELECT MAX(cid) FROM chairs;";
	$result = $mysqli -> query($command);
	if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
	
	$newmaxcid = $result->fetch_assoc()['MAX(cid)']+1;
	echo $newmaxcid;
	
	$command = sprintf("INSERT INTO chairs (cid,name,description,loc,nusers,sum,avg,wavg,user) VALUES ($newmaxcid,'%s','%s','%s',0,0,0,0,'$user')",$mysqli->real_escape_string($name),$mysqli->real_escape_string($description),$mysqli->real_escape_string($loc));
	$result = $mysqli -> query($command);
	if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
	
	$target_dir = "uploads/";
	$target_file = $target_dir . "c".$newmaxcid."i1.".$imageFileType;

	echo "$target_file <br>";

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
		$command = "INSERT INTO cimg (cid,imgid,filetype,upuser,rate,modapp) VALUES ($newmaxcid,1,'$imageFileType','$user',0,0);";
		$result = $mysqli -> query($command);
		if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
	
	header ("Location: ./chair.php?cid=$newmaxcid");
}
else{
	//header ("Location: ./newchair.php");
}

?>