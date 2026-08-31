<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php require "Require/ex.header.php"; ?>
<body>
    <form method = "post"  action ="">
        <label for="userName">Nom d utilisateur: </label><br>
        <input type="text" id="userName" name="userName" required><br>
        <label for="email">Courriel: </label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe: </label><br>
        <input type="text" id="password" name="password" required><br>
        <input type="submit" value="Se connecter" class="btn btn-success">
        </form>
</body>
</html>