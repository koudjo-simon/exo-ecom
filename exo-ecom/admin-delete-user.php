<?php
// Inclure le fichier con_db.php pour établir la connexion à la base de données
require_once 'con_db.php';

// Vérifier si l'ID du gestionnaire à supprimer est passé en paramètre dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Exemple de requête de suppression
    $query = "DELETE FROM utilisateur WHERE id = $id";

    if (mysqli_query($con, $query)) {
        // Rediriger vers la page des gestionnaires avec un message de succès
        echo '<script>alert("Suppression réussi"); window.location.href = "admin-user-list.php";</script>';
    } else {
        echo "Erreur lors de la suppression du gestionnaire : " . mysqli_error($con);
    }
}

// Fermer la connexion à la base de données
mysqli_close($con);
?>
