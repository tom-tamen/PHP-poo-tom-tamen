<?php
require('classes/session.php');
require('classes/petTreatment.php');
$session = new Session();//init a session to retrieve data
$petTreatment = new PetTreatment();
if(isset($_GET['id']) && !empty($_GET['id'])){//check id validity
    if($petTreatment->removePet($_GET['id'], $_SESSION['id'])){//removal of the pet from the database
        echo "<script> location.replace('my-account.php') </script>";
    }
}echo "<script> location.replace('my-account.php') </script>";//auto redirect to avoid a user being blocked here
