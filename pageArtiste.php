<?php require "Require/ex.header.php"; ?>

<body>
    <form method="post" action="pageArtiste.php">
        <?php



        if (isset($_POST["artistName"])) {
            $name = trim($_POST["artistName"]);
            $_SESSION["artistName"] = $name;
            if (!preg_match("/[a-zA-Z]{3,}/", $name)) {

                echo "       Nom de l'artiste doit avoir plus de trois charactères!      ";
            }
        }
        if (isset($_POST["artistPicture"])) {
            $artistPicture = trim($_POST["artistPicture"]);
            $artistPicture = strtolower($artistPicture);
            $_SESSION["artistPicture"] = $artistPicture;
            if (!preg_match("/\.(jpg|jpeg|png)$/", $artistPicture)) {
                echo "Inseré un image valide!";
            }
        }
        if (isset($_POST["artistCity"])) {
            $artistCity = $_POST["artistCity"];
        }


        ?>
        <label for="artistName">Nom de l'artiste : </label><br>
        <input type="text" id="artistName" name="artistName" value="<?php if (isset($_SESSION['artistName'])) {
            echo $_SESSION['artistName'];
        } ?>" required><br>
        <label for="ville">Ville</label>
        <select class="form-select" name="artistCity" aria-label="Default select example">

            <option value="1">Toronto</option>
            <option value="2" selected>Gatineau</option>
            <option value="3">Montréal</option>
            <option value="4">Québec</option>
        </select>
        <label for="artistPicture">Photo de l'artiste : </label><br>
        <input type="text" id="artistPicture" name="artistPicture" value="<?php if (isset($_SESSION['artistPicture'])) {
            echo $_SESSION['artistPicture'];
        } ?>" required><br>
        <input type="submit" value="Enregister">
    </form>


</body>
<?php require "Require/ex.pied.php"; ?>

</html>