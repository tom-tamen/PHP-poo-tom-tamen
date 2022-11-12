<?php

//the only role of this class is to establish a connection with the database. It is also a parent class
class Connection
{
    protected PDO $pdo;

    public function __construct()
    {
        try{
            $this->pdo = new PDO('mysql:host=localhost;dbname=spa','root','root');
        } catch(PDOExeption $e) {
            die('Error');
        }
    }
}