<?php
//this class manages everything related to sessions
class Session
{
     public function __construct()
    {
        if(!session_id()){//start a session if there is none in progress
            session_start();
            session_regenerate_id();
        }
    }

    function destroy()//deletes a session and its associated variables
    {
        session_unset();
        session_destroy();
        return "<script> location.replace('login.php') </script>";
    }

    function remember($infos)//stores user information in session variables. The information comes from the 'getUserInfos()' method of the usersConnection class
    {
        $_SESSION['email'] = $infos['email'];
        $_SESSION['firstName'] = $infos['first_name'];
        $_SESSION['lastName'] = $infos['last_name'];
        $_SESSION['id'] = $infos['id'];
        $_SESSION['isAdmin'] = $infos['isAdmin'];
        return "<script> location.replace('my-account.php') </script>";
    }

    function sessionStatus(){//check if a session is in progress
         return isset($_SESSION['email']) && isset($_SESSION['firstName']) && isset($_SESSION['lastName']) && isset($_SESSION['id']) && isset($_SESSION['isAdmin']);
    }
}