<?php
require('classes/session.php');
$session = new Session();
if(!$session->sessionStatus()){
    echo "<script> location.replace('login.php') </script>"; //redirect to the login page if there is no session in progress
}
if(!$_SESSION['isAdmin']){ //redirects to the account page if the user is not admin
    echo "<script> location.replace('my-account.php') </script>";
}
require('classes/admin.php');
require('classes/petTreatment.php');
$petTreatment = new PetTreatment();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Admin</title>
</head>
<body>
    <h1>Admin-panel</h1>
    <a class="button" href="my-account.php">Back to account</a>
    <div class="tablepet">
        <h2>Users and their pets :</h2>
        <?php
        $admin = new Admin();
        foreach ($admin->everyone() as $user){ //create a table for each user
            ?>
                <table>
                    <thead>
                    <tr>
                        <th colspan="2"><?php echo $user['first_name']." ".$user['last_name']?></th><!--user identity-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    foreach($petTreatment->getMyPet($user["id"]) as $currentPet){//create a line for each owner's pet
                        if($i%2===0){//system for coloring every other line to simplify readability
                            $color = "colored";
                        }else $color = "";
                        $i++;
                        ?>
                        <tr class="<?php echo $color ?>">
                            <td><?php echo $currentPet['name']?></td>
                            <td><?php echo $currentPet['type']?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            <?php
        }
        ?>
    </div>
</body>
</html>
