<?php
    session_start();
    require_once ('connect.php');

    if (!isSet($_SESSION['signed_in'])) {
        header('Location: index.php');
        exit();
    }

    if (isSet($_SESSION['faculty_id'])) {
        unset($_SESSION['faculty_id']);
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
                                <h4 class="title">Instytuty</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <div class="content">
                                    <form action="institutes.php" method="post" id="faculty">

                                        <div class="row">
                                            <div class="header">
                                                <h5 class="title">Wydzialy</h5>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="dropdown">
                                                    <select class="form-control" id="wydzial" name="wydzial">
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
                                                            $query = "SELECT * FROM faculty";

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
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Zatwierdź</label>
                                                <!--                                            <input type="button" class="btn btn-info btn-fill btn-block pull-right" value="Potwierdź" >-->
                                                <a href="validate_exam.php"><button type="submit" class="btn btn-success btn-fill btn-block pull-right">Potwierdz</button></a>
                                            </div>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <h4 class="title"> Instytuty </h4>
                                                <?php

                                                if (!isSet($_POST['wydzial'])) {
                                                    echo "Prosze wybrac wydzial!";
                                                }
                                                else {
                                                    $faculty = $_POST['wydzial'];


                                                    echo '<p class="category">Dla wydzialu: ' . $faculty . '</p>';
                                                }

                                                ?>
                                                <div class="content table-responsive table-full-width">

                                                    <?php
                                                    if (isSet($faculty)) {
                                                        unset($_SESSION['institute_added']);
                                                        $db_connection = new DatabaseConnection();
                                                        $db_connection->establishConnection();

                                                        $query = "SELECT COUNT(*) AS total_count FROM institute AS i INNER JOIN faculty as f on i.FK_faculty_id = f.faculty_id WHERE F.faculty_name = '$faculty'";

                                                        $db_connection->getCurrentDBConnection()->query($query);
                                                        if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                            echo "Invalid query!";
                                                        }
                                                        else {
                                                            while ($row = $result->fetch_assoc()) {
                                                                $number_of_institutes = $row['total_count'];
                                                            }
                                                        }



                                                        if ($number_of_institutes == 0) {
                                                            echo "Brak instytutów dla zadanego wydzialu!"."</br>";

                                                            $query = "SELECT faculty_id FROM faculty WHERE faculty_name = '$faculty'";
                                                            $db_connection->getCurrentDBConnection()->query($query);
                                                            if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                echo "Invalid query!";
                                                            }
                                                            else {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    $faculty_id = $row['faculty_id'];
                                                                }
                                                            }
                                                        }
                                                        else {
                                                            $query = "SELECT   i.PK_institute_id
                                                                             , i.institute_name
                                                                             , i.institute_abbreviation
                                                                             , f.faculty_name
                                                                             , f.faculty_abbreviation
                                                                             , f.faculty_id  
                                                                        FROM institute AS i 
                                                                            INNER JOIN faculty as f on i.FK_faculty_id = f.faculty_id
                                                                        WHERE F.faculty_name = '$faculty'";

                                                            if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                                                                echo "Invalid query!";
                                                            }
                                                            else {
                                                                ?>
                                                                <table class="table table-hover table-striped">
                                                                    <thead>
                                                                    <th>Nazwa instytutu</th>
                                                                    <th>Skrót</th>
                                                                    <th></th>
<!--                                                                    <th></th>-->
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        $faculty_id = $row['faculty_id'];
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $row['institute_name']; ?></td>
                                                                            <td><?php echo $row['institute_abbreviation']; ?></td>
<!--                                                                            <td>--><?php //echo $row['head_fullname']; ?><!--</td>-->
<!--                                                                            <td>--><?php //echo $row['exam_date']; ?><!--</td>-->
<!--                                                                            <td>--><?php //echo $row['start_time']; ?><!--</td>-->
<!--                                                                            <td>--><?php //echo $row['end_time']; ?><!--</td>-->

                                                                            <td>
                                                                                <!--                                                        <a href="">Usuń</a>-->
                                                                                <div class="col-md-5">
                                                                                    <button type="submit" class="btn btn-info btn-fill btn-block" onclick="location.href='manage_employees.php?institute_id=<?php echo $row['PK_institute_id'] ?>'"> Zarzadzaj pracownikami</button>
                                                                                </div>

                                                                                <div class="col-sm-1">
                                                                                </div>
                                                                                <!--                                                        <a href="">Usuń</a>-->
                                                                                <div class="col-md-3">
                                                                                    <button type="submit" class="btn btn-danger btn-fill btn-block" onclick="location.href='delete_institute.php?institute_id=<?php echo $row['PK_institute_id'] ?>'">  Usun instytut</button>
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
                                                            <div class="col-md-9">
                                                            </div>

                                                            <div class="col-md-3">
                                                                <button type="submit" class="btn btn-success btn-fill btn-block" onclick="location.href='new_institute.php?faculty_id=<?php echo $faculty_id ?>'">Dodaj nowy instytut</button>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
<?php
if (isSet($_SESSION['institute_added'])) {
    ?>
    <script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();

            $.notify({
                icon: 'pe-7s-check',
                message: "<?php echo $_SESSION['institute_added'] ?>"
            },{
                type: 'success',
                timer: 4000
            });

        });
    </script>
    <?php
}
?>

<?php
if (isSet($_SESSION['inst_deleted'])) {
    ?>
    <script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();

            $.notify({
                icon: 'pe-7s-check',
                message: "<?php echo $_SESSION['inst_deleted'] ?>"
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