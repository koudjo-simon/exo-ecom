<?php
// connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "e-com-exam");
// vérifier la connexion
if (!$con) die('erreur : '.mysqli_connect_error());

?>