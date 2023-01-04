<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/
include("includes/config.php");

//connect to to database
$db=new mysqli(DBHOST, DBUSER,DBPASS, DBDATABASE);
if($db->connect_errno > 0) {
    die('fel vid anslutning till databas:' .$db->connect_errno);
}

$sql ="DROP TABLE IF EXISTS content, user;";

$sql .= "CREATE TABLE content(
        post_id INT(11) PRIMARY KEY AUTO_INCREMENT,
        title varchar(128) NOT NULL,
        book_author varchar(128) NOT NULL,
        textcontent TEXT NOT NULL,       
        created timestamp NOT NULL DEFAULT current_timestamp(),
        author_id INT(11) NOT NULL,
        username varchar(128),
        rating int(2) NOT NULL
);
";
$sql .= "CREATE TABLE user(
    author_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    username varchar(128) UNIQUE,
    password varchar(256),
    firstname varchar(128),
    lastname varchar (128),
    created timestamp NOT NULL DEFAULT current_timestamp()
);"; 

$sql .= "ALTER TABLE content ADD FOREIGN KEY (author_id) REFERENCES user(author_id) ON UPDATE CASCADE;";
$sql .= "ALTER TABLE content ADD FOREIGN KEY (username) REFERENCES user(username) ON UPDATE CASCADE;";

//send the sql question to the server
if($db->multi_query($sql)){
    echo "tabell installerad";
} else{
    echo "fel vid installation av tabell";
}

?>