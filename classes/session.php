<?php

class Session
{
     public function __construct()
    {
        if(!session_id()){
            session_start();
            session_regenerate_id();
        }
    }

    function destroy()
    {
        session_unset();
        session_destroy();
        return header("Location: login.php");
    }

    function remember($infos)
    {
        $_SESSION['email'] = $infos['email'];
        $_SESSION['firstName'] = $infos['first_name'];
        $_SESSION['lastName'] = $infos['last_name'];
        $_SESSION['id'] = $infos['id'];
        $_SESSION['isAdmin'] = $infos['isAdmin'];
        return header("Location: my-account.php");
    }

    function sessionStatus(){
         return isset($_SESSION['email']) && isset($_SESSION['firstName']) && isset($_SESSION['lastName']);
    }
}