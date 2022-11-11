<?php

require_once 'connection.php';
class PetTreatment extends Connection
{
    public function addPet($pet){
        $req= "INSERT INTO pet (name, type, owner) VALUES (:name, :type, :owner)";
        $statement = $this->pdo->prepare($req);
        return $statement->execute([
            'name'=>$pet->name,
            'type'=>$pet->type,
            'owner'=>$pet->owner
        ]);
    }

    public function removePet($id, $owner):bool
    {
        $req= "DELETE FROM pet WHERE id = :id AND owner= :owner";
        $statement = $this->pdo->prepare($req);
        return $statement->execute(['id'=>$id, 'owner'=>$owner]);
    }

    public function getMyPet($id):array
    {
        $req= "SELECT * FROM pet WHERE owner = :id";
        $statement = $this->pdo->prepare($req);
        $statement->execute(['id'=>$id]);
        return $statement->fetchAll();
    }
}