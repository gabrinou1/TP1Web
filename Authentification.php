<?php
require "classes/utilisateur.class.php";

session_start();

LogoutUser();
if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"])) {
    LoginUser();
} else if (isset($_POST["userName"])) {
    ValidateUser();
}


function LoginUser()
{
    if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"])) {

        $email = trim($_POST["loginEmail"]);
        $password = trim($_POST["loginPassword"]);

        $jsonFile = __DIR__ . '/data/utilisateurs.json';

        if (file_exists($jsonFile)) {

            $currentData = file_get_contents($jsonFile);
            $arrayData = json_decode($currentData, true);

            foreach ($arrayData as $user) {

                if ($user["email"] === $email && $user["password"] === $password) {

                    $loggedUser = new User(
                        $user["name"],
                        $user["password"],
                        $user["email"],
                        $user["role"]
                    );

                    $_SESSION["user"] = $loggedUser;

                    $_SESSION["connected"] = true;
                    header("Location: pageAcceuil.php");
                    exit();
                }
            }
        }
        $_SESSION["error"] = "Le courriel ou le mot de passe est incorrect";
        header("Location: pageConnexion.php");

        exit();
    }
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
            $_SESSION["error"] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.";
            $isValidated = false;
        }
    }

    if ($password !== $_POST["confirmedpassword"]) {
        $_SESSION["error"] = "Les mots de passe ne correspondent pas.";
        $isValidated = false;
    }

    if (isset($_POST["email"])) {
        $email = trim($_POST["email"]);
    }

    if (isset($_POST["role"])) {
        $role = trim($_POST["role"]);
    }

    if (empty($name)) {
        $_SESSION["error"] = "Le nom d'utilisateur est requis.";
        $isValidated = false;
    }

    if (strlen($name) < 3) {
        $_SESSION["error"] = "Le nom d'utilisateur doit contenir au moins 3 caractères.";
        $isValidated = false;
    }



    if ($isValidated) {
        $user = new User($name, $password, $email, $role);



        $jsonFile = __DIR__ . '/data/utilisateurs.json';

        if (file_exists($jsonFile)) {
            $currentData = file_get_contents($jsonFile);
            $arrayData = json_decode($currentData, true);
        } else {
            $arrayData = [];
        }

        foreach ($arrayData as $existingUser) {

            if (strtolower($existingUser["email"]) === strtolower($email)) {

                $_SESSION["error"] = "Ce courriel est déjà utilisé.";
                header("Location: pageInscription.php");
                exit();
            }
        }

        $_SESSION["user"] = $user;


        $newData = [
            "name" => $name,
            "password" => $password,
            "email" => $email,
            "role" => $role,
        ];

        $arrayData[] = $newData;
        $jsonString = json_encode($arrayData, JSON_PRETTY_PRINT);


        if (file_put_contents($jsonFile, $jsonString, LOCK_EX)) {

        }
        $_SESSION["connexionSuccess"] = true;
        header("Location: pageConnexion.php");
        exit();

    } else {
        header("Location: pageInscription.php");
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