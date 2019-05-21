<?php
    session_start();
    #if (!isSet($_SESSION['signed_in']) || ($_SESSION['permissions']!=2) ) {
    if (!isSet($_SESSION['signed_in'])) {
        header('Location: ../index.php');
        exit();
    }
?>
<html>
<head>
    <title> Main website </title>
<!--    <link rel="stylesheet" href="../lib/css/style.css" type="text/css" />-->
</head>

<body>
<div id="container">

    <div id="go_back">
        <?php
            echo "Witoj na glownej stronie " . @$_SESSION['login'] . "!";
        ?>
    </div>
    <div id="sign_out">
        <a href="sign_out.php">Sign out</a>
    </div>
</div>

</body>
</html>