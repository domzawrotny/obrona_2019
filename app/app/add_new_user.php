<?php
    session_start();
    header( 'Cache-Control: no-store, no-cache, must-revalidate' );
    header( 'Cache-Control: post-check=0, pre-check=0', false );
    header( 'Pragma: no-cache' );
    if (!isSet($_SESSION['signed_in']) && ( $_SESSION['permissions'] != 1 )) {
        header('Location: index.php');
        exit();
    }
    if(isSet($_SESSION['user_added']) ) {
        header("Refresh:0");
        unset($_SESSION['user_added']);
    }
?>
<html>
<head>
    <title> Add new user </title>
</head>

<body>
<div id="container">

    <div id="go_back">
        <a href="javascript:history.go(-1)" title="Return to previous page">&laquo; Go back</a>
    </div>
    <div id="sign_out">
        <a href="index.php">Main site</a>
        <a href="sign_out.php">Sign out</a>
    </div>
    <div class="clear"></div>
    <form action="new_student.php" method="post">
        <b>Add new student</b><br/><br/>
        <b>Firstname: </b><br/>
        <input type="text" name="firstname" value="" size="30"><br/>
        <b>Surname: </b><br/>
        <input type="text" name="surname" value="" size="30"><br/>
        <b>PESEL: </b><br/>
        <input type="text" name="pesel" value="" size="30" maxlength="11"><br/>
        <?php
        if (isSet($_SESSION['pesel_error'])){
            echo $_SESSION['pesel_error'];
        }

        ?>
        <b>Password:</b><br/>
        <input type="password" name="user_password" value="" size="30"><br/>
        <b>Repeat password:</b><br/>
        <input type="password" name="r_user_password" value="" size="30"><br/>
        <?php

        if(isSet($_SESSION['p_error'])) {
            echo $_SESSION['p_error'];
        }

        ?>
        <b>City:</b><br/>
        <input type="text" name="city" value="" size="30" maxlength="20"><br/>
        <b>Street:</b><br/>
        <input type="text" name="street" value="" size="30" maxlength="20"><br/>
        <b>House no:</b><br/>
        <input type="text" name="house_no" value="" size="30" maxlength="4"><br/>
        <input type="submit" value="Add new student">
    </form>
</div>

</body>
</html>