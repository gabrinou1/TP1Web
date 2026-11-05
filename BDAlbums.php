<?php require "Require/ex.header.php";?>

<?php
require_once('connexionpdo.php');
$reqsql='Select * from albums';
$requete = $conn->query($reqsql);

$lesalbums = $requete->fetchAll();

$resultat = "<table class = 'table table-hover table-striped'><thead class='thead-light'>";
$resultat = $resultat."<tr><th scope='col'>#</th>";
$resultat = $resultat."<th scope='col'>titre</th>";
$resultat = $resultat."<th scope='col'>code</th>";
$resultat = $resultat."<th scope='col'>Date</th>";
$resultat = $resultat."<th scope='col'>Genre</th> </tr></thead><tbody>";

foreach($lesalbums as $album => $valeur){
    $resultat=$resultat."<tr><th scope='row'>$album</th>";
    $nom = $valeur['titre'];
    $codeAlbum = $valeur['code_album'];
    $date = $valeur['date_album'];
    $genre = $valeur['id_genre'];
    $resultat=$resultat."<td>$nom</td>".
    "<td>$codeAlbum</td><td>$date</td><td>$genre</td></tr>";

}
$resultat=$resultat."</tbody></table>";
echo $resultat;
?>
?>