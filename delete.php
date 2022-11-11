<?php
require('classes/session.php');
require('classes/petTreatment.php');
$session = new Session();
$petTreatment = new PetTreatment();
if(isset($_GET['id']) && !empty($_GET['id'])){
    if($petTreatment->removePet($_GET['id'], $_SESSION['id'])){
        header("Location: my-account.php");
    }
}header("Location: my-account.php");
