<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/

$page_title = "Om en recensent";
include("includes/header.php");
include("includes/sidebar.php");


if (isset($_GET['id'])) {
  $author_id = intval($_GET['id']);
  $blogg = new Blogg();
  $user = new Users();
  $oneuser = $user->getuserbyid($author_id);
  $blogg_list = $blogg->getbloggpostforoneuser($author_id);
}

foreach ($oneuser as $row) {
  //check if user is logged in
  if (isset($_SESSION['username'])) {
    echo "<div class='log_out_div'>
  <p>Inloggad användare:" . $_SESSION['username'] . "</p>
  <a href='logout.php' class='button_logout'>Logga ut</a>
</div>";
}
?>
  <section class="about_user">
    <h1>Recensent presentation</h1>
    <br>
    <p>Hej! Jag heter <?= $row['firstname'] . " " . $row['lastname']; ?></p><br>
    <p>I Aniaras bokklubb skriver jag under användarnamnet <?= $row['username']; ?></p><br>
    <p>Här kan du läs alla mina recensioner</p>
  </section>
<?php
}


foreach ($blogg_list as $onePost) {
?>
  <div class="content">
    <article class="admin_container">
      <h2><?= $onePost['title']; ?></h2><br>
      <p>Bokens författare <?= $onePost['book_author']; ?></p><br>
    
      <p>Publicerat <?= $onePost['created']; ?></p><br>
      <p><?= $onePost['textcontent']; ?></p><br>
      <br>
      <p>Mitt betyg: <?= $onePost['rating']; ?> </p>
      <br>
      <hr>
     
    </article>
  </div>
<?php
}

include("includes/footer.php"); ?>