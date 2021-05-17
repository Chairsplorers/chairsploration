<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/jpg" href="logo.jpg"/>
	<script src="./navbar.js"></script>
	<style>
	    .settingsborder{
		width: fit-content;
		max-width: 60%;
		border: 5px solid;
		border-color: #473d4f;
		background-color: #b0a1b9;
		margin: 2em auto;
		background-clip: padding-box;
	    }
	    .settingsdiv{
		margin: 2em;
		text-align: center;
		background-color: #f5dfe6;
		padding: 2em;
		padding-bottom: 1em;
	    }
	    .settingsdiv h2{
		margin-top: 0;
		margin-bottom: 0.5em;
		font-family: "Merriweather", "Lato", Helvetica, sans-serif;
	    }
	    .settingsdiv p{
		margin: 0;
	    }
	    #settingsform{
	    	display: flex;
		flex-direction: column;
		align-content: center;
		justify-content: center;
	    }
	    .setting{
		font-family: "Merriweather", "Lato", Helvetica, sans-serif;
		text-align: center;
		margin: 0 auto;
	    }
	    .setting tr{
		display: flex;
		flex-direction: row;
		justify-content: space-around;
		margin-bottom: 0.5em;
	    }
	    .setting td{
		font-size: 1.1em;
		font-weight: bold;
		display: flex;
		flex-direction: column;
		justify-content: center;
	    }
	    .setting .textbox{
		flex: 0 1 auto;
		min-height: 1em;
	    }
	    .setting .button{
		font-family: "Open Sans", Helvetica, sans-serif;
		font-weight: bold;
		font-size: 0.85em;
		padding: 0.25em 0.5em;
		background-color: #f5dfe6;
		color: black;
		border: 3px solid;
		border-color: #473d4f;
		border-radius: 3em;
	    }
	    .setting .button:hover{
		background-color: #5253c8;
		color: #f5dfe6;
	    }
	    #ajaxDiv{
	    	margin-bottom: 0.5em;
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

        <script language = "javascript" type = "text/javascript">
            function ajaxFunction(){
                var ajaxRequest;
                ajaxRequest = new XMLHttpRequest();
                ajaxRequest.onreadystatechange = function(){
                    if(ajaxRequest.readyState == 4){
                        var ajaxDisplay = document.getElementById('ajaxDiv');
                        ajaxDisplay.innerHTML = ajaxRequest.responseText;
                    }
                }

                var username = document.getElementById('user').innerHTML;
                var email = document.getElementById('email').value;
                var last = document.getElementById('last').value;
                var first = document.getElementById('first').value;

                console.log(username);
                console.log(email);
                console.log(last);


                var queryString = "?user=" + username + "&email=" + email + "&last=" + last + "&first=" + first;

                ajaxRequest.open("GET", "settupdate.php" + queryString, true);
                ajaxRequest.send(null);

            }

        </script>

        <?php
        if(isset($_COOKIE['username'])) {
            error_reporting(E_ALL);
            ini_set("display_errors", "on");

            $username = $_COOKIE['username'];


            $server = "spring-2021.cs.utexas.edu";
            $user = "cs329e_bulko_wsale";
            $pwd = "Offend_German-might";
            $dbName = "cs329e_bulko_wsale";

            $mysqli = new mysqli ($server, $user, $pwd, $dbName);
            $mysqli->select_db($dbName) or die($mysqli->error);

            $command = "SELECT * FROM userinfo WHERE username='$username';";
            $result = $mysqli->query($command) or die($mysqli->error);

            $row = $result->fetch_row();
	    echo "<div class='settingsborder'><div class ='settingsdiv'>";
            echo "<h2> Account Settings </h2>";
            echo '<p>Change your profile and account settings</p>';
            echo '<form id= "settingsform" method = "post" action="settings.php">';
            echo "<table class = 'setting'><tr style = 'margin-top: 0.5em;'>  
                    <td>
                    <p> Username: </p>
                    </td>

                    <td>
                    <p id='user' name='usernamesetting'>$row[0]</p>
                    </td>
                </tr>";
            echo '<tr><td><p>First Name:</p></td><td><p>Last Name:</p></td></tr>';
            echo "<tr>
                    <td style='margin-right: 0.5em; flex: 1 1 auto;'>
                    <input type='text' class='textbox' id='first' name='firstsetting' size = '20' placeholder='First Name' value='$row[3]'>
                    </td>

                    <td style = 'flex: 1 1 auto;'>
                    <input type='text' class='textbox' id='last' name='lastsetting' size = '20' placeholder='Last Name' value='$row[2]'>
                    </td>
                </tr>";
            echo '<tr>
                    <td>
                    <p>Email:</p>
                    </td>
                </tr>';
            echo "<tr>
                    <td style = 'flex: 1 1 auto;'>
                    <input type='text' class='textbox' id='email' name='emailsetting' size = '20' placeholder='Email' value='$row[4]'>
                    </td>
                </tr>";
            echo '<tr>
                    <td>
                    <input type = "button" class="button" onclick="ajaxFunction()" value = "Save"/>
                    </td>
                </tr>


            </table>
        </form>';

        echo "<div id = 'ajaxDiv'></div>";

        echo "<p><a href='changepass.php'>Click Here</a> in order to change your password.</p>";

	echo "</div></div>";
        } else if (!isset($_COOKIE['username'])){
            header ("Location: ./login.php");
        }

        ?>


        <div class="footer">
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>

    </body>
</html>
