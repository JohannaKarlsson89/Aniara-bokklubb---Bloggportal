<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/

$page_title = "Startsida";
include("includes/header.php");
include("includes/sidebar.php");

$blogg = new Blogg();
$bloggPosts = $blogg->getbloggpostsALL(); {
  //with array slice pick the first five values in the array
  $latestPosts = array_slice($bloggPosts, 0, 5);
   //check if user is logged in
   if (isset($_SESSION['username'])) {
    echo "<div class='log_out_div'>
  <p>Inloggad användare:" . $_SESSION['username'] . "</p>
  <a href='logout.php' class='button_logout'>Logga ut</a>
</div>";
}
?>
  <h1>Senaste recensioner</h1>
  <?php foreach ($latestPosts as $onePost) { ?>
    <div class="content">
      <article class="article_index">
        <h2><?= $onePost['title']; ?></h2>
        <br>
        <p><?= $shortstring = substr($onePost['textcontent'], 0, 300); ?></p>
        <br>
        <p>Mitt betyg: <?= $onePost['rating']; ?> </p>
        <p>Recenserad av: <?= $onePost['username']; ?></p>
        <p>Publicerad: <?= $onePost['created']; ?></p>
        <a href="singlepost.php?id=<?= $onePost['post_id']; ?>" class="button_more">Läs mer</a>
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