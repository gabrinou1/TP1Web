<?php
require_once "classes/utilisateur.class.php";
session_start();

require "Require/ex.header.php";
require_once "connexionpdo.php";
?>

<?php
$jsonString = file_get_contents('data/albums.json');
$data = json_decode($jsonString, true);

if (isset($data['albums'])): ?>

    <body>
        <div class="container my-5">
            <h2 class="text-center mb-5"><strong>Collection d'album</strong></h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-4">
                <?php foreach ($data['albums'] as $album): ?>
                    <div class="col">
                        <section class="card" style="max-width: 320px">
                            <!-- <img src="images/<?php echo htmlspecialchars($album['pht_couvt']); ?>" class="card-img-top album-cover" alt="Couverture de <?php echo $album['titre']; ?>"> -->
                            <img src="images/AlbumIcon.jpg" class="card-img-top album-cover" alt="Couverture de <?php echo $album['titre']; ?>">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo htmlspecialchars($album['titre']); ?></h4>
                                <p class="card-text"><?php echo htmlspecialchars($album['description']); ?></p>
                                <p class="card-text">Code : <?php echo htmlspecialchars($album['code_album']); ?></p>
                                <div class="overflow-auto" style="height: 150px;">
                                    <p class="mb-1 fs-4"><strong> Pistes :</strong></p>
                                    <?php if (!empty($album['titre_oeuvre'])): ?>
                                        <ol class="ps-3 mb-0">
                                            <?php foreach ($album['titre_oeuvre'] as $piste): ?>
                                                <li><?php echo htmlspecialchars($piste); ?></li>
                                            <?php endforeach; ?>
                                        </ol>
                                    <?php else: ?>
                                        <p><em> Aucune piste</em></p>
                                    <?php endif; ?>
                                </div>
                                <a href="#" class="btn btn-primary">Ajouter au panier</a>
                            </div>
                        </section>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </body>
<?php
else:
    echo "Impossible de charger le fichier JSON";
endif;
?>


<?php require "Require/ex.pied.php"; ?>