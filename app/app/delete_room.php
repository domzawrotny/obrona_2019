<?php
session_start();
require_once ('connect.php');

if (!isSet($_SESSION['signed_in'])) {
    header('Location: index.php');
    exit();
}

if (isSet($_GET['room_id'])) {

    $room_id = $_GET['room_id'];

    $db_connection = new DatabaseConnection();
    $db_connection->establishConnection();

    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
        echo "Error occured while attempting to connect to the datebase!<br/>";
        #die;
    }
    else {
        $query = "DELETE FROM room WHERE room_id='$room_id'";

        if (!($result_1 = $db_connection->getCurrentDBConnection()->query($query))) {
            echo "An error occurred in the query!<br/>";
        }
        else {
            echo "Room deleted!";
            $_SESSION['room_deleted'] = 'Sala usunieta!';
            header('Location: rooms.php');
        }
    }
    $db_connection->dropCurrentConnection();
}
