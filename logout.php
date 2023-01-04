<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/
session_start();
session_unset();
session_destroy();

header('location:index.php');
exit();
?>