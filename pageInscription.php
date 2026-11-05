



<?php require "Require/ex.header.php"; 

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
        <label for="role">Rôle: </label><br>
        <select id="role" name="role">
            <option selected value="CLIENT"> Client </option>
            <option value="GERANT"> Gérant </option>
            <option value="ADMIN"> Administrateur </option>
        </select>
        <input type="submit" value="s'inscrire" class="btn btn-primary">
        </form>
</body>
<?php require "Require/ex.pied.php"; ?>
</html>