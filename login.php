<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/
$page_title = "Logga in";
include("includes/header.php");
include("includes/sidebar.php");
?>

<?php
//REGISTER NEW USER
//checks if something i posted
if (isset($_POST['username'])) {
    //saves what posted in a variable
    $username = $_POST['username'];
    $password = $_POST['password'];
    $message = "";
    //new instans of the class Users
    $users = new Users();
    //checking if username and password is set correctly
    if ($users->logInUser($username, $password)) {
        //sending logged in user to admin.php 
        header("location: admin.php");
    } else {
        $message = "<p>Fel användarnamn eller lösenord - Försök igen!</p>";
    }
}

?>


<form method="post" class="login_form">
    <h1>Logga in</h1>

    <label for="username"><b>Användarnamn:</b> </label>
    <br>
    <input type="text" name="username" id="username">
    <br>
    <label for="password"><b>Lösenord:</b> </label>
    <br>
    <input type="text" name="password" id="password">
    <br>
    <br>
    <a href="registeruser.php">Registrera ny användare</a><br>

    <?php
if (isset($message)) {
    echo "<br>" . $message . "<br>";
}
?>
    <input type="submit" value="Logga in" class="login_btn">
</form>






<?php
include("includes/footer.php"); ?>