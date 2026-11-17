<?php
require_once "classes/utilisateur.class.php";
require_once "connexionpdo.php";

session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]->getRole() !== "CLIENT") {
    header("Location: pageAcceuil.php");
    exit();
}

if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = [];
}

if (isset($_POST["ajouter"])) {
    AddItem();
}

else if (isset($_POST["supprimer"])) {
    RemoveItem();
}

else if (isset($_POST["modifier"])) {
    ModifyItem();
}
else if (isset($_POST["vider"])) {
    ClearCart();
}

header("Location: pagePanier.php");
exit();

function AddItem()
{
    global $conn;

    $id = (int) $_POST["id"];

    $sql = "SELECT * FROM oeuvres WHERE id = :id";
    $requete = $conn->prepare($sql);
    $requete->execute(["id" => $id]);

    $oeuvre = $requete->fetch(PDO::FETCH_ASSOC);

    if ($oeuvre) {
        if (isset($_SESSION["panier"][$id])) {
            if ($_SESSION["panier"][$id] < 255) {
                $_SESSION["panier"][$id]++;
            }
        }
        else {
            $_SESSION["panier"][$id] = 1;
        }
    }
}

function RemoveItem()
{
    $id = (int) $_POST["id"];

    unset($_SESSION["panier"][$id]);
}

function ModifyItem()
{
    $id = (int) $_POST["id"];
    $quantity = filter_var($_POST["quantite"], FILTER_VALIDATE_INT);

    if (isset($_SESSION["panier"][$id])) {
        if ($quantity >= 1) {
            $_SESSION["panier"][$id] = $quantity;
        }
    }
}

function ClearCart()
{
    $_SESSION["panier"] = [];
}

