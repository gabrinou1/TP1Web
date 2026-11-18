
<?php require "Require/ex.header.php"; ?>

<?php
if (empty($_SESSION['user'])) {
    header("Location: pageConnexion.php");
    exit();
}
?>

<body>
    <?php
    if (isset($_SESSION["user"])) {
        $user = $_SESSION["user"];
    }
    ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="bg-light">
    <div class="container py-5">
        <div class="row">
            <!-- Profile Header -->
            <div class="col-12 mb-4">
                <div class="text-center">
                    <div class="position-relative d-inline-block">
                        <img src="images/PlaceholderPic.png" class="rounded-circle profile-pic" width="100" height="100" alt="Profile Picture">
                        <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    <h3 class="mt-3 mb-1"><?= htmlspecialchars($user->getName()) ?></h3>
                    <p class="text-muted mb-3"><?= htmlspecialchars($user->getRole()) ?></p>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-3 border-end">
                                <div class="p-4">
                                    <div class="nav flex-column nav-pills">
                                        <a class="nav-link active" href="pageProfil.php"><i class="fas fa-user me-2"></i>Information Personnel</a>
                                        <a class="nav-link" href="pageCommande.php"><i class="fas fa-lock me-2"></i>Commandes</a>
                                        <a class="nav-link" href="#"><i class="fas fa-bell me-2"></i>Notifications</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="p-4">
                                    <div class="mb-4">
                                        <h5 class="mb-4">Information Personnel</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nom</label>
                                                <input type="text" class="form-control" value="<?= htmlspecialchars($user->getName()) ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" value="<?= htmlspecialchars($user->getEmail()) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Recent Activity -->
                                    <div>
                                        <h5 class="mb-4">Commandes récentes</h5>
                                        <div class="activity-item">
                                            <h6 class="mb-1">Aucune commandes</h6>
                                            <p class="text-muted small mb-0">...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
<?php require "Require/ex.pied.php"; ?>

</html>