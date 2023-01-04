<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/

class Users {
//properties
    private $db;
    private $author_id;
    private $username;
    private $password;
    private $firstname;
    private $lastname;
//methods

public function __construct()
{
       //connect to datebase and shut it down if error code present
       $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
       if ($this->db->connect_errno > 0) {
           die('Fel vid anslutning [' . $this->db->connect_error . ']');
       }   
}

//log in user
public function logInUser (string $username, string $password):bool {
    $username = $this ->db -> real_escape_string($username);
    $password = $this ->db -> real_escape_string($password);

    $sql = "SELECT * FROM user WHERE username = '$username';";
    $result = $this->db->query($sql);
    if($result->num_rows > 0) {
        //if returning rows username exist in database
        $row = $result->fetch_assoc();
        //hashed password in databases
        $stored_password = $row['password'];
        //check if password matches
        $author_id =$row['author_id'];
        if(password_verify( $password,$stored_password)) {
 //creates a session variable for use to know who is logged in and to post the right users-id to the database
            $_SESSION['username'] =$username;
            
            $_SESSION['author_id'] =$author_id;
            return true;      
        } else 
        {return false;
        }  
} else {
    return false;
}}

// function to register user
public function registerUser($username, $password, $firstname, $lastname ) :bool {
     //check with set methods  
     if (!$this->setPassword($password)) return false;
     if (!$this->setstuffnotempty($firstname,$lastname)) return false;
     
     $username=$this->db->real_escape_string($username);
     $password=$this->db->real_escape_string($password);
     $firstname=$this->db->real_escape_string($firstname);
    $lastname=$this->db->real_escape_string($lastname);

    $encryptedpassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user(username, password, firstname, lastname) VALUES('$username','$encryptedpassword', '$firstname', '$lastname');";

    $result = $this->db->query($sql);
    return $result;
}

public function setstuffnotempty(string $firstname, string $lastname):bool {
    if ($firstname != "" and $lastname !="") {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        return true;
    }else {
        return false;
    }

}


public function setPassword (string $password):bool {
    //checks if the input is empty
    if (strlen($password) > 8) {
       $this->password = $password;
       return true;
   } else {
       return false;
   }
   }


//check if username is taken
public function controlUsername (string $username):bool {
    

    $sql = "SELECT username FROM user WHERE username = '$username'";
    $result = $this->db->query($sql);
    //check if there any returns on the sql question. If there is any it means the username is taken
    if($result ->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

public function getuser(): array {
    $sql = "SELECT * FROM user ORDER BY created DESC;";
    //$result = mysqli_query($this->db, $sql);
    $result = $this->db->query($sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

public function getuserbyid(int $author_id): array {
    $author_id = intval($author_id);
        //sql query
        $sql ="SELECT * FROM user WHERE author_id=$author_id;";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
       

}

function __destruct()
    {
        mysqli_close($this->db);
    }

}
