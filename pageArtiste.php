<?php require "Require/ex.header.php"; ?>

<body>
    <form method="post" action="pageArtiste.php">
        <label for="artistName">Nom de l'artiste : </label><br>
        <input type="text" id="artistName" name="artistName" value="<?php echo "$name" ?>" required><br>
        <label for="ville">Ville</label>
        <select class="form-select" aria-label="Default select example">

            <option value="1">Toronto</option>
            <option value="2" selected>Gatineau</option>
            <option value="3">Montréal</option>
            <option value="4">Québec</option>
        </select>
        <label for="artistPicture">Photo de l'artiste : </label><br>
        <input type="text" id="artistPicture" name="artistPicture" required><br>
        <input type="submit">
    </form>
    <?php

    $isValidated = true;
    if (isset($_POST["artistName"])) {
        $name = trim($_POST["artistName"]);
        $_SESSION["artistName"] = $name;
        if (!preg_match("/[a-zA-Z]{3,}/", $name)) {
            $isValidated = false;
            echo "Nom de l'artiste doit avoir plus de trois charactères!";
            $_SESSION["artistName"] = $name;
        }

        if (isset($_POST["artistPicture"])) {
            $pictureUrl = trim($_POST["artistPicture"]);
            strtolower($pictureUrl);
            if (!preg_match("/\.(jpg|jpeg|png)$/", $pictureUrl)) {
                $isValidated = false;
                echo "Inseré un image valide!";
                $_SESSION["pictureUrl"] = $pictureUrl;
            }
        }

    }

    ?>


</body>
<?php require "Require/ex.pied.php"; ?>

</html>