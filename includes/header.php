<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/


include("includes/config.php");
?>
<!DOCTYPE html>
<html lang="sv">

<head>
  <title><?=  $page_title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/style.css">
  <script src="javascript/script.js"></script>
  <!--icons-->
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css'>
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body>
  <div class="container">
    <nav>
      <div class="header_container_picture">
        <img class="logotype" src="images/bookshelf_header.jpg" alt="böcker i bokhylla">
        <a href="index.php" class="header_text">ANIARA BOKKLUBB</a>
      </div>
      <div class="nav_hover">
        <div id="menu">
          <a href="index.php">STARTSIDA</a>
          <a href="allposts.php">ALLA INLÄGG</a>         
          <!--Check if someone is logged in to show redigera, otherwise show logga in-->
          <?php if (isset($_SESSION['username'])) {
            echo "<a href='admin.php'>REDIGERA</a>";
          }else {
            echo "<a href='login.php'>LOGGA IN</a>";
          }
          ?>

        </div>
        <!--Start the interactive elements for javascript-->
        <a href="javascript:void(0);" class="icon" onclick="popoutmenu()">
          <div id="icon_menu"> <i class="fi fi-rr-align-justify"></i> </div>
          <div id="icon_x"><i class="fi fi-br-cross"></i></div>
        </a>
      </div>

    </nav>



    <div class="parent">