<?php

session_start();

if ((isSet($_SESSION['signed_in'])) && ($_SESSION['signed_in'] == true)) {
    header('Location: main_site.php');
    exit();
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title> Sign in </title>

</head>


<body>
<div id="container">
    <div id="sign_in">
        <form action="sign_in.php" method="post">
            <b>SIGN IN</b><br/><br/>
            <b>Username: </b><br/>
            <input type="text" name="login" value="" size="30"><br/>
            <b>Password:</b><br/>
            <input type="password" name="user_password" value="" size="30"><br/>
            <input type="submit" value="Sign in">
        </form>
        <?php
        if (isSet($_SESSION['error'])) {
            echo "<p>".$_SESSION['error']."<p/>";
        }
        ?>
    </div>

</div>
</body>
</html>