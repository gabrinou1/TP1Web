// Gabriel Vallieres

<?php
require "classes/utilisateur.class.php";
require_once "connexionpdo.php";


if (isset($_POST["ajouterAlbum"])) {
    AddAlbum();
}


function AddAlbum()
{
    global $conn;

    $titre = trim($_POST["titre"]);
    $code = trim($_POST["code"]);
    $date = $_POST["date"];
    $genre = $_POST["genre"];

    $sql = "INSERT INTO albums (titre, code_album, date_album, id_genre)
            VALUES (:titre, :code, :date, :genre)";

    $requete = $conn->prepare($sql);

    $requete->bindValue(":titre", $titre);
    $requete->bindValue(":code", $code);
    $requete->bindValue(":date", $date);
    $requete->bindValue(":genre", $genre, PDO::PARAM_INT);

    $requete->execute();
    unset($_POST["ajouterAlbum"]);

    header("Location: pageCollectionAlbum.php");
    exit();
}