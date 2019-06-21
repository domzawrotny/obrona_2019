<?php
session_start();
require_once ('connect.php');

if (!isSet($_SESSION['signed_in'])) {
    header('Location: index.php');
    exit();
}

if (isSet($_GET['building'])) {
//    $faculty_id = $_GET['faculty_id'];
    $_SESSION['building'] = $_GET['building'];
}

//}
if ( (isSet($_POST['room_id'])) && isSet($_POST['room_name'])) {
//    echo strlen($_POST['institute_name']) . "</br>";
//    if (strlen($_POST['institute_name']) > 120  ||  strlen($_POST['institute_name']) < 10 )  {
//        $_SESSION['institute_error'] = 'Nazwa instytutu musi zawierac od 10 do 120 znakow!';
//        $validated = false;
//    }
//    else {
//        $institute_name = $_POST['institute_name'];
//        unset($_SESSION['institute_error']);
//    }
//
//    if (strlen($_POST['institute_abbrev']) > 10 || strlen($_POST['institute_abbrev']) < 3 ) {
//        $_SESSION['institute_abbrev_error'] = 'Skrocona nazwa instytutu musi zawierac od 3 do 10 znakow';
//        $validated = false;
//    }
//    else {
//        unset($_SESSION['institute_abbrev_error']);
//        $institute_abbrev = $_POST['institute_abbrev'];
//        $validated = true;
//    }

    $validated = true;

    if ( $validated == true ) {


        $building = $_SESSION['building'];

        $room_id = $_POST['room_id'];
        $room_name = $_POST['room_name'];


        $db_connection = new DatabaseConnection();
        $db_connection->establishConnection();

        if ($db_connection->getCurrentDBConnection()->connect_errno != 0) {
            echo "Error occured while attempting to connect to the datebase!<br/>";
            #die;
        }
        else {
            $query = "INSERT INTO room (room_id, room_name, PK_bulding_id) VALUES 
                    (
                        '$room_id',
                        '$room_name',
                        (SELECT building_id FROM building WHERE building_name = '$building')
                    )";

            echo $query;

            if (!($result_1 = $db_connection->getCurrentDBConnection()->query($query))) {
                echo "An error occurred in the first query!<br/>";
            } else {
                echo "User added!";
                $_SESSION['room_added'] = 'Sala dodana!';
                header('Location: rooms.php');
            }

        }
        $db_connection->dropCurrentConnection();

    }
}

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
                    <a href="personel.php">
                        <i class="pe-7s-id"></i>
                        <p>Personel</p>
                    </a>
                </li>
                <li>
                    <a href="institutes.php">
                        <i class="pe-7s-study"></i>
                        <p>Instytuty</p>
                    </a>
                </li>
                <li>
                    <a href="rooms.php">
                        <i class="pe-7s-door-lock"></i>
                        <p>Sale</p>
                    </a>
                </li>
                <li>
                    <a href="buildings.php">
                        <i class="pe-7s-home"></i>
                        <p>Budynki</p>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
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
                                <h4 class="title">Dodaj sale <br/>

                                <?php

                                foreach ($_POST as $key => $value)
                                    echo $key.'='.$value.'<br />';

                                ?>
                                </h4>
                            </div>

                            <div class="content table-responsive table-full-width">
                                <form action="new_room.php" method="post">
                                    <div class="row">
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                <label for="room_id">ID Sali</label>
                                                <input type="text" class="form-control" placeholder="ID Sali" name="room_id">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pr-1">
                                            <div class="form-group">
                                                <label for="room_name">Nazwa pokoju</label>
                                                <input type="text" class="form-control" placeholder="Nazwa sali" name="room_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1">
                                        </div>

                                        <div class="col-md-3">
                                            <!--                                            <a href="new_institute.php"><button type="submit" class="btn btn-info btn-fill pull-right">Utworz instytut</button></a>-->
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Dodaj sale</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
    unset($_SESSION['error']);
}
?>


</html>