<?php
$page_title = "Alla blogginlägg";
include("includes/header.php");
include("includes/sidebar.php");

$blogg = new Blogg();
$bloggPosts = $blogg->getbloggpostsALL(); {

   //check if user is logged in
   if (isset($_SESSION['username'])) {
    echo "<div class='log_out_div'>
  <p>Inloggad användare:" . $_SESSION['username'] . "</p>
  <a href='logout.php' class='button_logout'>Logga ut</a>
</div>";
}
?>
  <h1>Alla recensioner</h1>
  <?php foreach ($bloggPosts as $onePost) { ?>
    <div class="content">
      <article class="article_index">
        <h2><?= $onePost['title']; ?></h2>
        <p><?= $onePost['book_author']; ?> </p>
        <br>
        <p><?=$onePost['textcontent']; ?></p>
        <br>
        <p>Mitt betyg: <?= $onePost['rating']; ?> </p>
        <p>Recenserad av: <?= $onePost['username']; ?></p>
        <p>Publicerad: <?= $onePost['created']; ?></p>
        
        <br><br>
        <hr>
      </article>
    </div>

<?php
  }
}
?>
<?php

include("includes/footer.php"); ?>