<?php
require "classes/utilisateur.class.php";

session_start();
LogoutUser();
ValidateUser();

$jsonFile = '/data/utilisateurs.json';

$userData = [];

if (file_exists($jsonFile)) {
    $jsonString = file_get_contents($jsonFile);
    $userData = json_decode($jsonString, true); 
}

function ValidateUser()
{
    $isValidated = true;
    if (isset($_POST["userName"])) {
        $name = trim($_POST["userName"]);
    }

    if (isset($_POST["password"])) {
        $password = trim($_POST["password"]);

        if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,}$/", $password)) {
            echo "Your password must have an Uppercase letter, a number and at least 8 characters.";
            $isValidated = false;
        }
    }

    if (isset($_POST["email"])) {
        $email = trim($_POST["email"]);
    }

    if (isset($_POST["role"])) {
        $role = trim($_POST["role"]);
    }

    if (empty($name)) {
        echo "Name is required";
    }

    if (strlen($name) < 3) {
        echo "Name is too short";
    }

    if ($isValidated) {
        $user = new User($name, $password, $email, $role);

        $_SESSION["user"] = $user;

        header("Location: pageAcceuil.php");
        exit();

    }else{
        header("Location: pageConnexion.php");
        exit();
    }


}

function LogoutUser()
{
    if (isset($_POST["logout"])) {
        unset($_SESSION["user"]);
        session_destroy();

        header("Location: pageAcceuil.php");
        exit();
    }
}



?>