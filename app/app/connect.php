<?php

class DatabaseConnection {


    private $host = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "obrona_2019_test";
    private $db_port = 3306;


    private $db_connection;



    public function establishConnection() {
        $this->db_connection = @new mysqli($this->host,$this->db_user,$this->db_password,$this->db_name,$this->db_port);
        if ($this->db_connection->connect_errno!=0) {
            die("Error occured while attempting to connect to the datebase!");

        }
    }

    public function dropCurrentConnection() {
        $this->db_connection->close();
    }

    public function getCurrentDBConnection() {
        return $this->db_connection;
    }

}


?>