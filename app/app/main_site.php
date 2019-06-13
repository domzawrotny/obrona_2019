    
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
                                <h4 class="title">Data i miejsce</h4>
                            </div>
                            <div class="content">
                                 <form>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="Date" class="form-control" placeholder="Wybierz datę" value="2005-04-02">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-info btn-fill btn-block pull-right">Wybierz</button>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Wydział</label>
                                            <div class="dropdown">
                                            <button type="submit" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Wydział Akrobatyki i Dmuchania Ryżu</button>
                                                <ul class="dropdown-menu min-width: 100%">
                                                    <li><a href="#">Wydział Nawijania Makaronu</a></li>
                                                    <li><a href="#">Wydział Zarządzania i Marketingu</a></li>
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
                                                                <li><a href="#"><?= $row['faculty_name'] ?></a></li>
                                                            <?php endwhile; ?>
                                                    <?php
                                                        }
                                                        $db_connection->dropCurrentConnection();
                                                    ?>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Instytut</label>
                                            <div class="dropdown">
                                            <button type="submit" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Instytut Skoków w dal</button>
                                                <ul class="dropdown-menu min-width: 100%">
                                                    <li><a href="#">Instytut Skoków w Bok</a></li>
                                                    <li><a href="#">Instytut Risotto</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                                <label>Budynek</label>
                                                <div class="dropdown">
                                                <button type="submit" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">A-0</button>
                                                        <ul class="dropdown-menu min-width: 100%">
                                                            <li><a href="#">A-2</a></li>
                                                            <li><a href="#">A-29</a></li>
                                                        </ul>
                                                </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Sala</label>
                                            <div class="dropdown">
                                            <button type="submit" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">02</button>
                                                    <ul class="dropdown-menu min-width: 100%">
                                                        <li><a href="#">02</a></li>
                                                        <li><a href="#">04</a></li>
                                                        <li><a href="#">05</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#">21</a></li>
                                                        <li><a href="#">37</a></li>
                                                    </ul>
                                            </div>
                                        </div>
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
                                <p class="category">Dla dnia XX.XX.XXXX</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Godz.</th>
                                    	<th>Przewodniczący</th>
                                    	<th>Promotor</th>
                                    	<th>Recenzent</th>
                                        <th>Dyplomant</th>
                                        <th>Edycja</th>
                                        <th>Usuwanie</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td>7:00</td>
                                        	<td>Prof. dr hab. Ambroży Kleks</td>
                                        	<td>Dr Krzysztof Wstrząs</td>
                                        	<td>Dr Grzegorz Domek</td>
                                            <td>Karol Wykopek</td>
                                            <td><a href="#">Edytuj</a></td>
                                            <td><a href="#">Usuń</a></td>
                                        </tr>
                                        <tr>
                                        	<td>7:15</td>
                                        	<td>Prof. dr hab. Ambroży Kleks</td>
                                        	<td>Dr Krzysztof Wstrząs</td>
                                        	<td>Dr Grzegorz Domek</td>
                                            <td>Paweł Jumper</td>
                                            <td><a href="#">Edytuj</a></td>
                                            <td><a href="#">Usuń</a></td>
                                        </tr>
                                        <tr>
                                        	<td>7:30</td>
                                        	<td>Prof. dr hab. Ambroży Kleks</td>
                                        	<td>Dr Krzysztof Wstrząs</td>
                                        	<td>Dr Grzegorz Domek</td>
                                            <td>Sasza Szara</td>
                                            <td><a href="#">Edytuj</a></td>
                                            <td><a href="#">Usuń</a></td>
                                        </tr>
                                        <tr>
                                        	<td>7:45</td>
                                        	<td>Prof. dr hab. Jan Tadeusz Stanisławski</td>
                                        	<td>Dr Paweł Jubicz</td>
                                        	<td>Dr Michalina Quinn</td>
                                            <td>Jacek Kaczyński</td>
                                            <td><a href="#">Edytuj</a></td>
                                            <td><a href="#">Usuń</a></td>
                                        </tr>
                                        <tr>
                                        	<td>8:00</td>
                                        	<td>Prof. dr hab. Jan Tadeusz Stanisławski</td>
                                        	<td>Dr Paweł Jubicz</td>
                                        	<td>Dr Michalina Quinn</td>
                                            <td>Placek Kaczyński</td>
                                            <td><a href="#">Edytuj</a></td>
                                            <td><a href="#">Usuń</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-md-8">
                                        </div>
                                        <div class="col-md-2">
                                        <button type="submit" class="btn btn-info btn-fill btn-block">Nowa karta</button>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-2">
                                        <button type="submit" class="btn btn-success btn-fill btn-block">Generuj raport</button>
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
