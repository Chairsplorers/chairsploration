<?php
$dbserver = "spring-2021.cs.utexas.edu";
$dbuser = "cs329e_bulko_wsale";
$dbpwd = "Offend_German-might";
$dbName = "cs329e_bulko_wsale";
$mysqli = new mysqli ($dbserver,$dbuser,$dbpwd,$dbName);

if ($mysqli->connect_errno) {
	die('Connect Error: ' . $mysqli->connect_errno .": " . $mysqli->connect_error);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/jpg" href="logo.jpg"/>
		
		<style>
			.contentheader {
				background-color: #f5dfe6;
				margin: auto;
				margin-top: 2em;
				margin-bottom: 2em;
				border: 4px solid;
				border-color: #473d4f;
				padding: 0.5em;
			}
			.contentheader h1{
				text-align:center;
				font-family: "Merriweather", "Lato", Helvetica, sans-serif;
				margin: 0.25em;
				font-size: 3em;
			}
			table.leaderboard{
				margin-left:auto;
				margin-right:auto;
				border: solid 5px;
				text-align:center;
				font-size: 120%;
			}
			table.leaderboard th{
				height: 2em;
				border-bottom: solid;
				background-color: #5253c8;
				color: #f5dfe6;
			}
			table.leaderboard td{
				height: 2em;
				border-bottom: dashed;
				border-color: #b0a1b9;
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
        <div class="navbar"> 
            <div class="dropdown">
                <a href="./reviews.html"><button class="dropbtn">
                    Reviews
                </button></a>
                <div class="dropdown-content">
                    <a href="./reviews.html">Reviews</a>
                    <a href="./videos.html">Videos</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">
                    Superlatives
                </button>
                <div class="dropdown-content">
                    <a href="./art.html">Art</a>
                    <a href="./leaderboard.html">Leaderboard</a>
                </div>
            </div>
			<div class="dropdown">
				<a href="./chairmap.html"><button class="dropbtn">
					Chair Map
				</button></a>
			</div>
            <div class="dropdown">
                <a href="./contact-us.html"><button class="dropbtn">
					About Us
                </button></a>
                <div class="dropdown-content">
                    <a href='./contact-us.html'>Contact Us!</a>
                    <a href='./site-updates.html'>Site Updates</a>
                </div>
            </div>
            <input type = "text" class = "input" style = "margin-left:10px;">
            <input type = "button" class = "search" value = "search">
            <!-- probably a form element-->
            <input type='button' class='button' value='I&#x27m Feeling Lucky!'>
            <!-- button -->
            <div class="settings">
                <button class="hamb">
                    <div class="ham-image">
                        <img src="./hamburger.png" alt="hamburger" height="40px">
                    </div>
                </button>
                <div class="dropdown-content">
                    <a href="./login.php">Login</a>
                    <a href="./newuser.php">New User</a>
                    <a href="./settings.html">Settings</a>
                </div>
            </div>
        </div>

        <div class="content">
            <!-- in future add way to resort for different categories-->
	    <div class="contentheader">
		<h1>Top Chairs</h1>
	    </div>
            <table class = "leaderboard">
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
					<th>Location</th>
                    <th>Avg.</th>
                    <th>Users</th>
                </tr>
                
				<?php
					$command = "SELECT * FROM chairs ORDER BY wavg DESC, name;";
					$result = $mysqli -> query($command);
					if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
					
					$rank = 1;
					
					while($row = $result->fetch_assoc()) {
						$cid = $row['cid'];
						$name = $row['name'];
						$loc = $row['loc'];
						$avg = $row['avg'];
						$nusers = $row['nusers'];
						
						print <<<ENTRY
						<tr>
							<td style = "width:20em;border-right:dashed; border-color: #b0a1b9;">$rank</td>
							<td style = "width:120em;border-right:dashed; border-color: #b0a1b9;"><a href = "./chairs/chair.php?id=$cid">$name</a></td>
							<td style = "width:80em;border-right:dashed; border-color: #b0a1b9;">$loc</td>
							<td style = "width:25em;border-right:dashed; border-color: #b0a1b9;">$avg</td>
							<td style = "width:25em;">$nusers</td>
						</tr>
ENTRY;
						$rank = $rank+1;
					}
				?>
            </table>
        </div>

        <div class="footer">
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>

    </body>
</html>
