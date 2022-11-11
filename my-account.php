<?php
require('classes/session.php');
$session = new Session();
if(!$session->sessionStatus()){
    header("Location: login.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['logout'])){
        $session->destroy();
    }
}