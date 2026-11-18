<?php require "Require/ex.header.php";?>

<div class="container my-5">

    <div class="row align-items-center">

        <div class="col-md-6">
            <img src="images/albums.jpg"
                 class="img-fluid rounded shadow"
                 alt="Collection musicale">
        </div>

        <div class="col-md-6">

            <?php if ($isConnected): ?>

                <h1>Bienvenue, <?= htmlspecialchars($user->getName()) ?> !</h1>

            <?php else: ?>

                <h1>Bienvenue dans notre médiathèque !</h1>

            <?php endif; ?>

            <a href="pageCollectionAlbum.php" class="btn btn-primary btn-lg mt-3">
                Voir la collection d'albums 
            </a>

        </div>

    </div>

</div>

<?php require "Require/ex.pied.php"; ?>
