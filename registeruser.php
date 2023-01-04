<?php
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/
$page_title = "Registrera användare";
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
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $username = htmlentities($username, ENT_QUOTES, 'UTF-8');
    $firsname = htmlentities($firstname, ENT_QUOTES, 'UTF-8');
    $lastname = htmlentities($lastname, ENT_QUOTES, 'UTF-8');

    $message = "";
    //new instans of the class Users
    $users = new Users();
    //checking if username and password is set correctly
    
    if (!$users->setPassword($password)) {
        $message .= "<p>Lösenordet måste vara längre än 8 tecken</p>";
    }
    if (!$users->setstuffnotempty($firstname, $lastname)) {
        $message .= "<p>Du måste ange förnamn och efternamn</p>";
    }
    if ($users->controlUsername($username)) {
        $message .= "<p>Användarnamnet du angett är upptaget - Försökt med ett annat!</p>";
    } else {
        //register the user 
        if ($users->registerUser($username, $password, $firstname, $lastname)) {
            $message = "<p>Användare är registrerad</p>";
            header('location:admin.php');
        } else {
            $message .= "<p>Registrering misslyckad - Försök igen!</p>";
        }
    }
}

?>

<form method="post" class="login_form">
    <h1>Registrera ny användare</h1>
    
        <label for="username"><b>Användarnamn:</b> </label>
        <br>
        <input type="text" name="username" id="username">
        <br>
        <label for="password"><b>Lösenord:</b></label>
        <br>
        <input type="password" name="password" id="password">
        <br>
        <br>
        <label for="firstname"><b>Förnamn:</b> </label>
        <br>
        <input type="text" name="firstname" id="firstname">
        <br>
        <label for="lastname"><b>Efternamn:</b> </label>
        <br>
        <input type="text" name="lastname" id="lastname">
        <br>
        <br>
        <label for="checkbox_toggle"><b>Jag accepterar att mina uppgifter lagras</b></label>
        <input type="checkbox" id="checkbox_toggle" value="1" onclick="accepts(this)" />
        <br>
        <br>
        <?php
        if (isset($message)) {
            echo "<br>" . $message . "<br>";
        }
        ?>
        <!--Button is set to disabled before checkbox is checked-->
        <button type="submit" value="registrera" id="submit_button" class="login_btn" disabled>Registrera</button>


</form>



<?php
include("includes/footer.php"); ?>