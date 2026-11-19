<?php
require_once "classes/utilisateur.class.php";
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]->getRole() !== "GERANT") {
    header("Location: pageAcceuil.php");
    exit();
}

require "Require/ex.header.php";
require_once "connexionpdo.php";
?>

<body>
    <h1>Ajouter un artiste</h1>
    <form method="post" action="pageArtiste.php" enctype="multipart/form-data">
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isFormEntryValid = true;
            $isNameValide = true;
            $isPictureValide = true;
            $isNameValide = true;

            if (isset($_POST["artistName"])) {
                $artistName = trim($_POST["artistName"]);
                $_SESSION["artistName"] = $artistName;
                if ($artistName === "") {
                    $isFormEntryValid = false;
                    $isNameValide = false;
                }
            }
        }
        $artistPicture = $_FILES["artistPicture"]["name"];        
        $artistPicture = strtolower($artistPicture);
        
        if (!preg_match("/\.(jpg|jpeg|png)$/", $artistPicture)) {
            $isPictureValide = false;
            $isFormEntryValid = false;
            }

        if (isset($_POST["city"])) {
            $artistCity = $_POST["city"];
            $_SESSION["artistCity"] = $artistCity;
        }


        ?>
        <div class="row mb-3 mt-3 mb-3 ms-1">
            <label for="artistName">Nom de l'artiste : </label><br>
            <input type="text" style="width: 200px;" id="artistName" name="artistName" <?php if (isset($_SESSION['artistName'])) {
                echo $_SESSION['artistName'];
            } ?> required><br>
            <?php if ($isNameValide == false) {
                echo '<p class="text-danger">Nom est invalide!</p>';
            } ?>

            <div class="mb-3">
                <label for="country">Pays :</label>
                <select class="form-control" id="country" name="country" required>
                    <?php
                    ListCountry();
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="city">Ville :</label>
                <select class="form-control" id="city" name="city" required>
                    <?php
                    ListCity();
                    ?>
                </select>
            </div>

            <label for="artistPicture">Photo de l'artiste : </label><br>
            <input type="file" style="width: 200px;" id="artistPicture" name="artistPicture" accept=".jpeg,.jpg,.png" <?php if (isset($_SESSION['artistPicture'])) {
                echo $_SESSION['artistPicture'];
            } ?> required><br>
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
                    AddArtist($artistName, $artistPicture, $artistCity);
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
                <?php }
                function AddArtist($name, $picture, $id_city)
                {
                    try {
                        $reqsql = "INSERT INTO artistes (nom_artiste, pht_artiste, id_ville) "
                            . "VALUES (?,?,?);";
                        global $conn;
                        $rq = $conn->prepare($reqsql);
                        $rq->execute(array($name, $picture, $id_city));
                        return true;
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                        return false;
                    }
                }
                function ListCountry()
                {
                    try {
                        $reqsql = "SELECT id, nom_pays FROM pays ORDER BY nom_pays;";
                        global $conn;
                        $reponse = $conn->prepare($reqsql);
                        $reponse->execute();
                        echo "<option value='-1'>Choisir un pays</option>";
                        while ($pays = $reponse->fetch()) {
                            echo "<option value='" . $pays['id'] . "'";
                            echo ">" . htmlspecialchars($pays['nom_pays']) . "</option>";
                        }
                        $reponse->closeCursor();
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }

                function ListCity()
                {
                    try {
                        $reqsql = "SELECT id, nom_ville FROM villes ORDER BY nom_ville;";
                        global $conn;
                        $reponse = $conn->prepare($reqsql);
                        $reponse->execute();
                        echo "<option value='-1'>Choisir une ville</option>";
                        while ($ville = $reponse->fetch()) {
                            echo "<option value='" . $ville['id'] . "'";
                            echo ">" . htmlspecialchars($ville['nom_ville']) . "</option>";
                        }
                        $reponse->closeCursor();
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
                ?>


            </table>
        </div>
    </form>


</body>
<?php require "Require/ex.pied.php"; ?>

</html>