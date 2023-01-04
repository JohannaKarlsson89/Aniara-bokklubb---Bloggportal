<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/
$page_title = "Redigera";
include("includes/header.php");
include("includes/sidebar.php");

//control if user is logged in
if (!isset($_SESSION['username'])) {
    //if not logged in return to login.php
    header("Location:login.php");
}
$blogg = new Blogg();
//check if id sent
if (isset($_GET['post_id'])) {
    //get the bloggpost
    $post_id = intval($_GET['post_id']);
    //get corresponding bloggpost
    $details = $blogg->getbloggpostbyid($post_id);
} else {
    //if not sent send back to admin site
    header("location:admin.php");
}
if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $book_author = $_POST['book_author'];
    $textcontent = $_POST['textcontent'];
    $rating = $_POST['rating'];
    $title = htmlentities($title, ENT_QUOTES, 'UTF-8');
    $book_author = htmlentities($book_author, ENT_QUOTES, 'UTF-8');
    $textcontent = htmlentities($textcontent, ENT_QUOTES, 'UTF-8');
    //create new instans 
    $blogg = new Blogg();
    //set this varible to true for use in if-statements 
    $success = true;

    if (!$blogg->setbloggcontentALL($title, $book_author, $textcontent)) {
        $message .= "<p>Du måste fylla i alla fälten - Försök igen!</p>";
        $success = false;
    }
    if ($success) {
        //upadate a new bloggpost 
        if ($blogg->updatebloggpost($post_id, $title, $book_author, $textcontent, $rating)) {
            $_SESSION['post_updated'] = "<p class='post_updated'>Inlägg uppdaterat</p><br>";
            header("location:edit.php");
        } else {
        }
    } else {
    }
}
$page_title = "Editera";

$title = "";
$book_author = "";
$textcontent = "";


?>
<div class="log_out_div">
    <p>Inloggad användare: <?= $_SESSION['username']; ?></p>
    <a href="logout.php" class="button_logout">Logga ut</a>
</div>




<form method="POST" class="login_form" action="edit.php?post_id=<?= $post_id; ?>">
<h1>Redigera inlägg med titeln: <?= $details['title']; ?></h1>
<b>Bokens titel:</b> <br><input type="text" id="title" name="title" class="title" value="<?= $details['title']; ?>"><br>
<b>Bokens författare:</b> <br><input type="text" id="book_author" name="book_author" class="book_author" value="<?= $details['book_author']; ?>"><br>
<b>Din recension:</b> <br><textarea rows="10" id="textcontent" name="textcontent" class="textarea"><?= $details['textcontent']; ?></textarea><br>
    <label for="rating"><b>Betyg:</b></label><br>
    <select id="rating" name="rating">
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>

    </select> <br>
    <input class="login_btn" type="submit" value="Uppdatera">
</form>


<?php
include("includes/footer.php");
?>