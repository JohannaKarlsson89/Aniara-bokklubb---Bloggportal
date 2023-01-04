<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/
include("includes/header.php");
include("includes/sidebar.php");



if (isset($_GET['id'])) {
    $post_id =intval($_GET['id']);
    $blogg = new Blogg();
    $blogg_list = $blogg->getbloggpostbyid ($post_id);
    }else {
    header("location:index.php");
}
    ?>
    <div class="content">
    <article class="article_index">
    <h1><?= $blogg_list['title']; ?></h1><br>
    <p>Bokens författare <?= $blogg_list['book_author']; ?></p><br>
    <p><?= $blogg_list['textcontent']; ?></p><br>

    <p>Recensör <?= $blogg_list['username']; ?> </p>

    <p>Publicerat<?= $blogg_list['created']; ?></p><br>
    </article>
</div>

    
<?php

include("includes/footer.php");
 ?>