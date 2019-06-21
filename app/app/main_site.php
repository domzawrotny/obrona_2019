    
<?php
 session_start();
 require_once ('connect.php');
 #if (!isSet($_SESSION['signed_in']) || ($_SESSION['permissions']!=2) ) {
 if (!isSet($_SESSION['signed_in'])) {
     header('Location: index.php');
     exit();
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
                                <h4 class="title">Data</h4>
                            </div>
                            <div class="content">
                                 <form action="main_site.php" method="post">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="Date" class="form-control" placeholder="Wybierz datę" value="2005-04-02" name="selected_date">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="main_site.php"><button type="submit" class="btn btn-info btn-fill btn-block pull-right">Wybierz</button></a>
                                        </div>

                                        <?php
                                        if (isSet($_POST['selected_date'])) {
                                            ?>
                                            <script type="text/javascript">
                                                $(document).ready(function(){

                                                    demo.initChartist();

                                                    $.notify({
                                                        icon: 'pe-7s-close-circle',
                                                        message: "<?php echo $_POST['selected_date'] ?>"
                                                    },{
                                                        type: 'danger',
                                                        timer: 4000
                                                    });

                                                });
                                            </script>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Wykaz egzaminów</h4>
                                <?php

                                if (!isSet($_POST['selected_date'])) {
                                    echo "Prosze wybrac date!";
                                }
                                else {
                                    $selected_date = $_POST['selected_date'];


                                    echo '<p class="category">Dla dnia ' . $selected_date . '</p>';
                                }

                                ?>

                            </div>
                            <div class="content table-responsive table-full-width">

                                <?php
                                if (isSet($selected_date)) {
                                    $db_connection = new DatabaseConnection();
                                    $db_connection->establishConnection();

                                    $query = "SELECT COUNT(*) as total_count FROM exam_commission WHERE exam_date = '$selected_date'";

                                    $db_connection->getCurrentDBConnection()->query($query);
                                    if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                        echo "Invalid query!";
                                    }
                                    else {
                                        while ($row = $result->fetch_assoc()) {
                                            $number_of_exams = $row['total_count'];
                                        }
                                    }



                                    if ($number_of_exams == 0) {
                                        echo "Brak egzaminów w danym dniu!"."</br>";
                                    }
                                    else {
                                        $query = "SELECT  CONCAT( b.building_name , ' ' , r.room_name ) AS `room_number`
                                                        , CONCAT(l.title,' ',l.surname,' ',l.firstname) AS `head_fullname`
                                                        , ec.exam_date
                                                        , ec.start_time
                                                        , ec.end_time
                                                        , ec.exam_commission_id
                                                FROM exam_commission AS ec
                                                    INNER JOIN lecturer l on ec.PK_leader_id = l.lecturer_id
                                                    INNER JOIN room r on ec.PK_room_id = r.room_id
                                                    INNER JOIN building b on r.PK_bulding_id = b.building_id
                                                WHERE ec.exam_date = '$selected_date'";

                                        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                            echo "Invalid query!";
                                        }
                                        else {
                                            ?>
                                            <table class="table table-hover table-striped">
                                            <thead>
                                                <th>Sala</th>
                                                <th>Data</th>
                                                <th>Poczatek</th>
                                                <th>Koniec</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['room_number']; ?></td>
                                                    <td><?php echo $row['head_fullname']; ?></td>
                                                    <td><?php echo $row['exam_date']; ?></td>
                                                    <td><?php echo $row['start_time']; ?></td>
                                                    <td><?php echo $row['end_time']; ?></td>
                                                    <td>
<!--                                                        <a href="">Usuń</a>-->
                                                        <div class="col-md-8">
                                                            <button type="submit" class="btn btn-info btn-fill btn-block" onclick="location.href='get_exam_card.php?exam_commission_id=<?php echo $row['exam_commission_id'] ?>&selected_date=<?php echo $selected_date ?>&room_name=<?php echo  $row['room_name']  ?>'">Generuj kartę</button>
                                                        </div>

                                                    </td>
                                                </tr>

                                                <?php

                                            }
                                            ?>
                                            </tbody>
                                            </table>
                                            <?php
                                        }
                                    }

                                }
                                ?>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-md-8">
                                        </div>
                                        <div class="col-md-2">
                                        <button type="submit" class="btn btn-info btn-fill btn-block" onclick="location.href='add_card.php'">Nowy egzamin</button>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-2">
                                        <button type="submit" class="btn btn-success btn-fill btn-block" onclick="location.href='generate_card.php'">Generuj raport</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
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
            unset($_SESSION['error']);
        }
    ?>
    
  



    
</html>
