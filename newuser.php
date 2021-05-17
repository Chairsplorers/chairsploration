<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", "on");    

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/jpg" href="logo.jpg"/>
		<script src="./navbar.js"></script>
		
		<style>
			.newuser-info-border{
				width: fit-content;
				max-width: 40%;
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
                var first    = document.getElementById('first').value;
                var last     = document.getElementById('last').value;
                var email    = document.getElementById('email').value;
                var username = document.getElementById('nusername').value;
                var password = document.getElementById('npassword').value;
                var repasswd = document.getElementById('rpassword').value;
    
                if (!username.match(/^[0-9a-zA-Z]+$/) || username.length > 20){
                    document.getElementById('ajaxDiv').innerHTML = "Please enter an alphanumeric username between 1-20 characters long.";
                }
                else if (!password.match(/^[0-9a-zA-Z]+$/) || password.length > 20 || password.length < 7){
                    document.getElementById('ajaxDiv').innerHTML = "Please enter an alphanumeric password between 7-20 characters long.";
                }
                else if (!email.includes("@")){
                    document.getElementById('ajaxDiv').innerHTML = "Please enter a valid email address";
                }
                else if (password != repasswd){
                    document.getElementById('ajaxDiv').innerHTML = "Passwords do not match.";
                }
                else{
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
                }
                
                var queryString = "?user=" + username + "&pass=" + password + "&first=" + first + "&last=" + last + "&email=" + email;

                ajaxRequest.open("GET", "newupdate.php" + queryString, true);
                ajaxRequest.send(null);
                

            }

        </script>

	<div class="newuser-info-border">
	<div class ='newuser-info'>
	    <h2> Please Register to Continue Using Our Website </h2>
            <form name = 'information' id = 'information' method="post" action="newuser.php">
                <table class="info">
    
                    <tr>
                        <td>
                            First Name:    
                        </td>
                            <td style="flex: 1 1 auto;">
                                <input type = 'text' class="textbox" name = 'first' id="first"/>

                            </td>                    

                    </tr>

                    <tr>
                        <td>
                            Last Name:    
                        </td>
                            <td style="flex: 1 1 auto;">
                                <input type = 'text' class="textbox" name = 'last' id="last"/>

                            </td>                    

                    </tr>

                    <tr>
                        <td>
                            E-mail:   
                        </td>
                            <td style="flex: 1 1 auto;">
                                <input type = 'text' class="textbox" name = 'email' id="email"/>

                            </td>                    

                    </tr>
    
                    <tr>
                        <td>
                            Username:
                        </td>
                        <td style="flex: 1 1 auto;">
                            <input type = 'text' class="textbox" name = 'nusername' id="nusername"/>
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            Password:
                        </td>
                        <td style="flex: 1 1 auto;">
                            <input type = 'password' class="textbox" name = 'npassword' id="npassword"/>
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            Repeat Password:
                        </td>
                        <td style="flex: 1 1 auto;">
                            <input type = 'password' class="textbox" name = 'rpassword' id="rpassword"/>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <input type = "button" class="button" name = "submit" class = 'button' onclick="ajaxFunction()" value = 'Submit'/>
                        </td>
                        <td>
                            <input type = 'reset' class="button" value ='Clear'/>
                        </td>
                    </tr>
				</table>
            </form>

            <div id = 'ajaxDiv'></div>
				
			<div class="tiny">Already have an account? <a href="login.php">Login</a> instead.</div>
	</div>
	</div>


        <div class="footer">
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>

    </body>
</html>
