



<?php require "Require/ex.header.php"; ?>
<body>
    <form method = "post"  action ="Authentification.php">
        <label for="userName">Nom d utilisateur: </label><br>
        <input type="text" id="userName" name="userName" minlength="3" required><br>
        <label for="email">Courriel: </label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe: </label><br>
        <input type="password" id="password" name="password" minlength="8" required><br>
        <label for="role">Role: </label><br>
        <select id="role" name="role">
            <option selected> Visiteur </option>
            <option> Gérant </option>
        </select>
        <input type="submit" value="s'inscrire" class="btn btn-primary">
        </form>
</body>
<?php require "Require/ex.pied.php"; ?>
</html>