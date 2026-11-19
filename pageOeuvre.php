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
    <h1>Ajouter une oeuvre</h1>

    <?php


    $isFormEntryValid = true;
    $isArtistWorkValid = true;
    $isArtistValid = true;
    $isSongTimeValid = true;
    $isSongSizeValid = true;
    $isAlbumValid = true;
    $isPriceValid = true;
    $isRoleValid = true;
    $isDateValid = true;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $artistWork = $_POST['artistWork'];
        $idArtiste = $_POST['idArtiste'];
        $idRole = $_POST['idRole'];
        $idAlbum = $_POST['idAlbum'];
        $songTime = $_POST['songTime'];
        $songSize = $_POST['songSize'];
        $lyrics = $_POST['lyrics'];
        $currentDate = $_POST['currentDate'];
        $workPrice = $_POST['workPrice'];


        $artistWork = trim($_POST["artistWork"]);
        $_SESSION["artistWork"] = $artistWork;
        if ($artistWork === '' || !preg_match("/[a-zA-Z0-9]{1,}/", $artistWork)) {
            $isArtistWorkValid = false;
            $isFormEntryValid = false;
        }



        $_SESSION["idArtiste"] = $idArtiste;
        if (!preg_match("/^[0-9]{1,}$/", $idArtiste) || !ArtistExist($idArtiste)) {
            $isArtistValid = false;
            $isFormEntryValid = false;

        }

        $songTime = trim($songTime);
        $_SESSION["songTime"] = $songTime;
        if (!preg_match("/^[0-9]{1,}$/", $songTime) || $songTime <= 0) {
            if (0 >= $songTime || !preg_match("/^[0-9]{1,}$/", $songTime)) {
                $isSongTimeValid = false;
                $isFormEntryValid = false;
            }
        }
        $songSize = trim($songSize);
        $_SESSION["songSize"] = $songSize;
        if (0 >= $songSize || !preg_match("/^[0-9]{1,}(\.[0-9]{1,})?$/", $songSize)) {
            $isSongSizeValid = false;
            $isFormEntryValid = false;
        }

        $idAlbum = $_POST['idAlbum'];
        $_SESSION["idAlbum"] = $idAlbum;

        if (!preg_match("/^[0-9]{1,}$/", $idAlbum) || !AlbumExist($idAlbum)) {
            $isAlbumValid = false;
            $isFormEntryValid = false;
        }
        $idRole = $_POST['idRole'];
        $_SESSION['idRole'] = $idRole;
        if (!preg_match("/^[0-9]{1,}$/", $idRole) || !RoleExist($idRole)) {
            $isRoleValid = false;
            $isFormEntryValid = false;
        }
        $workPrice = trim($workPrice);
        $_SESSION["workPrice"] = $workPrice;

        if (0 >= $workPrice && !preg_match("/^[0-9]{1,}(\.[0-9]{1,2})?$/", $workPrice)) {
            $isPriceValid = false;
            $isFormEntryValid = false;
        }

        $currentDate = $_POST["currentDate"];
        $_SESSION["currentDate"] = $currentDate;
        $d = DateTime::createFromFormat('Y-m-d', $currentDate);
        if (!$d || $d->format('Y-m-d') !== $currentDate || $currentDate > date('Y-m-d')) {
            $isDateValid = false;
            $isFormEntryValid = false;
        }
        $tabWorks = [];


        if ($isFormEntryValid) {
            $tabWorks = [
                'work' => $artistWork,
                'name' => $idArtiste,
                'role' => $idRole,
                'time' => $songTime,
                'size' => $songSize,
                'date' => $currentDate,
                'code' => $idAlbum,
                'price' => $workPrice
            ];
        }
    }
    ?>
    <form method="post" action="pageOeuvre.php">
        <div class="row mb-3 mt-3 mb-3">

            <div class="col-md-4 col-sm-12">
                <label for="artistWork">Nom de l'oeuvre :</label>
                <input type="text" name="artistWork" id="artistWork" value="<?php if (isset($_SESSION['artistWork'])) {
                    echo $_SESSION['artistWork'];
                } ?>" required>
                <?php if ($isArtistWorkValid == false) {
                    echo '<p class="text-danger">Le nom de l\'oeuvre est invalide!</p>';
                } ?>
            </div>

            <div class="col-md-4 col-sm-12">
                <label for="idArtiste">Artiste :</label>
                <select class="form-control" id="idArtiste" name="idArtiste" required>
                    <?php ListArtist($idArtiste); ?>
                </select>
                <?php if (!$isArtistValid) {
                    echo '<p class="text-danger">L\'artiste est invalide!</p>';
                } ?>
            </div>

            <div class="col-md-4 col-sm-12 d-flex">
                <label for="idRole" class="me-2">Rôle de l'artiste :</label>
                <select class="form-control" id="idRole" name="idRole" required>
                    <?php ListRole($idRole); ?>
                </select>
                <?php if (!$isRoleValid) {
                    echo '<p class="text-danger">Le rôle est invalide!</p>';
                } ?>
            </div>

        </div>
        <div class="row mb-3">

            <div class="col-md-6 col-sm-12">
                <label for="songTime">Temps de la chanson en seconde :</label>
                <input type="text" name="songTime" id="songTime" value="<?php if (isset($_SESSION['songTime'])) {
                    echo $_SESSION['songTime'];
                } ?>" required>
                <?php if ($isSongTimeValid == false) {
                    echo '<p class="text-danger">La durée de la chanson est invalide!</p>';
                } ?>
            </div>

            <div class="col-md-6 col-sm-12">
                <div>
                    <label for="songSize">Taille en MB :</label>
                    <input type="text" name="songSize" id="songSize" value="<?php if (isset($_SESSION['songSize'])) {
                        echo $_SESSION['songSize'];
                    } ?>">
                    <?php if ($isSongSizeValid == false) {
                        echo '<p class="text-danger">La taille de la chanson est invalide!</p>';
                    } ?>
                </div>

            </div>
        </div>
        <div class="mb-3 w-25">
            <label for="lyrics">Lyrics de la chanson :</label>
            <textarea class="form-control" name="lyrics" id="lyrics" rows="3"></textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="currentDate">Date d'ajout à l'album :</label>
                <input type="date" name="currentDate" id="currentDate" value="<?php echo date("Y-m-d") ?>" required>
                <?php if (!$isDateValid) {
                    echo '<p class="text-danger">La date est invalide!</p>';
                } ?>
            </div>
            <div class="col-md-4">
                <label for="idAlbum">Album :</label>
                <select class="form-control" id="idAlbum" name="idAlbum" required>
                    <?php ListAlbum($idAlbum); ?>
                </select>
                <?php if (!$isAlbumValid) {
                    echo '<p class="text-danger">L\'album est invalide!</p>';
                } ?>
            </div>
            <div class="col-md-4">
                <label for="workPrice">Prix de l'oeuvre :</label>
                <input type="text" name="workPrice" id="workPrice" value="<?php if (isset($_SESSION['workPrice'])) {
                    echo $_SESSION['workPrice'];
                } ?>" required>
                <?php if ($isPriceValid == false) {
                    echo '<p class="text-danger">Le prix est invalide!</p>';
                } ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="youtubeLink">Lien de la vidéo youtube :</label>
            <input type="text" name="youtubeLink" id="youtubeLink" value="<?php if (isset($_SESSION['youtubeLink'])) {
                echo $_SESSION['youtubeLink'];
            } ?>">
            <div class="mb-3 d-flex justify-content-center">
                <input type="submit" value="Enregister">
            </div>
            <table class="table table-striped w-100">
                <?php
                if (!isset($_SESSION['allWorks'])) {
                    $_SESSION['allWorks'] = [];
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isFormEntryValid == true && !in_array($tabWorks, $_SESSION['allWorks'])) {
                    AddWork($artistWork, $idArtiste, $idRole, $songTime, $songSize, $lyrics, $currentDate, $idAlbum, $workPrice);
                    echo "L'œuvre a été ajoutée avec succès!";
                    $_SESSION['allWorks'][] = $tabWorks;
                }
                ?>
                <thead>
                    <tr>
                        <th>Oeuvre</th>
                        <th>Artiste</th>
                        <th>Rôle</th>
                        <th>Durée (Seconde)</th>
                        <th>Taille (MB)</th>
                        <th>Date d'ajout</th>
                        <th>Code d'album</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <?php
                foreach ($_SESSION['allWorks'] as $info) {
                    ?>
                    <tbody>
                        <tr>
                            <td><?= $info['work'] ?></td>
                            <td><?= $info['name'] ?></td>
                            <td><?= $info['role'] ?></td>
                            <td><?= $info['time'] ?></td>
                            <td><?= $info['size'] ?></td>
                            <td><?= $info['date'] ?></td>
                            <td><?= $info['code'] ?></td>
                            <td><?= $info['price'] . "$" ?></td>
                        </tr>
                    </tbody>
                <?php }
                function AddWork($title, $id_art, $id_role, $duration, $size, $lyrics, $additionDate, $id_album, $price)
                {
                    try {
                        $reqsql = "INSERT INTO oeuvres (titre_oeuvre, id_artiste, id_role, dureesec, taillemb, "
                            . "lyrics, date_ajout, id_album, prix) VALUES (?,?,?,?,?,?,?,?,?);";
                        global $conn;
                        $rq = $conn->prepare($reqsql);
                        $rq->execute(array($title, $id_art, $id_role, $duration, $size, $lyrics, $additionDate, $id_album, $price));
                        return true;
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                        return false;
                    }
                }

                function ListAlbum($idselect)
                {
                    try {
                        $reqsql = "SELECT id, code_album FROM albums ORDER BY code_album;";
                        global $conn;
                        $reponse = $conn->prepare($reqsql);
                        $reponse->execute();
                        echo "<option value='-1'>Choisir un album</option>";
                        while ($album = $reponse->fetch()) {
                            echo "<option value='" . $album['id'] . "'";
                            if ($idselect == $album['id']) {
                                echo " selected='selected'";
                            }
                            echo ">" . htmlspecialchars($album['code_album']) . "</option>";
                        }
                        $reponse->closeCursor();

                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                        return false;
                    }
                }
                function AlbumExist($id)
                {
                    global $conn;
                    $rq = $conn->prepare("SELECT id FROM albums WHERE id = ?");
                    $rq->execute(array($id));
                    return $rq->rowCount() > 0;
                }




                function ListRole($idSelect)
                {
                    global $conn;
                    try {
                        $reponse = $conn->prepare("SELECT id, descRole FROM roles ORDER BY descRole;");
                        $reponse->execute();
                        echo "<option value='-1'>Choisir un rôle</option>";
                        while ($role = $reponse->fetch()) {
                            echo "<option value='" . $role['id'] . "'";
                            if ($idSelect == $role['id'])
                                echo " selected='selected'";
                            echo ">" . htmlspecialchars($role['descRole']) . "</option>";
                        }
                        $reponse->closeCursor();
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                        return false;
                    }
                }
                function RoleExist($id)
                {
                    global $conn;
                    $rq = $conn->prepare("SELECT id FROM roles WHERE id = ?");
                    $rq->execute(array($id));
                    return $rq->rowCount() > 0;
                }

                function ListArtist($idSelect)
                {
                    global $conn;
                    try {
                        $reponse = $conn->prepare("SELECT id, nom_artiste FROM artistes ORDER BY nom_artiste;");
                        $reponse->execute();
                        echo "<option value='-1'>Choisir un artiste</option>";
                        while ($art = $reponse->fetch()) {
                            echo "<option value='" . $art['id'] . "'";
                            if ($idSelect == $art['id'])
                                echo " selected='selected'";
                            echo ">" . htmlspecialchars($art['nom_artiste']) . "</option>";
                        }
                        $reponse->closeCursor();
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
                function ArtistExist($id)
                {
                    global $conn;
                    $rq = $conn->prepare("SELECT id FROM artistes WHERE id = ?");
                    $rq->execute(array($id));
                    return $rq->rowCount() > 0;
                }

                
                ?>


            </table>
        </div>


    </form>
</body>
<?php require "Require/ex.pied.php"; ?>