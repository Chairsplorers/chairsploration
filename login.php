<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", "on");

if (isset($_COOKIE['username'])){
    header("Refresh:1; url=mainpage.html");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
	<meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/jpg" href="logo.jpg"/>
		<script src="./navbar.js"></script>
		
		<style>
			.newuser-info-border{
				width: fit-content;
				max-width: 60%;
				border: 5px solid;
				border-color: #473d4f;
				background-color: #b0a1b9;
				margin: 2em auto;
				background-clip: padding-box;
			}
			.newuser-info{
				margin: 2em;
				text-align: center;
				background-color: #f5dfe6;
				padding: 2em;
				padding-bottom: 1em;
			}
			.newuser-info h2{
				margin-top: 0;
				font-family: "Merriweather", "Lato", Helvetica, sans-serif;
			}
			#information{
				display: flex;
				flex-direction: column;
				align-content: center;
				justify-content: center;
			}
		
			.info{
				font-family: "Merriweather", "Lato", Helvetica, sans-serif;
				text-align: center;
				margin: 0 auto;
			}
		
			.info tr{
				display: flex;
				flex-direction: row;
				justify-content: space-around;
				margin-bottom: 0.5em;	
			}
		
			.info td {
				font-size: 1.1em;
				font-weight: bold;
				display: flex;
				flex-direction: column;
				justify-content: center;
			}
			
			.info .textbox{
				flex: 0 1 auto;
				min-height: 1em;
				margin: 0 0.5em;
			}
			.info .button{
				font-family: "Open Sans", sans-serif;
				font-weight: bold;
				font-size: 0.85em;
				padding: 0.25em 0.5em;
				background-color: #f5dfe6;
				color: black;
				border: 3px solid;
				border-color: #473d4f;
				border-radius: 3em;
			}
			.info .button:hover{
				background-color: #5253c8;
				color: #f5dfe6;
			}
			.tiny {
				font-size:0.75em;
			}
		</style>
    </head>


    <body>
        <!--Title-->
        <script language = "javascript" type = "text/javascript">
            function ajaxFunction(){
                var ajaxRequest;
                ajaxRequest = new XMLHttpRequest();
                ajaxRequest.onreadystatechange = function(){
                    if(ajaxRequest.readyState == 4){
                        var ajaxDisplay = document.getElementById('ajaxDiv');
                        if (ajaxRequest.responseText.includes(".php") || ajaxRequest.responseText.includes(".html")){
                            window.location.href = ajaxRequest.responseText;
                        } else{
                            ajaxDisplay.innerHTML = ajaxRequest.responseText;
                        }
                    }
                }

                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;
                var queryString = "?user=" + username + "&pass=" + password;

                ajaxRequest.open("GET", "update.php" + queryString, true);
                ajaxRequest.send(null);
                

            }

        </script>

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
         
        <!-- <script type = "text/javascript" src="verify.js"></script> -->
	<div class="content">
	<div class ='newuser-info-border'>
	<div class ='newuser-info'>
            <h2>Please Login to Continue Using Our Website</h2>
            <form name = 'login' id = 'information' method="post" action="login.php">
                <table class="info">
                    <tr>
                        <td>
                            Username:
                        </td>
                        <td style="flex: 1 1 auto;">
                            <input type = 'text'  class="textbox" name = 'username' id = 'username'/>
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            Password:
                        </td>
                        <td style="flex: 1 1 auto;">
                            <input type = 'password' class="textbox" name = 'password' id = 'password'/>
                        </td>
                    </tr>    
		    <tr style="margin: 1em 0;">
			<td>
			    <input type = "button" class = 'button' name="submit" onclick="ajaxFunction()" value = 'Login'/>
			</td>	
		    </tr>
                </table>
            </form>

            <div id = 'ajaxDiv'></div>
				
			<div class="tiny">No account? <a href="newuser.php">Register</a> instead.</div>
	</div>
	</div>

        <div class="footer">
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>
    </div>
    </body>
</html>
