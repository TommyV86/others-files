<?php

define("SERV", "127.0.0.1");
define("USER","root");
define("PSW", "");
define("DB", "sdb");


class ConnectDb
{
    public function db_connect() : mysqli
    {
        $conn = new mysqli(SERV, USER, PSW, DB);
        if($conn->connect_error){
            die("Connection failed : ".$conn->connect_error);
        }

        return $conn;
    }
}