<?php /*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/?>

<div class="div1">
    <h2>Alla recensenter</h2>
    <?php
    $user = new Users;
    $userarray = $user->getuser();
    foreach ($userarray as $row) {
    ?>
        <nav class="sidebar">
            <ul>
                <li><a href="aboutuser.php?id=<?= $row['author_id']; ?>"> <?= $row['username']; ?></a></li>
            </ul>
        </nav>

    <?php
    }
    ?>
    <!--/div1-->
</div>
<div class="div2">