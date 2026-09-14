<?php require "Require/ex.header.php";?>

<?php
$jsonString = file_get_contents('data/albums.json');
$data = json_decode($jsonString, true);

if (isset($data['albums'])): ?>
<body>
    <div class="container my-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-4">          
            <?php foreach ($data['albums'] as $album): ?>
                <div class="col">
                    <div class="card h-100 border-0">
                        <img src="images/<?php echo $album['pht_couvt']; ?>" class="card-img-top album-cover" alt="Couverture de <?php echo $album['titre']; ?>">
                                               
                        <div class="card-body d-flex flex-column justify-between">
                            <p class="card-title mb-1 fs-3" title="<?php echo $album['titre']; ?>">
                                <strong> <?php echo $album['titre']; ?> </strong>
                            </p>
                            
                            <p class="card-text mb-3">
                                <span class="mb-1"><?php echo $album['description']; ?></span>
                                <br>
                                <span>Code : <?php echo $album['code_album']; ?></span>
                            </p>
                            
                            <div class="mt-auto">
                                <p class="mb-1"><strong> Pistes :</strong></p>
                                <?php if (!empty($album['titre_oeuvre'])): ?>
                                    <ol class="ps-3 mb-0">
                                        <?php foreach ($album['titre_oeuvre'] as $piste): ?>
                                            <li><?php echo $piste; ?></li>
                                        <?php endforeach; ?>
                                    </ol>
                                <?php else: ?>
                                    <p><em> Aucune piste</em></p>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
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