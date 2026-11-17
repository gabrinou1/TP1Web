<?php
require_once "classes/utilisateur.class.php";
require_once "connexionpdo.php";

session_start();

if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
    header("Location: pageAcceuil.php");
    exit();
}

$sql = "SELECT * FROM villes ORDER BY nom_ville";
$requete = $conn->prepare($sql);
$requete->execute();
$villes = $requete->fetchAll(PDO::FETCH_ASSOC);
require "Require/ex.header.php"; 

$error = "";

if (isset($_SESSION["error"])) {
    $error = $_SESSION["error"];
    unset($_SESSION["error"]);
}
?>
<body>
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    <form method = "post"  action ="Authentification.php">
        <label for="userName">Nom d'utilisateur: </label><br>
        <input type="text" id="userName" name="userName" minlength="3" required><br>
        
        <label for="email">Courriel: </label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe: </label><br>
        <input type="password" id="password" name="password" minlength="8" required><br>
        <label for="confirmedpassword">Confirmer le mot de passe: </label><br>
        <input type="password" id="confirmedpassword" name="confirmedpassword" minlength="8" required><br>
        <label for="age">Age: </label><br>
        <input type="number" id="age" name="age" min="18" max="100"><br>
        <label for="ville">Ville :</label><br>
        <select id="ville" name="ville"> 
        <option value="">Sélectionner une ville</option>
        <?php foreach ($villes as $ville) : ?>
        <option value="<?= $ville["id"] ?>">
            <?= htmlspecialchars($ville["nom_ville"]) ?>
        </option>
        <?php endforeach; ?>
        </select><br>
        <input type="submit" value="s'inscrire" class="btn btn-primary">
        </form>
</body>
<?php require "Require/ex.pied.php"; ?>
</html>