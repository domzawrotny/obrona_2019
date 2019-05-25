<?php
require_once "clear_string.php";

class MyGenerator{

    public function generateLogin($firstname, $surname, $db_connection) {
        $objCleanString = new ClearString();
        $cleared_firstname = $objCleanString->convertAccentsAndSpecialToNormal($firstname);
        $cleared_surname = $objCleanString->convertAccentsAndSpecialToNormal($surname);
        $length = 1;
        do {

            $login = strtolower(substr($cleared_firstname,0,$length)) . strtolower($cleared_surname);

            $query = "SELECT * FROM user_login WHERE login='$login'";


            $length++;
        } while (mysqli_num_rows($db_connection->getCurrentDBConnection()->query($query))!=0);

        return $login;
    }


    public function newUser($firstname,$surname,$login,$db_connection, $login_permissions_query,$user_sql_query) {
        if (!($result_1 = $db_connection->getCurrentDBConnection()->query($login_permissions_query))) {
            echo "An error occurred in the first query!<br/>";
        }
        else {
            if (!($result_2 = $db_connection->getCurrentDBConnection()->query($user_sql_query))) {
                echo "An error occurred in the second query!<br/>";
                @$db_connection->getCurrentDBConnection()->query("DELETE FROM user_login WHERE login='$login'");
            }
            else {
                $leverage_query = "SELECT * FROM user_login AS l INNER JOIN user_permissions AS p ON l.permissions_id=p.permissions_id WHERE l.login='$login'";
                $result = $db_connection->getCurrentDBConnection()->query($leverage_query);
                $leverage = $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                echo "Successfully added " . $firstname . " " . $surname . " to the database!"."<br/>";
                echo "Login: ".$login."<br/>";
                echo "Poziom uprawnien: " . $leverage['quick_description'] ."<br/>";
                $_SESSION['user_added'] = true;
            }
        }
    }
}
?>