<?php
session_start();
if (($_SESSION['permissions']!=1) ) {

    header('Location: index.php');
    exit();
}

?>
<html>
<title>
    Reset hasła
</title>
<body>
<?php
    $login_id = $_GET['login_id'];

    echo $login_id;
?>
</body>
</html>
