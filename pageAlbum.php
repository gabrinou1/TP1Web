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
    <h1>Ajouter un album</h1>
    <form method="post" action="pageAlbum.php">
        
    </form>


</body>
<?php require "Require/ex.pied.php"; ?>

</html>