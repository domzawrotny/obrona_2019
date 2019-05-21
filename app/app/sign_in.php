<?php

    session_start();

    if (!isSet($_POST['login']) || (!isSet($_POST['user_password']))) {
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $db_connection = new DatabaseConnection();
    $db_connection->establishConnection();
    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
        echo "Error occured while attempting to connect to the datebase!<br/>";

    }
    else {
        $login = $_POST['login'];
        $user_password = $_POST['user_password'];

        $login = htmlentities($login,ENT_QUOTES,"UTF-8");

        $sql_query = sprintf("SELECT * FROM user_login WHERE login='%s'",
            mysqli_real_escape_string($db_connection->getCurrentDBConnection(),$login));

        if ($result = @$db_connection->getCurrentDBConnection()->query($sql_query)) {
            $count = $result->num_rows;
            if ($count > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($user_password,$row['password'])) {
                    $_SESSION['login'] = $row['login'];
                    $_SESSION['permissions'] = $row['permissions_id'];
                    unset($_SESSION['error']);
                    $result->free();


                    $_SESSION['signed_in'] = true;
                    header('Location: main_site.php');
                }
                else {
                    $_SESSION['error'] = '<span style="color:red">Incorrect user or password!</span>';
                    $result->free();
                    header('Location: index.php');
                }
            }
            else {
                $_SESSION['error'] = '<span style="color:red">Incorrect user or password!</span>';
                $result->free();
                header('Location: index.php');
            }
        }
        else {
            echo "An error occurred in a query!";
        }

        $db_connection->dropCurrentConnection();
    }
