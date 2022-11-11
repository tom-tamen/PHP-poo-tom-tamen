<?php
require_once 'connection.php';
class UsersConnection extends Connection
{
    public function exist(User $user):bool
    {
        $req= "SELECT * FROM user WHERE email = :email";
        $statement = $this->pdo->prepare($req);
        $statement->execute(['email'=>$user->email ]);
        $exist = $statement->rowCount();
        return $exist===0;
    }

    public function getUserInfos($user):array
    {
        $req= "SELECT * FROM user WHERE email = :email";
        $statement = $this->pdo->prepare($req);
        $statement->execute(['email'=>$user->email ]);
        $data = $statement->fetchAll();
        return [
            'id'=>$data[0]['id'],
            'first_name'=>$data[0]['first_name'],
            'last_name'=>$data[0]['last_name'],
            'email'=>$data[0]['email'],
            'isAdmin'=>$data[0]['isAdmin']
        ];
    }
}