<?php
    session_start();
    header( 'Cache-Control: no-store, no-cache, must-revalidate' );
    header( 'Cache-Control: post-check=0, pre-check=0', false );
    header( 'Pragma: no-cache' );
    if (!isSet($_SESSION['signed_in']) && ( $_SESSION['permissions'] != 1 )) {
        header('Location: index.php');
        exit();
    }
    if(isSet($_SESSION['user_added']) ) {
        header("Refresh:0");
        unset($_SESSION['user_added']);
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
                                <h4 class="title">Dodaj nowego studenta</h4>
                            </div>
                            <div class ="content table-responsive table-full-width">
                                <div id="content">

                                    <form action="new_student.php" method="post" id="add_new_user_form">
                                        <b>Firstname: </b><br/>
                                        <input type="text" name="firstname" value="" size="30"><br/>
                                        <b>Surname: </b><br/>
                                        <input type="text" name="surname" value="" size="30"><br/>
                                        <b>PESEL: </b><br/>
                                        <input type="text" name="pesel" value="" size="30" maxlength="11"><br/>
                                        <b>Password:</b><br/>
                                        <input type="password" name="user_password" value="" size="30"><br/>
                                        <b>Repeat password:</b><br/>
                                        <input type="password" name="r_user_password" value="" size="30"><br/>
                                        <b>City:</b><br/>
                                        <input type="text" name="city" value="" size="30" maxlength="20"><br/>
                                        <b>Street:</b><br/>
                                        <input type="text" name="street" value="" size="30" maxlength="20"><br/>
                                        <b>House no:</b><br/>
                                        <input type="text" name="house_no" value="" size="30" maxlength="4"><br/><br/>

                                            &nbsp;&nbsp; <a href="new_student.php"><button type="submit" class="btn btn-info btn-fill">Dodaj studenta</button></a>

                                    </form>

                                </div>
                            </div>
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
                                Home
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
        $(document).ready(function () {

            demo.initChartist();

            $.notify({
                icon: 'pe-7s-close-circle',
                message: "<?php echo $_SESSION['error'] ?>"
            }, {
                type: 'danger',
                timer: 4000
            });

        });
    </script>
    <?php
    }
    if(isSet($_SESSION['p_error'])) {
    ?>
    <script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();

            $.notify({
                icon: 'pe-7s-close-circle',
                message: "<?php echo $_SESSION['p_error'] ?>"
            },{
                type: 'danger',
                timer: 4000
            });

        });
    </script>
        <?php
//        unset($_SESSION['p_error']);
    }
    if(isSet($_SESSION['pesel_error'])) {
        ?>
        <script type="text/javascript">
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "<?php echo $_SESSION['pesel_error'] ?>"
                },{
                    type: 'danger',
                    timer: 4000
                });

            });
        </script>
        <?php
//        unset($_SESSION['pesel_error']);
    }
    if(isSet($_SESSION['firstname_error'])) {
        ?>
        <script type="text/javascript">
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "<?php echo $_SESSION['firstname_error'] ?>"
                },{
                    type: 'danger',
                    timer: 4000
                });

            });
        </script>
        <?php
//        unset($_SESSION['firstname_error']);
    }
    if(isSet($_SESSION['surname_error'])) {
        ?>
        <script type="text/javascript">
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "<?php echo $_SESSION['surname_error'] ?>"
                },{
                    type: 'danger',
                    timer: 4000
                });

            });
        </script>
        <?php
//        unset($_SESSION['surname_error']);
    }
?>


</html>