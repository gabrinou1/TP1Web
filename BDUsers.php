<?php require "Require/ex.header.php";?>

<?php
require_once('connexionpdo.php');
$reqsql='Select * from utilisateurs';
$requete = $conn->query($reqsql);

$lesusers = $requete->fetchAll();


$resultat = "<table class = 'table table-hover table-striped'><thead class='thead-light'>";
$resultat = $resultat."<tr><th scope='col'>#</th>";
$resultat = $resultat."<th scope='col'>Nom</th>";
$resultat = $resultat."<th scope='col'>Courriel</th>";
$resultat = $resultat."<th scope='col'>Role</th>";
$resultat = $resultat."<th scope='col'>Age</th> </tr></thead><tbody>";

foreach($lesusers as $user => $valeur){
    $resultat=$resultat."<tr><th scope='row'>$user</th>";
    $nom = $valeur['nom'];
    $courriel = $valeur['courriel'];
     $age = $valeur['age'];
    $role = $valeur['urRole'];
    $resultat=$resultat."<td>$nom</td>".
    "<td>$courriel</td><td>$role</td><td>$age</td></tr>";

}
$resultat=$resultat."</tbody></table>";
echo $resultat;
?>