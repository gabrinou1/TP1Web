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
require "classes/utilisateur.class.php";
$isConnected = false;


session_start();
if (isset($_SESSION["connected"])) {
  $isConnected = true;
  $user = $_SESSION["user"];
}
?>

<body class="d-flex flex-column min-vh-100">


  <div class="container" id="detail">
    <div class="text-white d-flex align-items-center mt-2">
      <a href="pageAcceuil.php"><img src="images\LLM_Logo.png" alt="LLM-Logo" width="75px" height="75px"></a>
    </div>
    <hr />

    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
      <a class="navbar-brand ms-2" href="pageAcceuil.php">Médiatèque musical en ligne</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active px-10" href="pageAcceuil.php">Accueil <span
              class="sr-only"></span></a>
          <?php if ($isConnected) {
            if ($user->getRole() == "gerant") {
              echo '<a class="nav-item nav-link px-10" href="pageArtiste.php">Artiste</a>';
              echo '<a class="nav-item nav-link px-10" href="pageOeuvre.php">Oeuvres</a>';
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