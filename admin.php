<?php
$page_title = "Administrationsida";
include("includes/header.php");
include("includes/sidebar.php");
//checks if the session variable username exist
$author_id = $_SESSION['author_id'];
$username = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
  //if not exist - send user to login page

  header("location: login.php");
} else {
  $title = "";
  $book_author = "";
  $textcontent = "";


  //checks if something has been posted
  if (isset($_POST['title'])) {
    $message = "";
    $title = $_POST['title'];
    $book_author = $_POST['book_author'];
    $textcontent = $_POST['textcontent'];
    $rating = $_POST['rating'];
    $title = htmlentities($title, ENT_QUOTES, 'UTF-8');
    $book_author = htmlentities($book_author, ENT_QUOTES, 'UTF-8');
    $textcontent = htmlentities($textcontent, ENT_QUOTES, 'UTF-8');

    //if something is posted - create new instans of class Blogg
    $blogg = new Blogg();
    //success variable that will be used to check if settitle and settextcontent is set
    $success = true;
    if (!$blogg->setbloggcontentALL($title, $book_author, $textcontent)) {
      $message .= "<p class='error_msg'>Du måste fylla i alla fälten - Försök igen!</p>";
      $success = false;
    }
    if ($success) {
      if ($blogg->addbloggpost($author_id, $title, $book_author, $textcontent, $username, $rating)) {
        header("location: admin.php");
      }
    }
  }
}
?>
<div class="log_out_div">
  <p>Inloggad användare: <?= $_SESSION['username']; ?></p>
  <a href="logout.php" class="button_logout">Logga ut</a>
</div>




<form method="POST" action="admin.php" class="login_form">
<h1>Skapa nytt inlägg </h1> 
  <b>Bokens titel:</b> <br><input type="text" id="title" name="title" class="title" value="<?= $title; ?>"><br>
  <b>Bokens författare:</b> <br><input type="text" id="book_author" name="book_author" class="book_author" value="<?= $book_author; ?>"><br>
  <b>Din recension:</b> <br><textarea rows="10" id="textcontent" name="textcontent" class="textarea"><?= $textcontent; ?></textarea><br>
  <label for="rating"><b>Betyg:</b></label><br>
  <select id="rating" name="rating">
    <option value="5">5</option>
    <option value="4">4</option>
    <option value="3">3</option>
    <option value="2">2</option>
    <option value="1">1</option>

  </select> <br>
  <?php
  if (isset($message)) {
    echo "<b>" . $message . "</b>";
  }
  ?>
  <input type="submit" value="Spara" class="login_btn"> <br>
</form>

<?php if (isset($_SESSION['post_updated'])) {
  echo $_SESSION['post_updated'];
  unset($_SESSION['post_updated']);
}
?>

<h2>Dina skapade bloggposter </h2> <br>
<?php
//new instans created
$blogg = new Blogg();
//sends the author_id from logged in user
$blogg_list = $blogg->getbloggpostforoneuser($author_id);
foreach ($blogg_list as $onePost) {
?>
  <article class="admin_container">
    <h3>Bokens titel: <?= $onePost['title']; ?></h3><br>
    <p>Bokens författare: <?= $onePost['book_author']; ?> </p>
    <p>Betyg: <?= $onePost['rating']; ?> </p>

    <p><?= $onePost['created']; ?></p><br>
    <p><?= $onePost['textcontent']; ?></p><br>

    <a href='admin.php?delete=<?= $onePost['post_id']; ?>' class="button_admin">ta bort</a>
    <br>
    <br>
    <a href='edit.php?post_id=<?= $onePost['post_id']; ?>' class="button_admin">redigera</a>
  </article>
<?php

  //checks if delete is there and saves it in a varible
  if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    //send the varible as an argument
    ($blogg->deletebloggpost($post_id));
    //reloads the side so that the post actully disappears from the printed out posts
    header("location: admin.php");
  }
}
?>

<?php
include("includes/footer.php");
?>