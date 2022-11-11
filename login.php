<?php
require('classes/session.php');
$session = new Session();
if($session->sessionStatus()){
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
    <title>Login</title>
</head>
<body>
    <h2>Login :</h2>
    <form action="login.php" method="post">
        <input type="email" name="login_email" placeholder="Email">
        <input type="password" name="login_password" placeholder="Password">
        <input type="submit" name="login" value="Login">
    </form>

    <h2>Register :</h2>
    <form action="login.php" method="post">
        <input type="email" name="reg_email" placeholder="Email">
        <input type="text" name="reg_firstName" placeholder="First name">
        <input type="text" name="reg_lastName" placeholder="Last name">
        <input type="password" name="reg_password1" placeholder="Password">
        <input type="password" name="reg_password2" placeholder="Retype password">
        <input type="submit" name="register" value="Register !">
    </form>
</body>
</html>
<?php
require('classes/connection.php');
require('classes/user.php');
require('classes/register.php');
require('classes/login.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['login'])){
        $login = new Login();
        $user = new User(htmlspecialchars($_POST['login_email']),'', '',htmlspecialchars($_POST['login_password']),'');
        if(!$login->exist($user)){
            if($login->match($user)){
                $initSession = new Session();
                $initSession->remember($login->getUserInfos($user));
            }echo '<p>wrong password</p>';
        }echo '<p>wrong email</p>';
    }elseif (isset($_POST['register'])){
        $register = new Register();
        $user = new User(
                htmlspecialchars($_POST['reg_email']),
                htmlspecialchars($_POST['reg_firstName']),
                htmlspecialchars($_POST['reg_lastName']),
                htmlspecialchars($_POST['reg_password1']),
                htmlspecialchars($_POST['reg_password2'])
                );
        if($user->verify()){
            if($register->exist($user)){
                if($register->addNew($user)){
                    $initSession = new Session();
                    $initSession->remember($register->getUserInfos($user));
                }
            }echo '<p>email already taken</p>';
        }
    }echo '<p>error</p>';
}
