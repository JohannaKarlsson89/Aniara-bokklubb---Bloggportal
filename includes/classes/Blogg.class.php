<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/
//Class
class Blogg
{
    //members
    //properties
    private $db;
    private $id;
    private $title;
    private $book_author;
    private $textcontent;
    private $created;
    private $author_id;


    function __construct() {
        //connect to datebase and shut it down if error code present
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die('Fel vid anslutning [' . $this->db->connect_error . ']');
        }
    }

    public function setbloggcontentALL(string $title, string $book_author, string $textcontent):bool {
        if ($title and $book_author and $textcontent != "") {
            $this->title = $title;
            $this->book_author = $book_author;
            $this->textcontent= $textcontent;
            return true;
        } else {
            return false;
        }
       
    }


     //add new post
    public function addbloggpost(int $author_id, string $title, string $book_author, string $textcontent, string $username, int $rating) : bool {
        //check with set methods so no empty values are saved in database 
        if (!$this-> setbloggcontentALL($title, $book_author, $textcontent)) return false;
        //if (!$this->settextcontent($textcontent)) return false;
        $title = $this->db->real_escape_string($title);
        $textcontent=$this->db->real_escape_string($textcontent);
        $author_id = intval($author_id);
        $rating = intval($rating);
        $username=$this->db->real_escape_string($username); 
        //sql query 
        $sql = "INSERT INTO content( author_id,title,book_author, textcontent, username, rating)VALUES('" . $author_id  . "','" . $title . "' , '" . $book_author ."', '" .  $textcontent . "','" .  $username . "' ,  $rating);";
        //send query
        return mysqli_query($this->db, $sql);
    }
//get bloggspost from database 
    public function getbloggpostsALL() :array {
        $sql = "SELECT * FROM content ORDER BY created DESC;";
        //$result = mysqli_query($this->db, $sql);
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }   

    public function getbloggpostforoneuser(int $author_id): array {
        //the author_id is used to show only the logged in users posts
        $author_id = intval($author_id);
        $sql = "SELECT * FROM content WHERE author_id=$author_id;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    public function getbloggpostbyid (int $post_id):array {
        $post_id = intval($post_id);
        //sql query
        $sql ="SELECT * FROM content WHERE post_id=$post_id;";
        $result = mysqli_query($this->db, $sql);
        return $result->fetch_assoc();

    }
    
    public function deletebloggpost ($post_id): bool {
        //the user pressed delete on this post_id
        $post_id = intval($post_id);
        //delete the row that has that id
        $sql = "DELETE FROM content WHERE post_id=$post_id;";
        return mysqli_query($this->db, $sql);
    }
    public function updatebloggpost(int $post_id, string $title, string $book_author, string $textcontent, int $rating ):bool {
        //check with set methods first
         if (!$this->setbloggcontentALL($title, $book_author, $textcontent)) return false;
      //  if (!$this->setTitle($title)) return false;
       // if (!$this->settextcontent($textcontent)) return false;
        $title = $this->db->real_escape_string($title);
        $book_author =$this->db->real_escape_string($book_author);
        $textcontent=$this->db->real_escape_string($textcontent);
        $post_id = intval($post_id);
        $rating = intval($rating);
        

        //sql query
        $sql = "UPDATE content SET title='" . $title . "', textcontent='" . $textcontent . "',rating='" . $rating . "' WHERE post_id=$post_id;";
        //send query
        return mysqli_query($this->db, $sql);
    }
    



    function __destruct()
    {
        mysqli_close($this->db);
    }

}
?>