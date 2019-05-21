<?php
session_start();
if (!isSet($_SESSION['permissions'])){
    header('Location: index.php');
    exit();
}
switch ($_SESSION['permissions']) {
    case 1:
        header('Location: main_websites/admin.php');
        break;
    case 2:
        header('Location: main_websites/student.php');
        break;
    case 3:
        header('Location: main_websites/lecturer.php');
        break;
    case 4:
        header('Location: main_websites/deans_office.php');
        break;
    default:
        //
}
?>