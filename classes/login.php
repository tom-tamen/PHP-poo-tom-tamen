<?php
require_once 'usersConnection.php';
class login extends UsersConnection
{
    public function match(User $user):bool
    {
        $req= "SELECT * FROM user WHERE email = :email";
        $statement = $this->pdo->prepare($req);
        $statement->execute(['email'=>$user->email ]);
        $data = $statement->fetchAll();
        return password_verify($user->password, $data[0]['password']);
    }
    
}