<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTION, DELETE");
header('Access-Control-Allow-Headers: *' );

class db
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = '';

    public function connect()
    {
        $mysql_connect_str = "mysql:host=$this->host;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->user, $this->password);
        $dbConnection->setAttribute(PDO::AFTER_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}

?>