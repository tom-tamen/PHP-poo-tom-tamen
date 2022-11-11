<?php
require('classes/session.php');
$session = new Session();
if(!$session->sessionStatus()){
    header("Location: login.php");
}
if(!$_SESSION['isAdmin']){
    header("Location: my-account.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
    <h1>YO</h1>
</body>
</html>
