<!DOCTYPE html>
<html>
    <head>
        <title>Chairsploration</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/jpg" href="logo.jpg"/>

        <style>
           .reviewcolumn {
               display: flex;
               flex-direction: column;
               padding: 10px 12px;
           }
           .review {
               flex: 0 1 auto;
               margin: 5px 8px;
               padding: 5px 8px;
               background-color: #b1a0b9;
           }
           .review a {
               color: #5253c8;
           }
           .review h3 {
               display:inline;
           }
           .review img {
               max-width: 100%;
               float: right;
               max-height: 18em;
           }
        </style>

    </head>


    <body>
        <!--Title-->
        <div class="header">
            <div class = "image">
                <a href = "./mainpage.html"><img src="./logo.jpg" alt="logo"></a>
            </div>
            <div class = "text">
                HAIRSPLORATION
            </div>
        </div>
        
        <!--Nav bar w dropdown menus-->
        <div class="navbar"> 
            <div class="dropdown">
                <button class="dropbtn" style="background-color: #5253c8">
                    <a href="#" style="color: #cdbbb6">Reviews</a>
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

        <div class="reviewcolumn">
            <div class = "review">
                <h3><a href="./chairs/samplechair.php"> Office Chair</a> </h3>
                <p> The chair is quite wonderful. It has wheels, spins, and has adjustable back angle, seat angle, and height. It is good enough to sit in all day. </p>
            </div>
            <div class = "review">
                <h3> <a href="./chairs/samplechair.php"> Butt Rock</a></h3>
                <img src="./butt_rock.jpg" alt="butt rock"><p> While this rock isn't very easy to get to a few miles into the New Hance Trail, it is comfortable for rest on the trail and the views are spectacular. </p>
            </div>
        </div>

        <div class="footer">
            <p>&#169; Last updated 04/05/21 by the <a href="mailto:chairsplorers@chairschairschairs.com">Chairsplorers</a>.</p>
        </div>

    </body>
</html>