<?php
session_start();
require_once "connect.php";
require_once "generator.php";
require_once "check_pesel.php";

if (!isSet($_SESSION['signed_in']) && ( $_SESSION['permissions'] != 1 || $_SESSION['permissions'] != 4 )) {
    header('Location: index.php');
    exit();
}
//if ((!(isSet($_POST['firstname']))) ||
//    (!(isSet($_POST['surname']))) ||
//    (!(isSet($_POST['user_password']))) ||
//    (!(isSet($_POST['pesel'])))
//) {
//    header('Location: add_new_student.php');
//    exit();
//}
?>
<html>
<head>
    <title> Add new student </title>
<!--    <link rel="stylesheet" href="../lib/css/style.css" type="text/css" />-->
</head>

<body>
<div id="container">

    <div id="go_back">
        <a href="javascript:history.go(-1)" title="Return to previous page">&laquo; Go back</a>
    </div>

    <div id="sign_out">
        <a href="../index.php">Main site</a>
        <a href="../sign_out.php">Sign out</a>
    </div>
    <div class="clear"></div>
    <?php
    $db_connection = new DatabaseConnection();
    $db_connection->establishConnection();
    $loginGenerator = new MyGenerator();
    $peselValidator = new CheckPesel();



    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
        die("Error occured while attempting to connect to the datebase!");
        $_SESSION['user_added'] = false;


    }
    else {
        $firstname = htmlentities($_POST['firstname'],ENT_QUOTES,"UTF-8");
        $surname = htmlentities($_POST['surname'],ENT_QUOTES,"UTF-8");
        $password = htmlentities($_POST['user_password'],ENT_QUOTES,"UTF-8");
        $r_password  = htmlentities($_POST['r_user_password'],ENT_QUOTES,"UTF-8");
        $pesel = htmlentities($_POST['pesel'],ENT_QUOTES,"UTF-8");
        $city = htmlentities($_POST['city'],ENT_QUOTES,"UTF-8");
        $street = htmlentities($_POST['street'],ENT_QUOTES,"UTF-8");
        $house_no = htmlentities($_POST['house_no'],ENT_QUOTES,"UTF-8");
        $birth_date = htmlentities($_POST['birth_date'],ENT_QUOTES,"UTF-8"); // add converting !!!!


//        if (empty($_POST['student_group_name']) == true) {
//            $_SESSION['g_error'] = '<span style="color:red">A group must be chosen!<br/></span>';
//            $validated = false;
//        }
//        else {
//            unset($_SESSION['g_error']);
//            $student_group_name = htmlentities($_POST['student_group_name'],ENT_QUOTES,"UTF-8");
//        }


        if (strlen($firstname) < 4 ) {
            $_SESSION['firstname_error'] = '<span style="color:red">First name is too short!<br/></span>';
            $validated = false;
        }
        else {
            unset($_SESSION['firstname_error']);
//                if (ctype_alpha($firstname) == false ) {
//                    $validated = false;
//                    $_SESSION['firstname_error'] = '<span style="color:red">First name must not contain special characters!<br/></span>';
//                }
//                else {
//                    unset($_SESSION['firstname_error']);
//                }
        }

        if (strlen($surname) < 4 ) {
            $_SESSION['surname_error'] = '<span style="color:red">Surname is too short!<br/></span>';
            $validated = false;
        }
        else {
            unset($_SESSION['surname_error']);
//                if (ctype_alpha($firstname) == false ) {
//                    $validated = false;
//                    $_SESSION['surname_error'] = '<span style="color:red">Surname must not contain special characters!<br/></span>';
//                }
//                else {
//                    unset($_SESSION['surname_error']);
//                }

        }


        if ($peselValidator->checkLength($pesel) == true) {
            unset($_SESSION['pesel_error']);
            $birth_date = $peselValidator->getDateFromPesel($pesel);

            if ($birth_date==false){
                $_SESSION['pesel_error'] =  'Incorrect PESEL given!' ; # '<span style="color:red">Incorrect PESEL given!<br/></span>';
                $validated = false;
            }
            else {
                unset($_SESSION['pesel_error']);
            }
        }
        else {
            $_SESSION['pesel_error'] = 'PESEL consists of 11 digits!' ; # '<span style="color:red">PESEL consists of 11 digits!<br/></span>';
            $validated = false;
        }


        if ($r_password!=$password) {
            $_SESSION['p_error'] = 'Passwords are not equal!' ; #'<span style="color:red">Passwords are not equal!<br/></span>';
            $validated = false;
        }
        else {
            unset($_SESSION['p_error']);
            if (strlen($password) < 4 ) {
                $_SESSION['p_error'] =  'Password is too short!' ; #'<span style="color:red">Password is too short!<br/></span>';
                $validated = false;
            }
            else {
                unset($_SESSION['p_error']);
                $password = password_hash($password,PASSWORD_DEFAULT);
            }
        }

        if ($validated == false ) {
            header('Location: add_new_student.php');
        }

        $login = $loginGenerator->generateLogin($firstname,$surname,$db_connection);
        $emailAddress = $loginGenerator->generateEmailAddress($login);

        $login_permissions_query = "INSERT INTO user_login (login,password,permissions_id, email_address)
                                        VALUES
                                        (
                                          '$login',
                                          '$password',
                                          (SELECT permissions_id FROM user_permissions WHERE permissions_type='student'),
                                          '$emailAddress'
                                        )";
//
        $student_query = "INSERT INTO student (surname, firstname, login_id, pesel, city, street, house_no, birth_date)
                                  VALUES
                                  (
                                    '$surname',
                                    '$firstname',
                                    (SELECT login_id FROM user_login WHERE login='$login'),
                                    '$pesel',
                                    '$city',
                                    '$street',
                                    '$house_no',
                                    '$birth_date'
                                  )";

            echo $login_permissions_query."<br/>";
            echo $student_query."<br/>";

//        $loginGenerator->newUser($firstname,$surname,$login,$db_connection,$login_permissions_query,$student_query);
        $_SESSION['user_added'] = true;
        $db_connection->dropCurrentConnection();

    }

    ?>
</div>
</body>
</html>
