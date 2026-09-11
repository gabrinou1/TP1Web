<?php
require "classes/utilisateur.class.php";

session_start();
LogoutUser();
ValidateUser();







function ValidateUser()
{
    $isValidated = true;
    if (isset($_POST["userName"])) {
        $name = trim($_POST["userName"]);
    }

    if (isset($_POST["password"])) {
        $password = trim($_POST["password"]);

        if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,}$/", $password)) {
            echo "Ton mot de passe est pas goood";
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

        $jsonFile = '/data/utilisateurs.json';

        if (file_exists($jsonFile)) {
            $currentData = file_get_contents($jsonFile);
            $arrayData = json_decode($currentData, true);
        } else {
            $arrayData = [];
        }

        
        $newData = [
            "name" => $name,
            "password" => $password,
            "email" => $email,
            "role" => $role,
        ];

        $arrayData[] = $newData;
        $jsonString = json_encode($arrayData, JSON_PRETTY_PRINT);


        if (file_put_contents($jsonFile, $jsonString, LOCK_EX)) {
            echo "New record successfully appended!";
        }
        header("Location: pageProfil.php");
        exit();

    } else {
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