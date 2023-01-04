<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/
//activate sessions so that session storage can be used
session_start();

// Activate error reporting
error_reporting(-1);
ini_set("display_errors", 1);
//autoinclude classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php'; //sökväg till mappen för klasser
});

$devmode= false;

if($devmode) {
//DB-settings

define("DBHOST","localhost");
define("DBUSER","BCadmin");
define("DBPASS", "password");
define("DBDATABASE","bcadmin");

}else {

//DB-settings
define("DBHOST","studentmysql.miun.se");
define("DBUSER","joka2113");
define("DBPASS", "hALwhqPqfw");
define("DBDATABASE","joka2113");
}

?>