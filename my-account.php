<?php
require('classes/session.php');
$session = new Session();
if(!$session->sessionStatus()){ //redirect to the login page if there is no session in progress
    echo "<script> location.replace('login.php') </script>";
}
require('classes/petTreatment.php');
$isAdmin = $_SESSION['isAdmin'];
$petTreatment = new PetTreatment();
$userID = $_SESSION['id'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>My account</title>
</head>
<body id='my-account'>
    <header>
        <img src="https://www.la-spa.fr/app/assets-spa/uploads/2021/09/MicrosoftTeams-image-63.png" alt="spa logo">
        <h1><?php echo "Hello ".$_SESSION['lastName']." ".$_SESSION['firstName']?></h1>
        <form action="my-account.php" method="post">
            <input type="submit" name="logout" value="logout" class='danger'>
        </form>
        <?php
        if($isAdmin){//show the button if the user is an admin
            ?> <a class="button" href="admin.php">Admin-panel</a> <?php
        }
        ?>
    </header>
    <section class='secaccount'>
    <div class="tablepet accounttable">
        <table>
            <thead>
            <tr>
                <th colspan="3">My animals</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Name</td>
                <td>Type</td>
                <td>Delete</td>
            </tr>
            <?php
            $i=0;
            foreach($petTreatment->getMyPet($userID) as $currentPet){//create a line for each owner's pet
                if($i%2===0){//system for coloring every other line to simplify readability
                    $color = "uncolored";
                }else $color = "";
                $i++;
                ?>
                <tr class="<?php echo $color ?>">
                    <td class="tdp"><?php echo $currentPet['name']?></td>
                    <td class="tdp"><?php echo $currentPet['type']?></td>
                    <td class="tdp"><a class='danger delete' href="<?php echo 'delete.php?id='.$currentPet['id']?>">DELETE</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <form action="my-account.php" method="post" class="addpet">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="type" placeholder="type">
        <input type="submit" name="add" value="Add pet">
    </form>
    <p class="res">
        <?php
        if(isset($_GET["res"])){//check if an error has occurred
            if($_GET["res"]==='r'){
                echo'Error retry please';
            }
        }
        ?>
    </p>
    </section>
</body>
</html>
<?php

require('classes/pet.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['logout'])){
        echo($session->destroy());//logout and redirect to login page
    }
    if(isset($_POST['add'])){
        $pet = new Pet( //instensiation of a pet object
                htmlspecialchars($_POST["name"]),
                htmlspecialchars($_POST["type"]),
                $userID);
        if(!$pet->verify()){//check if the fields are not empty
            if($petTreatment->addPet($pet)){ //add the pet to the database
                echo "<script> location.replace('my-account.php') </script>";
            }
        }echo "<script> location.replace('my-account.php?res=r') </script>";//redirect if an error has occurred
    }
}