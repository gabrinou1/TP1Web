<?php
session_start();

require "classes/utilisateur.class.php"; 

function ValidateUser()
{
    if(isset($_POST["username"])){
        $name =trim($_POST["name"]);
    }

    if(isset($_POST["password"])){
        $password =trim($_POST["password"]);
    }

    if(empty($name)){
        echo "Name is required";
    }

    if(strlen($name)<3){
        echo "Name is too short";
    }

    $user = 

    $_SESSION[username] = $name;


}

function LogoutUser()
{
    session_destroy();
    session_unset();

}



?>

