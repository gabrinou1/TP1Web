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

    <?php
    

    $isFormEntryValid = true;
    $isArtistWorkValid = true;
    $isNameValid = true;
    $isSongTimeValid = true;
    $isSongSizeValid = true;
    $isAlbumCodeValid = true;
    $isPriceValid = true;
    $isRoleValid = true;
    $isDateValid = true;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $artistWork = $_POST['artistWork'];
    $idArtiste  = $_POST['idArtiste'];
    $idRole     = $_POST['idRole'];
    $idAlbum    = $_POST['idAlbum'];
    $songTime   = $_POST['songTime'];
    $songSize   = $_POST['songSize'];
    $lyrics     = $_POST['lyrics'];
    $workDate   = $_POST['currentDate'];
    $workPrice  = $_POST['workPrice'];

    if (isset($artistWork)) {
        $artistWork = trim($_POST["artistWork"]);
        $_SESSION["artistWork"] = $artistWork;
        if ($artistWork === '' || !preg_match('/\p{L}/u', $artistWork)) {
            $isArtistWorkValid = false;
            $isFormEntryValid = false;
        }
    }
    
    $name = trim($_POST["name"]);
    $_SESSION["name"] = $name;
    if (isset($_POST["name"])) {
        if (!preg_match('/^\p{L}[\p{L} \'’.\-]*$/u', $name)) {
            $isNameValid = false;
            $isFormEntryValid = false;
        }
    }

    $songTime = trim($songTime);
    $_SESSION["songTime"] = $songTime;
    if (isset($songTime)) {
        if (0 >= (int) $songTime && !preg_match('/^\d+$/', $songTime)) {
            $isSongTimeValid = false;
            $isFormEntryValid = false;
        }
    }
    $songSize = trim($songSize);
    $_SESSION["songSize"] = $songSize;    
        if (0 >= (float) $songSize && !preg_match("/[0-9]{1,}/", $songSize)) {
            $isSongSizeValid = false;
            $isFormEntryValid = false;
        }
    
        $albumCode = trim($albumCode);
        $_SESSION["albumCode"] = $albumCode;
    
        if (!preg_match('/^[A-Z]{3}\d{4}$/', $albumCode)) {
            $isAlbumCodeValid = false;
            $isFormEntryValid = false;
        }
    $allowedRoles = ['Chanteur', 'Compositeur', 'Interprète', 'Auteur'];
    $artistRole = $_POST['artistRole'];
    $_SESSION['artistRole'] = $artistRole;
    if (isset($artistRole)) {
        $isRoleValid =false;
        $isFormEntryValid = false;
    }
    $workPrice = trim($workPrice);
    $_SESSION["workPrice"] = $workPrice;
    
        if (0 >= (float) $workPrice && !preg_match('/^\d+(\.\d{1,2})?$/', $workPrice)) {
            $isPriceValid = false;
            $isFormEntryValid = false;
        }
    
        $currentDate = $_POST["currentDate"];
        $_SESSION["currentDate"] = $currentDate;
    if (!$d || $d->format('Y-m-d') !== $currentDate || $currentDate > date('Y-m-d')) {
        $isDateValid = false;
        $isFormEntryValid = false;
    }
    $tabWorks = [];
    

    if ($isFormEntryValid) {
        $tabWorks = [
            'work'  => $artistWork,
            'name'  => $name,
            'role'  => $artistRole,
            'time'  => $songTime,
            'size'  => $songSize,
            'date'  => $currentDate,
            'code'  => $albumCode,
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
                <label for="name">Nom de l'artiste :</label>
                <input type="text" name="name" id="name" value="<?php if (isset($_SESSION['name'])) {
                    echo $_SESSION['name'];
                } ?>" required>
                <?php if ($isNameValid == false) {
                    echo '<p class="text-danger">Nom d\'artiste est invalide!</p>';
                } ?>
            </div>
            <div class="col-md-4 col-sm-12 d-flex">
                <label for="artistRole" class="me-2">Rôle de l'artiste :</label>
                <select style="width: 125px;" name="artistRole">
                    <option value="" selected></option>
                    <option value="Chanteur">Chanteur</option>
                    <option value="Compositeur">Compositeur</option>
                    <option value="Interprète">Interprète</option>
                    <option value="Auteur">Auteur</option>
                </select>
                <?php if (!$isRoleValid) {
                    echo '<p class="text-danger">Le rôle est invalide!</p>'; }?>
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
                    echo '<p class="text-danger">La date est invalide!</p>';} ?>
            </div>
            <div class="col-md-4">
                <label for="albumCode">Code de l'album :</label>
                <input type="text" name="albumCode" id="albumCode" value="<?php if (isset($_SESSION['albumCode'])) {
                    echo $_SESSION['albumCode'];
                } ?>" required>
                <?php if ($isAlbumCodeValid == false) {
                    echo '<p class="text-danger">Le code de l\'album est invalide!</p>';
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
                    AddOeuvre($name,$idArtiste,$idRole,$songTime,$songSize,$lyrics,$currentDate,$idAlbum,$workPrice);
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
    function AddOeuvre($title, $id_art, $id_role, $duration, $size, $lyrics, $additionDate, $id_album, $price) {
    try {
        $reqsql = "INSERT INTO oeuvres (titre_oeuvre, id_artiste, id_role, dureesec, taillemb, "
                . "lyrics, date_ajout, id_album, prix) VALUES (?,?,?,?,?,?,?,?,?);";
        $conn = SeConnecter();
        $rq = $conn->prepare($reqsql);
        $rq->execute(array($title, $id_art, $id_role, $duration, $size, $lyrics, $additionDate, $id_album, $price));
        $conn = null;
        return true;
    }
    catch (PDOException $e){
        echo "Erreur!";
    }
    }
   
                ?>


            </table>
        </div>


    </form>
</body>
<?php require "Require/ex.pied.php"; ?>