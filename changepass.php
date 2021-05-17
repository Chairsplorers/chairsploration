<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", "on");
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
            .newuser-info h3{
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
            .info tr {
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                margin-bottom: 0.5em;
            }
            .info td{
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
        <script language = "javascript" type = "text/javascript">
            function ajaxFunction(){
                var current = document.getElementById('cppassword').value;
                var newpass = document.getElementById('chpassword').value;
                var conpass = document.getElementById('copassword').value;

                if (!newpass.match(/^[0-9a-zA-Z]+$/) || newpass.length > 20 || newpass.length < 7){
                    document.getElementById('ajaxDiv').innerHTML = "New password must be alphanumeric and between 7-20 characters long.";
                }

                else if (newpass != conpass){
                    document.getElementById('ajaxDiv').innerHTML = "New passwords do not match.";
                }

                else{
                    var ajaxRequest;
                    ajaxRequest = new XMLHttpRequest();
                    ajaxRequest.onreadystatechange = function(){
                        if(ajaxRequest.readyState == 4){
                            var ajaxDisplay = document.getElementById('ajaxDiv');
                            if (ajaxRequest.responseText.includes(".html")){
                                window.location.href = ajaxRequest.responseText;
                            } else{
                                ajaxDisplay.innerHTML = ajaxRequest.responseText;
                            }
                        }
                    }

                }

                var queryString = "?current=" + current + "&newpass=" + newpass + "&conpass=" + conpass;

                ajaxRequest.open("GET", "updatepass.php" + queryString, true);
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

        <center><h3>Change Password</h3></center>

        <div class = 'newuser-info-border'>
        <div class ='newuser-info'>
            <form name = 'login' id = 'information' method="post" action="changepass.php">
                <table class="info">
                    <tr>
                        <td>
                            Current Password:
                        </td>
                        <td style = "flex: 1 1 auto;">
                            <input type = 'password' class="textbox" name = 'cppassword' id = 'cppassword'/>
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            New Password:
                        </td>
                        <td style = "flex: 1 1 auto;">
                            <input type = 'password' class="textbox" name = 'chpassword' id = 'chpassword'/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Confirm Password:
                        </td>
                        <td style = "flex: 1 1 auto;">
                            <input type = 'password' class="textbox" name = 'copassword' id = 'copassword'/>
                        </td>
                    </tr> 

                    <tr>
                        <td>
                            <input type = "button" class = 'button' name="submit" onclick="ajaxFunction()" value = 'Change Password'/>
                        </td>

                    </tr>     
                </table>
				
            </form>

            <div id = 'ajaxDiv'></div><br>
				
        </div>
        </div>

        <div class="footer">
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>

    </body>
</html>