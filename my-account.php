<?php
require('classes/session.php');
$session = new Session();
if(!$session->sessionStatus()){
    header("Location: login.php");
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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My account</title>
</head>
<body>
    <h1>My Account</h1>
    <h2><?php echo "email : ".$_SESSION['email']?></h2>
    <h2><?php echo "Last name : ".$_SESSION['lastName']?></h2>
    <h2><?php echo "First name : ".$_SESSION['firstName']?></h2>
    <h2><?php echo "id : ".$_SESSION['id']?></h2>
    <h2><?php echo "Admin : ".$_SESSION['isAdmin']?></h2>
    <form action="my-account.php" method="post">
        <input type="submit" name="logout" value="logout">
    </form>
    <?php
    if($isAdmin){
        ?> <a href="admin.php">Admin-panel</a> <?php
    }
    ?>
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
            foreach($petTreatment->getMyPet($userID) as $currentPet){
                ?>
                <tr>
                    <td><?php echo $currentPet['name']?></td>
                    <td><?php echo $currentPet['type']?></td>
                    <td><a href="<?php echo 'delete.php?id='.$currentPet['id']?>">DELETE</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <form action="my-account.php" method="post">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="type" placeholder="type">
        <input type="submit" name="add" value="Add pet">
    </form>
</body>
</html>
<?php

require('classes/pet.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['logout'])){
        $session->destroy();
    }
    if(isset($_POST['add'])){
        $pet = new Pet(
                htmlspecialchars($_POST["name"]),
                htmlspecialchars($_POST["type"]),
                $userID);
        if(!$pet->verify()){
            if($petTreatment->addPet($pet)){
                header("Location: my-account.php");
            }echo 'error 1';
        }echo 'error 2';
    }
}