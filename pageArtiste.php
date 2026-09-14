<?php require "Require/ex.header.php"; 

if ($_SESSION['user']->getRole() !== 'gerant') {
    header("Location: pageAccueil.php");
    exit();
}

?>
<body>
    <form method="post" action="pageArtiste.php">
        <?php
        $isFormEntryValid = true;
        $isNameValide = true;
        $isPictureValide = true;

        if (isset($_POST["artistName"])) {
            $artistName = trim($_POST["artistName"]);
            $_SESSION["artistName"] = $artistName;
            if (!preg_match("/[a-zA-Z]{3,}/", $artistName)) {
                $isNameValide = false;
            }
        }
        if (isset($_POST["artistPicture"])) {
            $artistPicture = trim($_POST["artistPicture"]);
            $artistPicture = strtolower($artistPicture);
            $_SESSION["artistPicture"] = $artistPicture;
            if (!preg_match("/\.(jpg|jpeg|png)$/", $artistPicture)) {
                $isPictureValide = false;
            }
        }
        if (isset($_POST["artistCity"])) {
            $artistCity = $_POST["artistCity"];
            $_SESSION["artistCity"] = $artistCity;
        }


        ?>
        <div class="row mb-3 mt-3 mb-3 ms-1">
            <label for="artistName">Nom de l'artiste : </label><br>
            <input type="text" style="width: 200px;" id="artistName" name="artistName" value="<?php if (isset($_SESSION['artistName'])) {
                echo $_SESSION['artistName'];
            } ?>" required><br>
            <?php if ($isNameValide == false) {
                echo '<p class="text-danger">Nom est invalide!</p>';
            } ?>
            <label for="ville">Ville</label>
            <select class="form-select" style="width: 200px;" name="artistCity" aria-label="Default select example">

                <option value="Toronto">Toronto</option>
                <option value="Gatineau" selected>Gatineau</option>
                <option value="Montréal">Montréal</option>
                <option value="Québec">Québec</option>
            </select>
            <label for="artistPicture">Photo de l'artiste : </label><br>
            <input type="text" style="width: 200px;" id="artistPicture" name="artistPicture" value="<?php if (isset($_SESSION['artistPicture'])) {
                echo $_SESSION['artistPicture'];
            } ?>" required><br>
            <?php if ($isPictureValide == false) {
                echo '<p class="text-danger">Photo de l\'artiste est invalide!</p>';
            } ?>
            <div class="mb-3 d-flex justify-content-center">
                <input type="submit" value="Enregister">
            </div>
            <table class="table table-striped">
                <?php

                $tabWorks = [];
                if ($isFormEntryValid === true && $_SERVER['REQUEST_METHOD'] === 'POST') {

                    $tabWorks = [
                        'artistName' => $_SESSION['artistName'],
                        'city' => $_SESSION['artistCity'],
                        'picture' => $_SESSION['artistPicture'],

                    ];
                }

                if (!isset($_SESSION['artistInfo'])) {
                    $_SESSION['artistInfo'] = [];
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isFormEntryValid == true && !in_array($tabWorks, $_SESSION['artistInfo'])) {

                    $_SESSION['artistInfo'][] = $tabWorks;
                }
                ?>
                <thead>
                    <tr>
                        <th>Nom de l'artist</th>
                        <th>Ville</th>
                        <th>Photo</th>
                    </tr>
                </thead>
                <?php
                foreach ($_SESSION['artistInfo'] as $info) {
                    ?>
                    <tbody>
                        <tr>
                            <td><?= $info['artistName'] ?></td>
                            <td><?= $info['city'] ?></td>
                            <td><?= $info['picture'] ?></td>
                        </tr>
                    </tbody>
                <?php } ?>


            </table>
        </div>
    </form>


</body>
<?php require "Require/ex.pied.php"; ?>

</html>