<?php
global $con;
require_once 'con_db.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs saisies dans les champs du formulaire
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $conf_pwd = $_POST["conf_pwd"];

    // Exemple de vérification : Vérifier si tous les champs obligatoires sont remplis
    if (empty($name) || empty($address) || empty($email) || empty($password) || empty($conf_pwd)) {
        echo "Veuillez remplir tous les champs obligatoires.";
        exit;
    }

    // Vérifier si les mots de passe correspondent
    if ($password != $conf_pwd) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    $query = "INSERT INTO utilisateur (nom, adresse, email, mot_de_passe) VALUES ('$name', '$address', '$email', '$password')";

    if (mysqli_query($con, $query)) {
        header("Location: admin-user-list.php");
        exit;
    } else {
        echo "Erreur lors de l'enregistrement du gestionnaire : " . mysqli_error($con);
    }
}
?>
