    
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
                            <div class="content">
                                 <form>
                                        <div class="row">
                                        <div class="col-md-12">
                                                <label>Wydział</label>
                                                <div class="dropdown">
                                                <button type="submit" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Wydział Akrobatyki i Dmuchania Ryżu</button>
                                                        <ul class="dropdown-menu min-width: 100%">
                                                            <li><a href="#">Wydział Nawijania Makaronu</a></li>
                                                            <li><a href="#">Wydział Zarządzania i Marketingu</a></li>
                                                        </ul>
                                                </div>
                                        </div>
                                       
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
                                            <td>Karol Papież</td>                                            
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
                                        <div class="col-md-10">
                                        </div>
                                        <div class="col-md-2">
                                        <button type="submit" class="btn btn-info btn-fill btn-block">Nowa karta</button>
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
        }
    ?>
    
  



    
</html>
