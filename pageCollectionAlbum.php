// Aimeric Lachance
<?php
session_start();
require_once "connexionpdo.php";

$sqlAlbums = "SELECT a.id, a.titre, a.code_album, a.date_album, a.pht_couvt, g.descGenre 
              FROM albums a
              INNER JOIN genres g ON a.id_genre = g.id
              ORDER BY a.titre ASC";
$stmtAlbums = $conn->query($sqlAlbums);
$albums = $stmtAlbums->fetchAll(PDO::FETCH_ASSOC);

$sqlOeuvres = "SELECT o.id, o.titre_oeuvre, o.dureesec, o.taillemb, o.prix, ar.nom_artiste, r.descRole
               FROM oeuvres o
               INNER JOIN artistes ar ON o.id_artiste = ar.id
               INNER JOIN roles r ON o.id_role = r.id
               WHERE o.id_album = :id_album
               ORDER BY o.id ASC";
$stmtOeuvres = $conn->prepare($sqlOeuvres);

require_once 'Require/ex.header.php';
?>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-5"><strong>Catalogue des albums</strong></h2>
    
        <?php if (empty($albums)): ?>
            <p>Aucun album n'est disponible pour le moment.</p>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-4">
                <?php foreach ($albums as $album): ?>
                    <div class="col">
                        <section class="card border-0">
                            <?php
                                if (!empty($album['pht_couvt'])) 
                                {
                                    $image = htmlspecialchars($album['pht_couvt']);
                                } 
                                else 
                                {
                                    $image = 'images/AlbumIcon.jpg';
                                } 
                                ?>
                            <img src="images/albums/<?= $image ?>" class="card-img-top album-cover" alt="Pochette de <?= htmlspecialchars($album['titre']) ?>" width="150">
                            <div class="card-body d-flex flex-column justify-between">
                                <h3 class="card-title"><?= htmlspecialchars($album['titre']) ?></h3>
                                <p class="card-text mb-3">
                                    <span class="badge bg-secondary mb-1"><?= htmlspecialchars($album['code_album']) ?></span>
                                    <br>
                                    <span><strong>Genre :</strong> <?= htmlspecialchars($album['descGenre']) ?></span>
                                    <br>
                                    <span><strong>Date de sortie :</strong> <?= htmlspecialchars($album['date_album']) ?></span>
                                </p>
                            </div>
                                <?php
                                $stmtOeuvres->execute(['id_album' => $album['id']]);
                                $oeuvres = $stmtOeuvres->fetchAll(PDO::FETCH_ASSOC);
                                ?>
            
                                <div class="album-tracks">
                                    <h4>Liste des œuvres: <?= count($oeuvres) ?></h4>
                                    <?php if (empty($oeuvres)): ?>
                                        <p><em>Aucune œuvre associée à cet album.</em></p>
                                    <?php else: ?>
                                        <ul>
                                            <?php foreach ($oeuvres as $oeuvre): ?>
                                                <li>
                                                    <strong><?= htmlspecialchars($oeuvre['titre_oeuvre']) ?></strong> 
                                                    - <?= htmlspecialchars($oeuvre['nom_artiste']) ?> (<?= htmlspecialchars($oeuvre['descRole']) ?>)
                                                    | Durée : <?= gmdate("i:s", (int)$oeuvre['dureesec']) ?>
                                                    | Prix : <?= htmlspecialchars($oeuvre['prix']) ?> $
                                    
                                                    <?php if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['urRole'] === 'CLIENT'): ?>
                                                        <a href="panier.php?action=ajouter&id=<?= $oeuvre['id'] ?>">Ajouter au panier</a>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                        </section>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
<?php
require_once 'Require/ex.pied.php';
?>