<?php
require_once 'usersConnection.php';
class Register extends UsersConnection
{
    public function addNew(User $user):bool//insert a user object in the database
    {
        $req= "INSERT INTO user (email, password, first_name, last_name) VALUES (:email, :password, :first_name, :last_name)";
        $statement = $this->pdo->prepare($req);
        return $statement->execute([
            'email'=>$user->email,
            'password'=>password_hash($user->password, PASSWORD_BCRYPT),//hash the password with BCRYPT
            'first_name'=>$user->firstName,
            'last_name'=>$user->lastName
        ]);
    }
}