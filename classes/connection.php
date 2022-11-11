<?php

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