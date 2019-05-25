<?php
session_start();
if (!isSet($_SESSION['signed_in']) || ($_SESSION['permissions']!=1) ) {

    header('Location: index.php');
    exit();
}
?>
<html>
<head>
    <title> User management </title>
    <!--    <link rel="stylesheet" href="../lib/css/style.css" type="text/css" />-->
</head>

<body>
<div id="container">

    <div id="go_back">
        <?php
        echo "Witoj na stronie do zarzadzania użyszkodnikami " . @$_SESSION['login'] . "!";
        ?>
    </div>
    <div id="sign_out">
        <a href="sign_out.php">Sign out</a>
    </div>

    <div id="new_user">
        <a href="add_new_user.php">Nowy użyszkodnik</a>
    </div>
    <div id="user_list">
        <?php
        $login = $_SESSION['login'];
        require_once "connect.php";
        $db_connection = new DatabaseConnection();
        $db_connection->establishConnection();

        if ($db_connection->getCurrentDBConnection()->connect_errno!=0) {
            die("Error occured while attempting to connect to the datebase!");

        }
        else {

            $query =   "SELECT u.login_id,u.login, u.email_address, p.permissions_type FROM user_login AS u INNER JOIN user_permissions AS p ON p.permissions_id=u.permissions_id ;";

            if (!($result = @$db_connection->getCurrentDBConnection()->query($query))) {
                echo "Invalid query!";
            }
            else {
                if (mysqli_num_rows($result)){

                    $nr = 1;
                    echo "Lista użytkowników:";
                    ?><table>
                        <tr>
                            <th>
                                Lp
                            </th>
                            <th>
                                Login
                            </th>
                            <th>
                                Adres email
                            </th>
                            <th>
                                Poziom uprawnień
                            </th>
                            <th>

                            </th>
                            <th>

                            </th>
                        </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo  $nr; ?>
                                </td>
                                <td>
                                    <?php echo  $row['login']; ?>
                                </td>
                                <td>
                                    <?php echo $row['email_address']; ?>
                                </td>
                                <td>
                                    <?php echo $row['permissions_type']; ?>
                                </td>
                                <td>
                                    <a href="reset_password.php?login_id=<?php echo $row['login_id']?>">Reset hasła</a>
                                </td>
                                <td>
                                    <a href="delete_user.php?login_id=<?php echo $row['login_id']?>">Usuń użytkownika</a>
                                </td>
                            </tr>
                        <?php
                        $nr++;
                    }
                    ?></table><?php
                }
                else {
                    echo "This lecturer has no subjects with this group yet.";
                }
            }
            $db_connection->dropCurrentConnection();
        }
        ?>
    </div>
</div>

</body>
</html>