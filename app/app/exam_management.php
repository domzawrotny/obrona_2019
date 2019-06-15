<?php

session_start();


function getItemId($query,$db_connection, $indexId) {
    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
        die("Error occured while attempting to connect to the datebase!");

    }
    else {

//            $head_exam_id_query = "SELECT lecturer_id FROM lecturer WHERE  CONCAT(title,' ',surname,' ',firstname) = '$exam_head'";
        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
            echo "Invalid query!";
        }
        else {
            while ($row = $result->fetch_assoc()) {
                return $row[$indexId];
            }
        }
    }
}

function getNextExamGroupId ($db_connection) {
    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
        die("Error occured while attempting to connect to the datebase!");

    }
    else {
        $query = "SELECT MAX(exam_group_id) AS current_index FROM exam_group;";
        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
            echo "Invalid query!";
        }
        else {
            while ($row = $result->fetch_assoc()) {
                return $row['current_index']+1;
            }
        }
    }
}

function addToExamGroup ($db_connection, $nextIndex, $student_id, $promotor_id, $reviewer_id) {
    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
        die("Error occured while attempting to connect to the datebase!");

    }
    else {
        $query = "INSERT INTO exam_group (exam_group_id, PK_student_id, PK_promotor_id ,PK_reviewer_id) VALUES ($nextIndex,$student_id,$promotor_id,$reviewer_id)";
        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
            echo $query."</br>";
            echo "Invalid query!";
        }
    }
}

function addToExamGroupwWithoutReviewer ($db_connection, $nextIndex, $student_id, $promotor_id) {
    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
        die("Error occured while attempting to connect to the datebase!");

    }
    else {
        $query = "INSERT INTO exam_group (exam_group_id, PK_student_id, PK_promotor_id ) VALUES ($nextIndex,$student_id,$promotor_id)";
        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
            echo $query."</br>";
            echo "Invalid query!";
        }
    }
}

function createExamCommission ($db_connection, $start_time, $end_time, $exam_date, $group1_id, $group2_id, $group3_id, $group4_id, $exam_head_id, $room_id, $faculty_id) {
    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
        die("Error occured while attempting to connect to the datebase!");

    }
    else {
        $query = "INSERT INTO exam_commission 
        (
              PK_leader_id
            , PK_room_id
            , PK_faculty_id
            , PK_exam_group_1_id
            , PK_exam_group_2_id
            , PK_exam_group_3_id
            , PK_exam_group_4_id
            , start_time
            , end_time
            , exam_date
            , exam_confirmed) VALUES  
        (
              '$exam_head_id'
            , '$room_id'
            , '$faculty_id'
            , '$group1_id'
            , '$group2_id'
            , '$group3_id'
            , '$group4_id'
            , '$start_time'
            , '$end_time'
            , '$exam_date'
            , 'FALSE'
            
        )";
        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
            echo $query."</br>";
            echo "Invalid query!";
        }
        else {
            $_SESSION['exam_commission'] = 'Egzamin zostal utworzony!';
            header('Location: add_card.php');

        }
    }
}

