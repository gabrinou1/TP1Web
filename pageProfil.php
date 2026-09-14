
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
    <div class="bg-white container-fluid justify-content-center">
        <h2>Votre profil</h2>
        <div>
            <div class="d-flex">
                <p>Nom d'utilisateur : </p>
                <p><?= htmlspecialchars($user->getName()) ?></p>
            </div>
            <div class="d-flex">
                <p>Email : </p>
                <p><?= htmlspecialchars($user->getEmail()) ?></p>
            </div>
            <div class="d-flex">
                <p>Role : </p>
                <p><?= htmlspecialchars($user->getRole()) ?></p>
            </div>
        </div>
    </div>



</body>
<?php require "Require/ex.pied.php"; ?>

</html>