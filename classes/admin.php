<?php
require_once 'connection.php';
class Admin extends Connection
{
    public function everyone():array //returns a list of all users with all their data
    {
        $req = $this->pdo->prepare("SELECT * FROM user");
        $req->execute();
        return $req->fetchAll();
    }
}