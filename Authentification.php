<?php
require "classes/utilisateur.class.php";
require_once "connexionpdo.php";

session_start();

LogoutUser();
if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"])) {
    LoginUser();
} else if (isset($_POST["userName"])) {
    ValidateUser();
}


function LoginUser()
{
    global $conn;

    if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"])) {

        $email = trim($_POST["loginEmail"]);
        $password = $_POST["loginPassword"];

        $sql = "SELECT * FROM utilisateurs WHERE courriel = :email";

        $requete = $conn->prepare($sql);
        $requete->execute(["email" => $email]);

        $user = $requete->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["mot_passe"])) {

            $loggedUser = new User(
                $user["nom"],
                null,
                $user["courriel"],
                $user["urRole"],
                $user["id"]
            );

            session_regenerate_id(true);

            $_SESSION["user"] = $loggedUser;
            $_SESSION["connected"] = true;

            header("Location: index.php");
            exit();
        }

        $_SESSION["error"] = "Le courriel ou le mot de passe est incorrect";
        header("Location: pageConnexion.php");
        exit();
    }
}

function ValidateUser()
{

    global $conn;

    if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
        header("Location: index.php");
        exit();
    }

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

    $role = "CLIENT";
    
    if (isset($_POST["ville"])) {
        $ville = trim($_POST["ville"]);
    }

    if (isset($_POST["age"])) {
        $age = trim($_POST["age"]);
    }

    if (empty($name)) {
        $_SESSION["error"] = "Le nom d'utilisateur est requis.";
        $isValidated = false;
    }

    if (strlen($name) < 3 || strlen($name) > 45) {
        $_SESSION["error"] = "Le nom d'utilisateur doit contenir entre 3 et 45 caractères.";
        $isValidated = false;
    }

    if ($age != "") {
        if (!filter_var($age, FILTER_VALIDATE_INT) || $age < 18 || $age > 100) {
            $_SESSION["error"] = "L'âge doit être entre 18 et 100 ans.";
            $isValidated = false;
        }
    } else {
        $age = null;
    }

    if ($ville == "") {
        $ville = 3;
    }

    
    if ($isValidated) {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO utilisateurs
                (nom, courriel, mot_passe, id_ville, urRole, age)
                VALUES
                (:nom, :email, :password, :ville, :role, :age)";

        $requete = $conn->prepare($sql);

        try {
            $requete->execute([
                "nom" => $name,
                "email" => $email,
                "password" => $hashedPassword,
                "ville" => $ville,
                "role" => $role,
                "age" => $age
            ]);
        } catch (PDOException $e) {
            $_SESSION["error"] = "Impossible de créer le compte.";
            header("Location: pageInscription.php");
            exit();
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
    if (isset($_POST["logout"]) && isset($_SESSION["user"])) {

        session_unset();
        session_destroy();

        header("Location: index.php");
        exit();
    }
}



?>