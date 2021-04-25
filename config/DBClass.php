<?php
/**
 * Created by PhpStorm.
 * User: manuel.gomez
 * Date: 24-04-2021
 * Time: 13:17
 */

class DBClass
{


    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "pruebaphp";

    public $connection;

    // get the database connection
    public function getConnection(){

        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }

}