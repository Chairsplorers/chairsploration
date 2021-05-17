<?php
$dbserver = "spring-2021.cs.utexas.edu";
$dbuser = "cs329e_bulko_wsale";
$dbpwd = "Offend_German-might";
$dbName = "cs329e_bulko_wsale";
$mysqli = new mysqli ($dbserver,$dbuser,$dbpwd,$dbName);

if ($mysqli->connect_errno) {
	die('Connect Error: ' . $mysqli->connect_errno .": " . $mysqli->connect_error);
}

	$user = $_COOKIE['username'];


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/jpg" href="logo.jpg"/>
		<script src="./navbar.js"></script>
		<script src="./revrate.js"></script>

        <style>
           .reviewcolumn {
               display: flex;
               flex-direction: column;
	   }
	   @media (min-width: 1400px){
		.reviewcolumn {
		    display: grid;
		    grid-template-columns: auto auto;
		    grid-gap: 2em;
		}
	   }
           .review {
               flex: 1 1 auto;
               margin: 1em 0;
               padding: 1em;
	       background-color: #f5dfe6;
	       border: 2em solid;
	       border-color: #b0a1b9;
	       display: flex;
	       flex-direction: row;
	       justify-content: space-between;
	   }
	   @media (min-width: 1400px){
		.review {
		    margin: 0;
		}
	   }
	   .reviewtxt {
	       flex: 1 1 auto;
	       margin-right: 1em;
	       display: flex;
	       flex-direction: column;
	       justify-content: flex-start;
	   }
	   .review a {
               color: #5253c8;
           }
           .review h2 {
	       font-family: "Merriweather", "Lato", Helvetica, sans-serif;
	       flex: 0 1 auto;
               margin: 0;
	   }
	   .review h3 {
	       font-family: "Merriweather", "Lato", Helvetica, sans-serif;
	       flex: 0 1 auto;
	       margin: 0.5em 0;
	   }
	   .review p {
	       flex: 1 1 auto;
	       margin: 0;
	   }
	   .review .img {
	       flex: 1 0 40%;
	       display: flex;
	       flex-direction: column;
	       justify-content: center;
	   }
           .review .cimg {
               max-width: 100%;
	   }
	   .reviewsheading{
	       margin-top: 2em;
	       margin-bottom: 1em;
	       border: 2em solid;
	       border-color: #b0a1b9;
	       background-color: #f5dfe6;
	       padding: 2em;
	   }
	   .reviewsheading h1{
	       font-family: "Merriweather", "Lato", Helvetica, sans-serif;
	       text-align: center;
	       margin: 0;
	   }
	   .revrating {
	       flex: 0 1 auto;
	   }
	   .revrating p{
	       padding: 0;
	   }
	   .revbutton{
		font-family: "Open Sans", Helvetica, sans-serif;
		font-weight: bold;
		border-radius: 3em;
		background-color: #f5dfe6;
		color: black;
		border: 3px solid;
		border-color: #473d4f;
		padding: 0.25em 0.5em;
		margin: 0.5em;
	   }
	   .revbutton:hover{
		cursor: pointer;
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
	<div class="content">
	<div class="reviewsheading">
	<h1> Reviews <h1>
	</div>
	<div class="reviewcolumn">	
			<?php
				$command = "SELECT * FROM crandr ORDER BY revpts DESC;";
				$result = $mysqli -> query($command);
				if (!$result) {die("Query failed: ($mysqli->error <br> SQL command= $command");}
				
				$numrows = 0;
				
				while($row = $result->fetch_assoc() and $numrows<10){
					$cid = $row['cid'];
					$review = $row['review'];
					$reviewer = $row['user'];
					$revpts = $row['revpts'];
					$rating = $row['rating'];
					
					if ($review != ""){
					
						$command2 = "SELECT * FROM chairs WHERE cid=$cid;";
						$result2 = $mysqli -> query($command2);
						if (!$result2) {die("Query failed: ($mysqli->error <br> SQL command= $command2");}		

						$chairrow = $result2->fetch_assoc();
						$name = $chairrow['name'];
						
						$command2 = "SELECT * FROM cimg WHERE cid=$cid ORDER BY rate DESC, imgid;";
						$result2 = $mysqli -> query($command2);
						if (!$result2) {die("Query failed: ($mysqli->error <br> SQL command= $command2");}
						
						$imgrow = $result2->fetch_assoc();
						$imgid = $imgrow['imgid'];
						$filetype = $imgrow['filetype'];
						
						$imgurl = "./chairs/$cid/c$cid"."i$imgid.$filetype";
						
						print <<<REVIEW
							<div class = "review">
								<div class="reviewtxt">
								<h2> <a href="./chairs/chair.php?cid=$cid"> $name</a></h2>
REVIEW;
						if ($rating>0){
							print <<<RATREV
									<div class = 'revrating'><h3>Score:</h3><p>$rating/10</p></div>
RATREV;
						}
						print <<<REVIEW
								<h3>$reviewer's review:</h3>
								<p>$review</p>
								<div class="helpfullness"> 
REVIEW;
							if (isset($_COOKIE['username']) && ($user != '') && ($reviewer != $user)){
							$command3 = "SELECT * FROM revrates WHERE cid = $cid AND reviewer = '$reviewer' AND rater = '$user';";
							$resultrev = $mysqli -> query($command3);
							if (!$resultrev) {die("Query failed: ($mysqli->error <br> SQL command = $command3");}
							if($resultrev -> num_rows == 0){
								print <<<HBUTTON
									<button name='helpful' class = 'revbutton' id='r$cid:$reviewer' onclick = "revToggleSet($cid,'$reviewer')">Mark as helpful</button>
									<script>revAddSet($cid,'$reviewer',0);</script>
HBUTTON;
							}
							else{
								print <<<HBUTTON
									<button name='unhelpful' class = 'revbutton' id='r$cid:$reviewer' onclick = "revToggleSet($cid,'$reviewer')"	>Unmark as helpful</button>
									<script>revAddSet($cid,'$reviewer',1);</script>
HBUTTON;
							}
							}
							$command4 = "SELECT revpts FROM crandr WHERE cid = $cid AND user = '$reviewer';";
$result4 = $mysqli -> query($command4);
$row4 = $result4 -> fetch_assoc();
$revpts = $row4['revpts'];
							print <<<REVIMG
								<div class = "reviewscore"> $revpts people have found this review helpful.</div>

								</div></div>
								<div class="img">
								<img src="$imgurl" alt="$name" class="cimg">
								</div>
							</div>
REVIMG;
					$numrows += 1;
					}
				}
			?>
        </div>
	</div>
        <div class="footer">
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>

    </body>
</html>
