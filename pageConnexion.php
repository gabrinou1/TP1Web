<?php require "Require/ex.header.php"; 

if (isset($_SESSION["connexionSuccess"])) {
    echo '<p class="text-success">Inscription réussie!</p>';
}

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

        <label for="loginEmail">Courriel: </label><br>
        <input type="email" id="loginEmail" name="loginEmail" required><br>

        <label for="loginPassword">Mot de passe: </label><br>
        <input type="password" id="loginPassword" name="loginPassword" minlength="8" required><br>

        <input type="submit" value="se connecter" class="btn btn-primary">
        </form>
</body>
<?php require "Require/ex.pied.php"; ?>
</html>