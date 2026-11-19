<!--Gabriel Vallieres -->
<?php
require "Require/ex.header.php"; 
require_once "classes/utilisateur.class.php";

if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
    header("Location: pageAcceuil.php");
    exit();
}

$sql = "SELECT * FROM villes ORDER BY nom_ville";
$requete = $conn->prepare($sql);
$requete->execute();
$villes = $requete->fetchAll(PDO::FETCH_ASSOC);


$error = "";

$oldInfo = $_SESSION["oldInfo"] ?? [];
unset($_SESSION["oldInfo"]);

if (isset($_SESSION["error"])) {
    $error = $_SESSION["error"];
    unset($_SESSION["error"]);
}
?>
<body>
    <h1>Inscription</h1>
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    <form method = "post"  action ="Authentification.php">
        <label for="userName">Nom d'utilisateur: </label><br>
        <input type="text" id="userName" name="userName" minlength="3" value="<?= htmlspecialchars($oldInfo["userName"] ?? "") ?>" required><br>
        
        <label for="email">Courriel: </label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($oldInfo["email"] ?? "") ?>" required><br>
        <label for="password">Mot de passe: </label><br>
        <input type="password" id="password" name="password" minlength="8" required><br>
        <label for="confirmedpassword">Confirmer le mot de passe: </label><br>
        <input type="password" id="confirmedpassword" name="confirmedpassword" minlength="8" required><br>
        <label for="age">Age: </label><br>
        <input type="number" id="age" name="age" min="18" max="100" value="<?= htmlspecialchars($oldInfo["age"] ?? "") ?>"><br>
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