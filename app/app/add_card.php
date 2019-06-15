    
<?php
 session_start();
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
                                <h4 class="title">Edycja karty</h4>
                                <p class="category">Wybierz lub wpisz wartości w poniższych kategoriach</p>
                            </div>
                            <div class="content">
                                <form action="validate_exam.php" method="post" id="add_new_exam">
                                    <div class="row">
                                        <div class="header">
                                            <h5 class="title">Czas i miejsce</h5>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="date" class="form-control" placeholder="Wybierz datę" value="2005-04-02" name="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label>Wydział</label>
                                            <div class="dropdown">
                                                <select class="form-control" id="faculty" name="faculty">
                                                    <option value="" selected disabled hidden>Wybierz wydzial</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT * from faculty";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['faculty_name'] ?></option>

                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Budynek</label>

                                            <div class="dropdown">
                                                <select class="form-control" id="building" name="building">
                                                    <option value="" selected disabled hidden>Wybierz budynek</option>

                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT * from building";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['building_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Sala</label>
                                            <div class="dropdown">
                                                <select class="form-control" id="room" name="room">
                                                    <option value="" selected disabled hidden>Wybierz sale</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT * from room";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['room_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="header">
                                            <h5 class="title">Skład komisji</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Przewodniczący</label>
                                            <div class="dropdown">
                                                <select class="form-control" id="exam_head" name="exam_head">
                                                    <option value="" selected disabled hidden>Wybierz przewodniczacego komisji:</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT lecturer_id, CONCAT(title,' ',surname,' ',firstname) as full_lecturer_name FROM lecturer WHERE independent_employee = 1;";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_lecturer_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="header">
                                            <h5 class="title">Dyplomanci</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Godzina</label>
                                            <div class="form-group">
                                                <input type="time" class="form-control" placeholder="Imię i nazwisko" name="time">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Dyplomant</label>
                                            <div class="dropdown">
                                                <select class="form-control" id="student1" name="student1">
                                                    <option value="" selected disabled hidden>Wybierz dyplomanta</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT student_id,CONCAT(surname,' ',firstname) as full_student_name FROM student";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_student_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Promotor</label>
                                            <div class="dropdown">
                                                <select class="form-control" id="promotor1" name="promotor1">
                                                    <option value="" selected disabled hidden>Wybierz promotora</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT lecturer_id, CONCAT(title,' ',surname,' ',firstname) as full_lecturer_name FROM lecturer";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_lecturer_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Recenzent</label>
                                            <div class="dropdown">
                                                <select class="form-control" id="reviewer1" name="reviewer1">
                                                    <option value="" selected disabled hidden>Wybierz recenzenta</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT lecturer_id, CONCAT(title,' ',surname,' ',firstname) as full_lecturer_name FROM lecturer ";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_lecturer_name'] ?></option>>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-control" id="student2" name="student2">
                                                    <option value="" selected disabled hidden>Wybierz dyplomanta</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT student_id,CONCAT(surname,' ',firstname) as full_student_name FROM student";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_student_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-control" id="promotor2" name="promotor2">
                                                    <option value="" selected disabled hidden>Wybierz promotora</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT lecturer_id, CONCAT(title,' ',surname,' ',firstname) as full_lecturer_name FROM lecturer";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_lecturer_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-control" id="reviewer2" name="reviewer2">
                                                    <option value="" selected disabled hidden>Wybierz recenzenta</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT lecturer_id, CONCAT(title,' ',surname,' ',firstname) as full_lecturer_name FROM lecturer ";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_lecturer_name'] ?></option>>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-control" id="student3" name="student3">
                                                    <option value="" selected disabled hidden>Wybierz dyplomanta</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT student_id,CONCAT(surname,' ',firstname) as full_student_name FROM student";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_student_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-control" id="promotor3" name="promotor3">
                                                    <option value="" selected disabled hidden>Wybierz promotora</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT lecturer_id, CONCAT(title,' ',surname,' ',firstname) as full_lecturer_name FROM lecturer";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_lecturer_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-control" id="reviewer3" name="reviewer3">
                                                    <option value="" selected disabled hidden>Wybierz recenzenta</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT lecturer_id, CONCAT(title,' ',surname,' ',firstname) as full_lecturer_name FROM lecturer ";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_lecturer_name'] ?></option>>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-control" id="student4" name="student4">
                                                    <option value="" selected disabled hidden>Wybierz dyplomanta</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT student_id,CONCAT(surname,' ',firstname) as full_student_name FROM student";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_student_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-control" id="promotor4" name="promotor4">
                                                    <option value="" selected disabled hidden>Wybierz promotora</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT lecturer_id, CONCAT(title,' ',surname,' ',firstname) as full_lecturer_name FROM lecturer";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_lecturer_name'] ?></option>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dropdown">
                                                <select class="form-control" id="reviewer4" name="reviewer4">
                                                    <option value="" selected disabled hidden>Wybierz recenzenta</option>
                                                    <?php
                                                    require_once ('connect.php');
                                                    $db_connection = new DatabaseConnection();
                                                    $db_connection->establishConnection();

                                                    if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
                                                        echo "Error occured while attempting to connect to the datebase!<br/>";
                                                        #die;
                                                    }
                                                    else {
                                                        $query = "SELECT lecturer_id, CONCAT(title,' ',surname,' ',firstname) as full_lecturer_name FROM lecturer ";

                                                        $result = $db_connection->getCurrentDBConnection()->query($query);

                                                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)): ?>
                                                            <option><?= $row['full_lecturer_name'] ?></option>>
                                                        <?php endwhile; ?>
                                                        <?php
                                                    }
                                                    $db_connection->dropCurrentConnection();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Zatwierdź</label>
<!--                                            <input type="button" class="btn btn-info btn-fill btn-block pull-right" value="Potwierdź" >-->
                                            <a href="validate_exam.php"><button type="submit" class="btn btn-info btn-fill btn-block pull-right">Potwierdz</button></a>
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
        if (isSet($_SESSION['v_error'])) {
            ?>
            <script type="text/javascript">
            $(document).ready(function(){
        
                demo.initChartist();
        
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "<?php echo $_SESSION['v_error'] ?>"
                },{
                    type: 'danger',
                    timer: 4000
                });
        
            });
        </script> 
        <?php
        }
    ?>
    <?php
    if (isSet($_SESSION['exam_commission'])) {
        ?>
        <script type="text/javascript">
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "<?php echo $_SESSION['exam_commission'] ?>"
                },{
                    type: 'success',
                    timer: 4000
                });

            });
        </script>
        <?php
    }
    ?>
  



    
</html>
