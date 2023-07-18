<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations saisies par l'utilisateur
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Inclure le fichier con_db.php pour établir la connexion à la base de données
    require_once 'con_db.php';

    // Échapper les variables pour éviter les failles d'injection SQL
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    // Requête pour vérifier si l'utilisateur existe dans la base de données
    $query = "SELECT * FROM utilisateur WHERE email = '$email' AND mot_de_passe = '$password'";
    $result = mysqli_query($con, $query);

    // Vérifier si l'utilisateur existe dans la base de données
    if (mysqli_num_rows($result) == 1) {
        // L'utilisateur est authentifié, vous pouvez rediriger vers une autre page sécurisée
        header("Location: admin-welcome.php");
        exit();
    } else {
        // L'utilisateur n'existe pas ou les informations d'authentification sont incorrectes
        echo "<p class='text-danger'>Email ou mot de passe incorrect. Veuillez réessayer.</p>";
    }

    // Fermer la connexion à la base de données
    mysqli_close($con);
}
?>