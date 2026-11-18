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
      background-color: #eeeef0;
    }
  </style>

</head>

<?php
require_once "classes/utilisateur.class.php";
require_once "connexionpdo.php";

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$isConnected = false;

if (isset($_SESSION["connected"]) && isset($_SESSION["user"])) {
  $isConnected = true;
  $user = $_SESSION["user"];
}
?>

<body class="d-flex flex-column min-vh-100">


  <div class="container" id="detail">

    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
      <a href="pageAcceuil.php"><img src="images\LLM_Logo.png" alt="LLM-Logo" width="50px" height="50px"></a>
      <a class="navbar-brand ms-2" href="pageAcceuil.php">Médiathèque musical en ligne</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active px-10" href="pageAcceuil.php">Accueil <span
              class="sr-only"></span></a>
          <a class="nav-item nav-link px-10" href="pageCollectionAlbum.php">Albums</a>
          <?php if ($isConnected) {
            if ($user->getRole() == "GERANT") {
              echo '<a class="nav-item nav-link px-10" href="pageArtiste.php">Artiste</a>';
              echo '<a class="nav-item nav-link px-10" href="pageOeuvre.php">Oeuvres</a>';
            }
            if ($user->getRole() == "CLIENT") {
              echo '<a class="nav-item nav-link px-10" href="pagePanier.php">Panier</a>';
            }
          }
          ?>
          <?php

          if ($isConnected) {
            echo '<a class="nav-item nav-link px-10" href="pageProfil.php">Profil</a>';
          } else {
            echo '<a class="nav-item nav-link px-10" href="pageInscription.php">Inscription</a>';
          }

          ?>

          <form action="Authentification.php" method="post">
            <button type="submit" name="switchRole" class="btn btn-warning">
              <?php if ($user->getRole() == "GERANT") {
                echo 'Mode Client';
              } else {
                echo 'mode GERANT';
              } ?>
            </button>
          </form>

          

          


        </div>

      </div>

      <?php

      if ($isConnected) {
        echo '<form method="post" action ="Authentification.php">
            <input type="submit" class="btn btn-danger me-2" name="logout" value="Deconnexion">
          </form>';
      } else {
        echo '<a class="nav-item nav-link bg-success p-2 me-2 rounded" href="pageConnexion.php">Connexion</a>';
      }
      ?>

    </nav>