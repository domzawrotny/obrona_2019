<?php
    session_start();

    require_once ('connect.php');

//    echo $_GET['exam_commission_id'];
    if (!isSet($_SESSION['signed_in'])) {
        header('Location: index.php');
        exit();
    }

    $exam_id = $_GET['exam_commission_id'];
    $room_name = $_GET['room_name'];

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>PLED - Planer Egzaminów Dyplomowych</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <!-- Notifs -->
    <script src="assets/js/demo.js"></script>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    Planer Egzaminów Dyplomowych
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="main_site.php">
                        <i class="pe-7s-note2"></i>
                        <p>Karty</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-id"></i>
                        <p>Personel</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-study"></i>
                        <p>Instytuty</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-door-lock"></i>
                        <p>Sale</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-home"></i>
                        <p>Budynki</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-user"></i>
                        <p>Twój profil</p>
                    </a>
                </li>
                <li>
                    <a href="sign_out.php">
                        <i class="pe-7s-close-circle"></i>
                        <p>Wyloguj</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">PLED - Planer Egzaminów Dyplomowych</a>
                </div>
                <div class="collapse navbar-collapse">
                         <ul class="nav navbar-nav navbar-right">
                         <?php
                            if (($_SESSION['permissions']==1)) {
                         ?>
                         <li>
                           <a href="user_management.php">
                               <p>Zarządzaj użytkownikami</p>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                        <li>
                           <a href="#">
                            <p><?php
                            echo @$_SESSION['login'];
                            ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="sign_out.php">
                                <p>Wyloguj</p>
                            </a>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Generuj karte lub zaaakceptuj egzamin <?php echo $exam_id ?></h4>
                                <p class="category">Data: <?php echo  $_GET['selected_date']    ?></p>
                                <p class="category">Pomieszczenie: <?php echo $_GET['room_name']    ?></p>


                                <table class="table table-hover">
                                    <thead>
                                        <th>Godzina rozpoczecia</th>
                                        <th>Dyplomant</th>
                                        <th>Przewodniczacy komisji</th>
                                        <th>Promotor</th>
                                        <th>Recenznent</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $db_connection = new DatabaseConnection();
                                        $db_connection->establishConnection();

                                        if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                            die("Error occured while attempting to connect to the datebase!");

                                        }
                                        else {
                                            $query = "SELECT  ec.exam_commission_id
                                                        , ec.PK_exam_group_1_id
                                                        , ec.PK_exam_group_2_id
                                                        , ec.PK_exam_group_3_id
                                                        , ec.PK_exam_group_4_id
                                                        , ec.PK_leader_id
                                                        , eg1.PK_student_id as g1_id_student
                                                        , eg1.PK_promotor_id as g1_id_promotor
                                                        , eg1.PK_reviewer_id as g1_id_reviewer
                                                        , eg2.PK_student_id as g2_id_student
                                                        , eg2.PK_promotor_id as g2_id_promotor
                                                        , eg2.PK_reviewer_id as g2_id_reviewer
                                                        , eg3.PK_student_id as g3_id_student
                                                        , eg3.PK_promotor_id as g3_id_promotor
                                                        , eg3.PK_reviewer_id as g3_id_reviewer
                                                        , eg4.PK_student_id as g4_id_student
                                                        , eg4.PK_promotor_id as g4_id_promotor
                                                        , eg4.PK_reviewer_id as g4_id_reviewer
                                                        , ec.start_time
                                                        , ec.start_time
                                                        , ec.exam_date
                                                        , ec.exam_confirmed
                                                FROM EXAM_COMMISSION AS ec
                                                INNER JOIN faculty AS f ON ec.PK_faculty_id=f.faculty_id
                                                INNER JOIN exam_group eg1 on ec.PK_exam_group_1_id = eg1.exam_group_id
                                                INNER JOIN exam_group eg2 on ec.PK_exam_group_2_id = eg2.exam_group_id
                                                INNER JOIN exam_group eg3 on ec.PK_exam_group_3_id = eg3.exam_group_id
                                                INNER JOIN exam_group eg4 on ec.PK_exam_group_4_id = eg4.exam_group_id
                                                WHERE exam_commission_id = '$exam_id' ";

                                            if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                echo "Invalid query!";
                                            }
                                            else {
                                                while ($row = $result->fetch_assoc()) {


                                                    $head_id = $row['PK_leader_id'];
                                                    $student_id_1 = $row['g1_id_student'];
                                                    $student_id_2 = $row['g2_id_student'];
                                                    $student_id_3 = $row['g3_id_student'];
                                                    $student_id_4 = $row['g4_id_student'];
                                                    $promotor_id_1 = $row['g1_id_promotor'];
                                                    $promotor_id_2 = $row['g2_id_promotor'];
                                                    $promotor_id_3 = $row['g3_id_promotor'];
                                                    $promotor_id_4 = $row['g4_id_promotor'];
                                                    $reviewer_id_1 = $row['g1_id_reviewer'];
                                                    $reviewer_id_2 = $row['g2_id_reviewer'];
                                                    $reviewer_id_3 = $row['g3_id_reviewer'];
                                                    $reviewer_id_4 = $row['g4_id_reviewer'];
                                                    $start_time = $row['start_time'];
                                                    $exam_group_1 = $row['PK_exam_group_1_id'];
                                                    $exam_group_2 = $row['PK_exam_group_2_id'];
                                                    $exam_group_3 = $row['PK_exam_group_3_id'];
                                                    $exam_group_4 = $row['PK_exam_group_4_id'];
                                                    $exam_date = $row['exam_date'];


                                                    ?>
                                                    <tr>

                                                        <td>
                                                            <?php

//                                                                echo $head_id;
                                                                echo $start_time;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(surname,' ',firstname) as full_student_name from student WHERE student_id='$student_id_1'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_student_name'];
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $db_connection = new DatabaseConnection();
                                                            $db_connection->establishConnection();
//                                                            echo $head_id;
                                                            if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                die("Error occured while attempting to connect to the datebase!");

                                                            }
                                                            else {
                                                                $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$head_id'";
//echo $query;
                                                                if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                    echo "Invalid query!";
                                                                }
                                                                else {

                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo $row['full_head_name'];
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $db_connection = new DatabaseConnection();
                                                            $db_connection->establishConnection();

                                                            if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                die("Error occured while attempting to connect to the datebase!");

                                                            }
                                                            else {
                                                                $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$promotor_id_1'";
//echo $query;
                                                                if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                    echo "Invalid query!";
                                                                }
                                                                else {

                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo $row['full_head_name'];
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if ($reviewer_id_1 == null ) {
                                                                    echo '-';
                                                                }
                                                                else {
                                                                    $db_connection = new DatabaseConnection();
                                                                    $db_connection->establishConnection();

                                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                        die("Error occured while attempting to connect to the datebase!");

                                                                    }
                                                                    else {
                                                                        $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$reviewer_id_1'";
//echo $query;
                                                                        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                            echo "Invalid query!";
                                                                        }
                                                                        else {

                                                                            while ($row = $result->fetch_assoc()) {
                                                                                echo $row['full_head_name'];
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    if ($exam_group_2 != 1) {
                                                        ?>
                                                        <tr>

                                                            <td>
                                                                <?php

                                                                    $start_time = strtotime("15 minutes", strtotime($start_time));
                                                                    $start_time = date('H:i:s',$start_time);
                                                                    echo $start_time;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(surname,' ',firstname) as full_student_name from student WHERE student_id='$student_id_2'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_student_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                //                                                            echo $head_id;
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$head_id'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();

                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$promotor_id_2'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($reviewer_id_2 == null ) {
                                                                    echo '-';
                                                                }
                                                                else {
                                                                    $db_connection = new DatabaseConnection();
                                                                    $db_connection->establishConnection();

                                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                        die("Error occured while attempting to connect to the datebase!");

                                                                    }
                                                                    else {
                                                                        $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$reviewer_id_2'";

                                                                        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                            echo "Invalid query!";
                                                                        }
                                                                        else {

                                                                            while ($row = $result->fetch_assoc()) {
                                                                                echo $row['full_head_name'];
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    if ( $exam_group_3 != 1) {
                                                        ?>
                                                        <tr>

                                                            <td>
                                                                <?php

                                                                $start_time = strtotime("15 minutes", strtotime($start_time));
                                                                $start_time = date('H:i:s',$start_time);
                                                                echo $start_time;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(surname,' ',firstname) as full_student_name from student WHERE student_id='$student_id_3'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_student_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                //                                                            echo $head_id;
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$head_id'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();

                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$promotor_id_3'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($reviewer_id_3 == null ) {
                                                                    echo '-';
                                                                }
                                                                else {
                                                                    $db_connection = new DatabaseConnection();
                                                                    $db_connection->establishConnection();

                                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                        die("Error occured while attempting to connect to the datebase!");

                                                                    }
                                                                    else {
                                                                        $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$reviewer_id_3'";

                                                                        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                            echo "Invalid query!";
                                                                        }
                                                                        else {

                                                                            while ($row = $result->fetch_assoc()) {
                                                                                echo $row['full_head_name'];
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php

                                                    }
                                                    if ( $exam_group_4 != 1) {
                                                        ?>
                                                        <tr>

                                                            <td>
                                                                <?php

                                                                $start_time = strtotime("15 minutes", strtotime($start_time));
                                                                $start_time = date('H:i:s',$start_time);
                                                                echo $start_time;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(surname,' ',firstname) as full_student_name from student WHERE student_id='$student_id_4'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_student_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();
                                                                //                                                            echo $head_id;
                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$head_id'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $db_connection = new DatabaseConnection();
                                                                $db_connection->establishConnection();

                                                                if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                    die("Error occured while attempting to connect to the datebase!");

                                                                }
                                                                else {
                                                                    $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$promotor_id_4'";

                                                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                        echo "Invalid query!";
                                                                    }
                                                                    else {

                                                                        while ($row = $result->fetch_assoc()) {
                                                                            echo $row['full_head_name'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($reviewer_id_4 == null ) {
                                                                    echo '-';
                                                                }
                                                                else {
                                                                    $db_connection = new DatabaseConnection();
                                                                    $db_connection->establishConnection();

                                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                                        die("Error occured while attempting to connect to the datebase!");

                                                                    }
                                                                    else {
                                                                        $query = "SELECT CONCAT(title, ' ' ,surname,' ',firstname) as full_head_name from lecturer WHERE lecturer_id='$reviewer_id_4'";

                                                                        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                            echo "Invalid query!";
                                                                        }
                                                                        else {

                                                                            while ($row = $result->fetch_assoc()) {
                                                                                echo $row['full_head_name'];
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>

                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Zatwierdź egzamin</label>
                                                <button type="submit" class="btn btn-info btn-fill btn-block" onclick="location.href='approve_exam.php'">Zaakceptuj egzamin</button>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Generuj kartę</label>
                                                <button type="submit" class="btn btn-info btn-fill btn-block" onclick="location.href='new_exam_card.php?exam_commission_id=<?php echo $exam_id ?>&exam_date=<?php echo $exam_date ?>&room_name=<?php echo  $room_name  ?>'">Generuj kartę</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="clearfix"></div>
                            </form>
                            </div>
                        </div>
                    </div>

                </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Powrót do góry
                            </a>
                        </li>

                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="https://www.uz.zgora.pl/">Uniwersytet Zielonogórski</a>
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods  -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

     <!-- Notifications -->
	<script src="assets/js/demo.js"></script>

    <?php
        if (isSet($_SESSION['error'])) {
            ?>
            <script type="text/javascript">
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "<?php echo $_SESSION['error'] ?>"
                },{
                    type: 'danger',
                    timer: 4000
                });

            });
        </script>
        <?php
        }
    ?>






</html>
