<?php
// Aimeric Lachance
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
else if (isset($_POST["confirmer"])){
    ConfirmeOrder();
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

function ConfirmeOrder()
{
    global $conn;

    if (empty($_SESSION["panier"])) {
        return;
    }

    $idUtilisateur = $_SESSION["user"]->getId();

    try {
        $conn->beginTransaction();

        $sqlCmd = "INSERT INTO commandes (id_utilisateur, date_commande, etat_commande) 
                   VALUES (:id_utilisateur, NOW(), 'En cours')";
        $stmtCmd = $conn->prepare($sqlCmd);
        $stmtCmd->execute(["id_utilisateur" => $idUtilisateur]);

        $idCommande = $conn->lastInsertId();

        $sqlLigne = "INSERT INTO ligne_commandes (id_commande, id_oeuvre, Quantite) 
                     VALUES (:id_commande, :id_oeuvre, :quantite)";
        $stmtLigne = $conn->prepare($sqlLigne);

        foreach ($_SESSION["panier"] as $idOeuvre => $quantite) {
            if ($quantite >= 1) {
                $stmtLigne->execute([
                    "id_commande" => $idCommande,
                    "id_oeuvre"   => (int) $idOeuvre,
                    "quantite"    => (int) $quantite
                ]);
            }
        }

        $conn->commit();

        ClearCart();

        header("Location: pageCommande.php?succes=1");
        exit();
    } 
    catch (Exception $e) {
        $conn->rollBack();
        $_SESSION["error"] = "Erreur lors de l'enregistrement de la commande.";
        header("Location: pagePanier.php");
        exit();
    }
}

