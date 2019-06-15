<?php
//    session_start();

    require_once "connect.php";
    require_once "exam_management.php";
#if (!isSet($_SESSION['signed_in']) || ($_SESSION['permissions']!=2) ) {
    if (!isSet($_SESSION['signed_in'])) {
        header('Location: index.php');
        exit();
    }
    if ((!(isSet($_POST['date']))) ||
        (!(isSet($_POST['faculty']))) ||
        (!(isSet($_POST['building']))) ||
        (!(isSet($_POST['room']))) ||
        (!(isSet($_POST['exam_head']))) ||
        (!(isSet($_POST['time']))) ||
        (!(isSet($_POST['student1']))) ||
        (!(isSet($_POST['promotor1'])))
    ) {
        $_SESSION['v_error'] = "Trzeba wypelnic wszystkie wymagane pola!";
        unset($_SESSION['exam_commission']);
        header('Location: add_card.php');
        exit();
    }
    else {
        unset($_SESSION['v_error']);
    }

    $exam_head = $_POST['exam_head'];
    $student1 = $_POST['student1'];
    $promotor1 = $_POST['promotor1'];
    $building = $_POST['building'];
    $room = $_POST['room'];
    $faculty = $_POST['faculty'];
    $start_time = $_POST['time'];
    $exam_date = $_POST['date'];

    $db_connection = new DatabaseConnection();
    $db_connection->establishConnection();



    $query = "SELECT building_id FROM building WHERE building_name = '$building'";
    $building_id = getItemId($query,$db_connection,'building_id');


    $query = "SELECT room_id FROM room WHERE  room_name = '$room'";
    $room_id = getItemId($query,$db_connection,'room_id');

    $query = "SELECT faculty_id FROM faculty WHERE  faculty_name = '$faculty'";
    $faculty_id = getItemId($query,$db_connection,'faculty_id');


    $query = "SELECT lecturer_id FROM lecturer WHERE  CONCAT(title,' ',surname,' ',firstname) = '$exam_head'";
    $exam_head_id = getItemId($query,$db_connection,'lecturer_id');

    $query = "SELECT student_id FROM student WHERE  CONCAT(surname,' ',firstname) = '$student1'";
    $student1_id = getItemId($query,$db_connection,'student_id');

    $query = "SELECT lecturer_id FROM lecturer WHERE  CONCAT(title,' ',surname,' ',firstname) = '$promotor1'";
    $promotor1_id = getItemId($query,$db_connection,'lecturer_id');



    $group1_id = getNextExamGroupId($db_connection);

    if (isSet($_POST['reviewer1'])) {
        $reviewer1 = $_POST['reviewer1'];
        $query = "SELECT lecturer_id FROM lecturer WHERE  CONCAT(title,' ',surname,' ',firstname) = '$reviewer1'";
        $reviewer1_id = getItemId($query,$db_connection,'lecturer_id');
        addToExamGroup($db_connection,$group1_id,$student1_id,$promotor1_id,$reviewer1_id);
    }
    else {
        addToExamGroupwWithoutReviewer($db_connection,$group1_id,$student1_id,$promotor1_id);

    }




    if ((isSet($_POST['promotor2'])) && (isSet($_POST['student2']))) {
        $student2 = $_POST['student2'];
        $promotor2 = $_POST['promotor2'];

        $query = "SELECT student_id FROM student WHERE  CONCAT(surname,' ',firstname) = '$student2'";
        $student2_id = getItemId($query,$db_connection,'student_id');

        $query = "SELECT lecturer_id FROM lecturer WHERE  CONCAT(title,' ',surname,' ',firstname) = '$promotor2'";
        $promotor2_id = getItemId($query,$db_connection,'lecturer_id');

        $group2_id = getNextExamGroupId($db_connection);

        if (isSet($_POST['reviewer2'])) {
            $reviewer2 = $_POST['reviewer2'];
            $query = "SELECT lecturer_id FROM lecturer WHERE  CONCAT(title,' ',surname,' ',firstname) = '$reviewer2'";
            $reviewer2_id = getItemId($query,$db_connection,'lecturer_id');
            addToExamGroup($db_connection,$group2_id,$student2_id,$promotor2_id,$reviewer2_id);
        }
        else {
            addToExamGroupwWithoutReviewer($db_connection,$group2_id,$student2_id,$promotor2_id);
        }


        $student2 = true;
    }
    else {
        $student2 = false;
    }

    if ((isSet($_POST['promotor3'])) && (isSet($_POST['student3']))) {
        $student3 = $_POST['student3'];
        $promotor3 = $_POST['promotor3'];

        $query = "SELECT student_id FROM student WHERE  CONCAT(surname,' ',firstname) = '$student3'";
        $student3_id = getItemId($query,$db_connection,'student_id');

        $query = "SELECT lecturer_id FROM lecturer WHERE  CONCAT(title,' ',surname,' ',firstname) = '$promotor3'";
        $promotor3_id = getItemId($query,$db_connection,'lecturer_id');


        $group3_id = getNextExamGroupId($db_connection);

        if (isSet($_POST['reviewer3'])) {
            $reviewer3 = $_POST['reviewer3'];
            $query = "SELECT lecturer_id FROM lecturer WHERE  CONCAT(title,' ',surname,' ',firstname) = '$reviewer3'";
            $reviewer3_id = getItemId($query,$db_connection,'lecturer_id');
            addToExamGroup($db_connection,$group3_id,$student3_id,$promotor3_id,$reviewer3_id);
        }
        else {
            addToExamGroupwWithoutReviewer($db_connection,$group3_id,$student3_id,$promotor3_id);
        }


        $student3 = true;
    }
    else {
        $student3 = false;
    }

    if ((isSet($_POST['promotor4'])) && (isSet($_POST['student4']))) {
        $student4 = $_POST['student4'];
        $promotor4 = $_POST['promotor4'];

        $query = "SELECT student_id FROM student WHERE  CONCAT(surname,' ',firstname) = '$student4'";
        $student4_id = getItemId($query,$db_connection,'student_id');

        $query = "SELECT lecturer_id FROM lecturer WHERE  CONCAT(title,' ',surname,' ',firstname) = '$promotor4'";
        $promotor4_id = getItemId($query,$db_connection,'lecturer_id');

        $group4_id = getNextExamGroupId($db_connection);

        if (isSet($_POST['reviewer4'])) {
            $reviewer4 = $_POST['reviewer4'];
            $query = "SELECT lecturer_id FROM lecturer WHERE  CONCAT(title,' ',surname,' ',firstname) = '$reviewer4'";
            $reviewer4_id = getItemId($query,$db_connection,'lecturer_id');
            addToExamGroup($db_connection,$group4_id,$student4_id,$promotor4_id,$reviewer4_id);

        }
        else {
            addToExamGroupwWithoutReviewer($db_connection,$group4_id,$student4_id,$promotor4_id);
        }



        $student4 = true;
    }
    else {
        $student4 = false;
    }

    $total_count = 1;
    if ($student2 == false) {
        $st2 = 1;
    }
    else {
        $st2 = $group2_id;
        $total_count++;
    }

    if ($student3 == false) {
        $st3 = 1;
    }
    else {
        $st3 = $group3_id;
        $total_count++;
    }

    if ($student4 == false) {
        $st4 = 1;
    }
    else {
        $st4 = $group4_id;
        $total_count++;
    }


    $total_time = ($total_count * 15);
    $end_time = strtotime("$total_time minutes", strtotime($start_time));
    $end_time = date('H:i',$end_time);

    createExamCommission($db_connection,$start_time,$end_time, $exam_date,$group1_id,$st2,$st3,$st4,$exam_head_id,$room_id,$faculty_id);

//    function setUpExamCommission($student2, $group2_id, $student3, $group $student4) {
//
//    }