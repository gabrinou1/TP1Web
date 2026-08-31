<!doctype html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <title>Librairie Magasin</title>

  <style>
    body {
      background-color: #6d6b7e;
    }
  </style>

</head>

<?php
require "classes/utilisateur.class.php";
$isConnected = false;


session_start();
if (isset($_SESSION["user"])) {
  $isConnected = true;
}
?>

<body class="d-flex flex-column min-vh-100">


  <div class="container" id="detail">
    <div class="text-white d-flex">
      <h1>MML</h1>
    </div>
    <hr />



    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
      <a class="navbar-brand" href="#">Menu</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-evenly" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active px-10" href="pageAcceuil.php">Accueil <span
              class="sr-only">(current)</span></a>
          <a class="nav-item nav-link px-10" href="pageAlbums.php">Albums</a>
          <a class="nav-item nav-link px-10" href="pageArtiste.php">Artiste</a>
          <a class="nav-item nav-link px-10" href="pageOeuvre.php">Oeuvres</a>
          <?php
          if ($isConnected) {
            echo '<a class="nav-item nav-link px-10" href="pageProfil.php">Profil</a>';
            echo '<form method="post" action ="Authentification.php">
            <input type="submit" class="btn btn-danger" name="logout" value="Deconnexion">
          </form>';
          } else {
            $page = $_SERVER["PHP_SELF"];
            if (strpos($page, "Connexion") == false) {
              echo '<a class="nav-item nav-link px-10 bg-success rounded" href="pageConnexion.php">Connection</a>';
            }
          }
          ?>


        </div>
      </div>
    </nav>