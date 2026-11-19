<!-- // Gabriel Vallieres -->
<?php
require_once "classes/utilisateur.class.php";
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]->getRole() !== "GERANT") {
    header("Location: pageAcceuil.php");
    exit();
}

require "Require/ex.header.php";
require_once "connexionpdo.php";

$sql = "SELECT * FROM genres";
$requete = $conn->prepare($sql);
$requete->execute();
$genres = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <h1>Ajouter un album</h1>
    <form class="row g-1" method="post" action="confirmationAjout.php">
        <div class="row-auto">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>
        <label>Genre</label>
        <select name="genre" class="form-select" required>
            <?php foreach ($genres as $genre): ?>
                <option value="<?= $genre["id"] ?>">
                    <?= htmlspecialchars($genre["descGenre"]) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="row-auto">
            <label for="date" class="form-label">Date de création</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="row-auto">
            <label for="couverture" class="form-label">Couverture de l'album</label>
            <input type="file" class="form-control" id="couverture" name="couverture">
        </div>
        <div class="row-auto">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" pattern="[A-Z]{3}[0-9]{4}"
                maxlength="7"
                placeholder="ABC1234" id="code" name="code" required>
        </div>
        <button type="submit" name="ajouterAlbum" class="btn btn-primary">Ajouter l'album</button>

    </form>


</body>
<?php require "Require/ex.pied.php"; ?>

</html>