<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php require "Require/ex.header.php"; ?>
<body>
    <form method = "post"  action ="index.php">
        <label for="artistName">Nom de l artiste : </label><br>
        <input type = "text" id="artistName" name="artistName"><br>
        <label for ="artistCity"> Ville : </label> <br>
        <input type = "text" id="artistCity"name="artistCity" > <br>
        <label for="artistPicture"> Photo de l artiste : </label> <br>
         <input type="file" id="artistPicture" name="artistPicture"><br><br>
        <input type="submit">
</form>


</body>
</html>