<?php

session_start();
$page = $_SESSION["redir"];

error_reporting(E_ALL);
ini_set("display_errors", "on");

$message = "";


$login_file = file("passwd.txt", FILE_IGNORE_NEW_LINES);
$login_data = array();

foreach ($login_file as $line) {
    $line_arr = explode(":", $line);
    $login_data[$line_arr[0]] = $line_arr[1];
}


if (isset($_POST["submit"])){
    if (!(isset($_COOKIE["username"])) || ($_COOKIE["username"] == '')) {
        if (isset($_POST['nusername']) && isset($_POST['npassword']) && !empty($_POST['nusername']) && !empty($_POST['npassword'])){
            $nun = $_POST["nusername"];
            $npw = $_POST["npassword"];
            if (array_key_exists($nun, $login_data)) {
                $message = "$nun has been taken. Please try to enter a different username.";
            } else{
                $file = fopen ("passwd.txt", "a");
                fwrite ($file, "$nun:$npw\n");
                fclose ($file);
                $time = 120;
                setcookie('username', $nun, time()+$time);
                $message = "Registration complete! Redirecting to your page...";
                header("Refresh:1; url=$page");
            }
        } else{
            $message = "Please Enter all Credentials";
        } 

    }
}
    

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/jpg" href="logo.jpg"/>
		
		<style>
			body {
				background-color: #b0a1b9;
			}
		
			div.newuser-info{
				margin-top: 30px;
				margin-bottom: 30px;
				text-align: center;
				background-color: #cdbbb6;
				width: 30%;
				margin-left: auto;
				margin-right: auto;
				padding: 20px;
				border-style: solid;
			}
		
			table{
				margin-left: auto;
				margin-right: auto;
			}
		
			tr.spacing{
				height: 10px;
			}
		
			td {
				font-family: "Times New Roman", serif;
				font-size: 14pt;
				position: center;
				text-align: center;
			}
			
			tiny {
				font-size:8pt;
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
                <button class="dropbtn">
                    <a href="./reviews.php">Reviews</a>
                </button>
                <div class="dropdown-content">
                    <a href="./reviews.php">Reviews</a>
                    <a href="./videos.html">Videos</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">
                    <a href="./superlatives.html">Superlatives</a>
                </button>
                <div class="dropdown-content">
                    <a href="./art.html">Art</a>
                    <a href="./leaderboard.html">Leaderboard</a>
                </div>
            </div>
            <a href="./chairmap.html">Chair Map</a>
            <div class="dropdown">
                <button class="dropbtn">
                    <a href="./contact-us.html">About Us</a>
                </button>
                <div class="dropdown-content">
                    <a href='./contact-us.html'>Contact Us!</a>
                    <a href='./site-updates.html'>Site Updates</a>
                </div>
            </div>
            <input type = "text" class = "input">
            <input type = "button" class = "search" value = "search">
            <!-- probably a form element-->
            <input type='button' class='button' value='I&#x27m Feeling Lucky!'>
            <!-- button -->
            <div class="dropdown">
                <button class="dropbtn">
                    <div class="ham-image">
                        <img src="./hamburger.png" alt="hamburger">
                    </div>
                </button>
                <div class="dropdown-content">
                    <a href="./login.php">Login</a>
                    <a href="./newuser.php">New User</a>
                    <a href="#">Toggle Dark Theme</a>
                    <a href="./settings.html">Settings</a>
                </div>
            </div>
        </div>

        <script type = "text/javascript" src="verify.js"></script>

        <div class ='newuser-info'>
            <form name = 'information' id = 'information' method="post" action="newuser.php">
                <table>
    
                    <tr>
                        <td>
                            Full Name:    
                            <td>
                                <input type = 'text' name = 'fullname'/>

                            </td>                    

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Country:
                            <td>
                                <input type = 'text' name = 'country' />

                            </td>                    

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mobile Number:    
                            <td>
                                <input type = 'text' name = 'number' />

                            </td>                    

                        </td>
                    </tr>
                    <tr>
                        <td>
                            E-mail:   
                            <td>
                                <input type = 'text' name = 'email' />

                            </td>                    

                        </td>
                    </tr>

    
    
    
                    <tr>
                        <td>
                            Username:
                        </td>
                        <td>
                            <input type = 'text' name = 'nusername'/>
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            Password:
                        </td>
                        <td>
                            <input type = 'password' name = 'npassword'/>
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            Repeat Password:
                        </td>
                        <td>
                            <input type = 'password' name = 'repass'/>
                        </td>
                    </tr>
    
                </table>
				
				<br>
				
				<table>
					<tr>
                        <td>
                            <input type = "submit" name = "submit" class = 'button' value = 'Submit'/>
                        </td>
                        <td>
                            <input type = 'reset' value ='Clear'/>
                        </td>
                    </tr>
				</table>
            </form>
				
				<tiny>Already have an account? <a href="login.php">Login</a> instead.</tiny>
        </div>


        <div class="footer">
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>

    </body>
</html>