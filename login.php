<?php
require('classes/session.php');
$session = new Session();
if($session->sessionStatus()){//redirects to the account page if a session is in progress
    echo "<script> location.replace('my-account.php') </script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <img class ='logo' src="https://www.la-spa.fr/app/assets-spa/uploads/2021/09/MicrosoftTeams-image-63.png" alt="spa logo">
    <section class='mainlog'>
        <form action="login.php" method="post" class='login'>
            <h2>Login :</h2>
            <input type="email" name="login_email" placeholder="Email">
            <input type="password" name="login_password" placeholder="Password">
            <input type="submit" name="login" value="Login">
            <p class='res'>
                <?php
                if(isset($_GET["resl"])){ //check if an error has occurred
                    if($_GET["resl"]==='lwp'){
                        echo'Wrong password';
                    }else{
                        echo'Unknown email';
                    }
                }
                ?>
            </p>
        </form>

        <form action="login.php" method="post" class='login'>
            <h2>Register :</h2>
            <input type="email" name="reg_email" placeholder="Email">
            <input type="text" name="reg_firstName" placeholder="First name">
            <input type="text" name="reg_lastName" placeholder="Last name">
            <input type="password" name="reg_password1" placeholder="Password">
            <input type="password" name="reg_password2" placeholder="Retype password">
            <input type="submit" name="register" value="Register">
            <p class='res'>
                <?php
                if(isset($_GET["resr"])){ //check if an error has occurred
                    if($_GET["resr"]==='eat'){
                        echo'Email already taken';
                    }else{
                        echo'Bad input';
                    }
                }
                ?>
            </p>
        </form>
    </section>
</body>
</html>
<?php
require('classes/user.php');
require('classes/register.php');
require('classes/login.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['login'])){//check if it's a login request

        $login = new Login();

        $user = new User(//init User object
                htmlspecialchars($_POST['login_email']),
            '',
            '',
                htmlspecialchars($_POST['login_password']),
            '');

        if(!$login->exist($user)){//checks if the user exists

            if($login->match($user)){//check if the password is correct

                $initSession = new Session();
                $initSession->remember($login->getUserInfos($user));//create variables session with the user infos

            }echo "<script> location.replace('login.php?resl=lwp') </script>";//wrong password redirect
        }echo "<script> location.replace('login.php?resl=lwe') </script>";//unknown email redirect
    }

    elseif (isset($_POST['register'])){//check if it's a register request

        $register = new Register();

        $user = new User(//init User object
                htmlspecialchars($_POST['reg_email']),
                htmlspecialchars($_POST['reg_firstName']),
                htmlspecialchars($_POST['reg_lastName']),
                htmlspecialchars($_POST['reg_password1']),
                htmlspecialchars($_POST['reg_password2'])
                );

        if($user->verify()){ //check if the fields are filled in correctly

            if($register->exist($user)){ //checks if the user already exists

                if($register->addNew($user)){ //add user into database

                    $initSession = new Session();
                    $initSession->remember($register->getUserInfos($user)); //stores user information in session variables.

                }
            }echo "<script> location.replace('login.php?resr=eat') </script>";//already exists redirection
        }echo "<script> location.replace('login.php?resr=err') </script>";//bad input redirection
    }
}

