<?php

require_once 'connection.php';
class PetTreatment extends Connection
{
    public function addPet(Pet $pet){//insert a Pet object in the database
        $req= "INSERT INTO pet (name, type, owner) VALUES (:name, :type, :owner)";
        $statement = $this->pdo->prepare($req);
        return $statement->execute([
            'name'=>$pet->name,
            'type'=>$pet->type,
            'owner'=>$pet->owner
        ]);
    }

    public function removePet($id, $owner):bool//delete a Pet object in the database
    {
        $req= "DELETE FROM pet WHERE id = :id AND owner= :owner";//check
        $statement = $this->pdo->prepare($req);
        return $statement->execute(['id'=>$id, 'owner'=>$owner]);//check that the user who delete the Pet is the owner with session user id
    }

    public function getMyPet($id):array//returns a list of information about a pet via its ID
    {
        $req= "SELECT * FROM pet WHERE owner = :id";
        $statement = $this->pdo->prepare($req);
        $statement->execute(['id'=>$id]);
        return $statement->fetchAll();
    }
}