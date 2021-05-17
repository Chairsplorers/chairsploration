<?php
$dbserver = "spring-2021.cs.utexas.edu";
$dbuser = "cs329e_bulko_wsale";
$dbpwd = "Offend_German-might";
$dbName = "cs329e_bulko_wsale";
$mysqli = new mysqli ($dbserver,$dbuser,$dbpwd,$dbName);

if ($mysqli->connect_errno) {
	die('Connect Error: ' . $mysqli->connect_errno .": " . $mysqli->connect_error);
}

if(isset($_POST['contus']) && !($_POST['conttext'] == "")){
	$user = '';
	if(isset($_COOKIE['username'])){
		$user = $_COOKIE['username'];
	}
	$email = $_POST['email'];
	$text = $_POST['conttext'];
	
	$command = sprintf("INSERT INTO cfeedback (user,email,fb) VALUES ('$user','%s','%s');",$mysqli->real_escape_string($email),$mysqli->real_escape_string($text));
	$result = $mysqli -> query($command);
	if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/jpg" href="logo.jpg"/>
		<script src="./navbar.js"></script>
<style>
.contentsectionborder {
	border: 5px solid;
	border-color: #473d4f;
	background-color: #b0a1b9;
	margin-top: 2em;
	margin-bottom: 2em;
	background-clip: padding-box;
}
.contentsection {
	display: grid;
	grid-template-columns: auto;
	align-content: center;
	justify-content: center;
	text-align: center;
	background-color: #f5dfe6;
	margin: 2em;
	padding-top: 1em;
	padding-bottom: 1em;
}
.contentsection h1 {
	font-family: "Merriweather", "Lato", Helvetica, sans-serif;
}
.contentsection p {
	margin-left: 5em;
	margin-right: 5em;
}
.bio {
	display: flex;
	flex-direction: row;
	background-color: #b0a1b9;
	border: 5px solid;
	border-color: #573d4f;
	margin-top: 2em;
	margin-bottom: 2em;
	text-align: center;
}
.bio h1 {
	font-family: "Merriweather", "Lato", Helvetica, sans-serif;
	flex: 1 1 30%;
	background-color: #f5dfe6;
	padding: 1em;
	margin: 1em;
}
.bio p {
	flex: 1 1 70%;
	background-color: #f5dfe6;
	padding: 2em;
	margin: 2em;
}
.contactingborder {
	border: 5px solid;
	border-color: #473d4f;
	background-color: #b0a1b9;
	width: fit-content;
	margin-top: 2em;
	margin-bottom: 2em;
	margin-left: auto;
	margin-right: auto;
	background-clip: padding-box;
}
.contacting {
	display: flex;
	flex-direction: column;
	align-content: center;
	justify-content: center;
	width: fit-content;
	margin: 2em;
	background-color: #f5dfe6;
}
.contacting p {
	text-align: center;
	margin: 2em;
	margin-bottom: 1em;
}
.contacting table{
	font-family: "Merriweather", "Lato", Helvetica, sans-serif;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
}
.contacting td{
	padding-bottom: 0.8em;
	font-size: 1.1em;
	font-weight: bold;
}
.contacting td .button{
	font-family: Open Sans, sans-serif; 
	font-weight: bold; 
	font-size: 0.9em; 
	padding: 0.25em; 
	padding-left: 0.5em; 
	padding-right: 0.5em; 
	background-color: #f5dfe6; 
	color: black; 
	border: 3px solid; 
	border-color: #473d4f; 
	border-radius: 3em; 
}
.contacting td .button:hover{
	background-color: #5253c8;
	color: #f5dfe6;
}
</style>
    </head>


    <body>
        <!--Title-->
        <div class="header">
            <div class = "image">
                <a href="./mainpage.html"><img src="./logo.jpg" alt="logo"></a>
            </div>
            <div class = "text">
                HAIRSPLORATION
            </div>
        </div>
        
        <!--Nav bar w dropdown menus-->
        <div class="navbar" id = "navbar"></div>
 
        <!--Short blurb + pic-->
        <div class="content">
		<div class="contentsectionborder"><div class="contentsection">
		<h1> About Us </h1>
		<p>
		Chairsploration is brought to you by the Chairsplorers, a group of students at the University of Texas at Austin. We have sat in chairs for all of our entire lives.
		</p>
			</div></div>
            <div class="bio">
		<h1> Dachey Lin </h1>
                <p style="margin-left:0;">
                    Dachey Lin is an avid chair enthusiast and currently owns a swivel chair. 
                    He also loved the hard wooden chairs from his college dorm.
                </p>
            </div>
            <div class="bio" style = "flex-direction: row-reverse;">
		<h1> Shannon Scofield </h1>
                <p style="margin-right:0;">
                    Shannon Scofield is an enthusiastic chair enthusiast. 
                    She owns two armchairs and a very comfortable desk chair as well as making trips frequently to evaluate public chairs. 
                    She particularly appreciated the DNA chairs at UT Austin.
                </p>
            </div>
            <div class="bio">
		<h1> Ayan Barua </h1>
                <p style="margin-left:0;">
                    Ayan Barua is a person who is very passionate about chairs and everything about them. 
                    He loves to sit on them, as well as to sometimes lay on them.
                </p>
            </div>
            <div class="bio" style="flex-direction: row-reverse;">
		<h1> Giovanni Medrano </h1>
                <p style="margin-right:0;">
                    Giovanni Medrano is a chair fanatic who enjoys testing and feeling chairs he finds throughout his daily life and is currently on the search for the ULTIMATE sitting experience
                </p>
            </div>
            <div class="bio">
		<h1> Luis Kim </h1>
                <p style="margin-left:0;">
                    Luis Kim has sat in chairs. Real, actual, normal chairs. I know, it's hard to believe. It's true though, I swear!
                </p>
            </div>

            <!--Form with text area and email address fields-->
	    <div class="contactingborder"><div class= "contacting">
                <p>
                    Any questions, comments, or concerns? Be sure to leave your feedback in the section below.
                </p>
                <form method="post" id="contact" action = "contact-us.php">
			<table>
                    	    <tr>
				    <td style="text-align:left;"> Email address:  
                        	<input id="email" type="text" style="width:25em;" name="email">
				</td>
			    </tr>
			    <tr>
			    	<td style="text-align:left;"> Message: </td>
			    </tr>
			    <tr>
				<td>
                        <textarea id="message" rows=10 style="width:35em;" name="conttext"></textarea>
				</td>
			    </tr>
			    <tr>
			    <td>
                    <input type="submit" value="Submit" class="button" name="contus">

		    	    </td>
			    </tr>
			</table>
                </form>
		    </div></div>
            
        </div>
        
        <div class="footer">
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>

    </body>
</html>
