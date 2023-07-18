<?php
// Inclure le fichier con_db.php pour établir la connexion à la base de données
require_once 'con_db.php';

// Vérifier si le formulaire d'édition a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];

    // Effectuer les vérifications nécessaires et les opérations de mise à jour dans la base de données
    // (ex. valider les champs obligatoires, vérifier la validité de l'email, etc.)

    // Exemple de requête de mise à jour
    $query = "UPDATE utilisateur SET nom='$name', adresse='$address', email='$email' WHERE id=$id";

    if (mysqli_query($con, $query)) {
        // Rediriger vers la page des gestionnaires avec un message de succès
        echo '<script>alert("Enregistrement réussi"); window.location.href = "admin-user-list.php";</script>';
    } else {
        echo "Erreur lors de l'édition du gestionnaire : " . mysqli_error($con);
    }
}

// Fermer la connexion à la base de données
mysqli_close($con);
?>
