<?php
setcookie('username', $un, time()-10);

header("Refresh:1; url='mainpage.html'");
?> 