<?php require "Require/ex.header.php"; 
require_once "connexionpdo.php";?>


<?php
if (empty($_SESSION['user'])) {
    header("Location: pageConnexion.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Order Details</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}

$sql = "SELECT * FROM commandes 
        WHERE id_utilisateur = :id_client 
        ORDER BY date_commande DESC";

$requete = $conn->prepare($sql);
$requete->bindValue(':id_client', $user->getId(), PDO::PARAM_INT);
$requete->execute();
$commandes = $requete->fetchAll(PDO::FETCH_ASSOC);
?>


<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <h2>Commandes</h2>
                        </div>
                    </div>
                </div>
                <div class="table-filter">
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#id</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Etat</th>
                            <th>Prix</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($commandes as $commande) : ?>
                                <td value="<?= $commande["id"] ?>"><?= htmlspecialchars($commande["id"]) ?></td>
                                <td><?= htmlspecialchars($user->getName()) ?></a></td>
                                <td><?= htmlspecialchars($commande["date_commande"]) ?></td>
                                <td><?= htmlspecialchars($commande["etat_commande"]) ?></td>
                                <td>$254</td>
                            <td><a href="#" class="view" title="View Details" data-toggle="tooltip"><i class="material-icons">&#xE5C8;</i></a></td>
                            <?php endforeach; ?>   
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>