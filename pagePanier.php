<?php
require_once "classes/utilisateur.class.php";
require_once "connexionpdo.php";

session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]->getRole() !== "CLIENT") {
    header("Location: pageAcceuil.php");
    exit();
}

if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = [];
}

$total = 0;

require "Require/ex.header.php";
?>

<div class="container my-5">

    <h2 class="text-center mb-5">Mon panier</h2>

    <?php if (empty($_SESSION["panier"])): ?>

        <p class="text-center">Votre panier est vide.</p>

        <a href="pageAcceuil.php" class="btn btn-primary">
            Continuer mes achats
        </a>

    <?php else: ?>

        <table class="table table-striped table-hover">

            <thead>
                <tr>
                    <th>Oeuvre</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($_SESSION["panier"] as $id => $quantity): ?>

                    <?php
                    $sql = "SELECT * FROM oeuvres WHERE id = :id";
                    $requete = $conn->prepare($sql);
                    $requete->execute(["id" => $id]);

                    $oeuvre = $requete->fetch(PDO::FETCH_ASSOC);

                    if (!$oeuvre) {
                        unset($_SESSION["panier"][$id]);
                        continue;
                    }

                    $subTotal = $oeuvre["prix"] * $quantity;
                    $total += $subTotal;
                    ?>

                    <tr>
                        <td>
                            <?= htmlspecialchars($oeuvre["titre_oeuvre"]) ?>
                        </td>

                        <td>
                            <?= number_format($oeuvre["prix"], 2) ?> $
                        </td>

                        <td>
                            <form action="GestionPanier.php" method="post">

                                <input type="hidden" name="id" value="<?= $id ?>">

                                <input type="number"
                                       name="quantite"
                                       value="<?= $quantity ?>"
                                       min="1"
                                       max="255"
                                       required
                                       style="width: 70px;">

                                <button type="submit"
                                        name="modifier"
                                        class="btn btn-secondary btn-sm">
                                    Modifier
                                </button>

                            </form>
                        </td>

                        <td>
                            <?= number_format($subTotal, 2) ?> $
                        </td>

                        <td>
                            <form action="GestionPanier.php" method="post">

                                <input type="hidden" name="id" value="<?= $id ?>">

                                <button type="submit"
                                        name="supprimer"
                                        class="btn btn-danger btn-sm">
                                    Supprimer
                                </button>

                            </form>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

        <h3 class="text-end">
            Total : <?= number_format($total, 2) ?> $
        </h3>

        <div class="d-flex justify-content-between mt-4">

            <a href="pageAcceuil.php" class="btn btn-secondary">
                Continuer mes achats
            </a>

            <form action="GestionPanier.php" method="post">
                <button type="submit" name="vider" class="btn btn-danger">
                    Vider le panier
                </button>
            </form>

            <button class="btn btn-success" disabled>
                Confirmer la commande
            </button>

        </div>

    <?php endif; ?>

</div>

<?php require "Require/ex.pied.php"; ?>