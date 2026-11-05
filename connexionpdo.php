<?php

try{
    $servername = 'localhost';
    $username = 'root' ;
    $password = '';
    $bd='tp2_media_web';
    $conn = new PDO("mysql:host=$servername;dbname=$bd;charset=utf8", $username,$password);
}

catch(Exception $e)
{
    die('Erreur lors de la connexion a la BD: ' . $e->getMessage());
}
echo "<h2>Connexion reussie PDO ($bd)</h2>";
?>