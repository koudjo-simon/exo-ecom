<?php
// Inclure le fichier con_db.php pour établir la connexion à la base de données
require_once 'con_db.php';

// Vérifier si l'ID de la commande à supprimer est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $commandeID = $_GET['id'];

    // Requête de suppression
    $query = "DELETE FROM commande WHERE ID = $commandeID";

    // Exécuter la requête de suppression
    if (mysqli_query($con, $query)) {
        // Rediriger vers la page d'affichage des commandes après la suppression
        echo '<script>alert("Suppression réussi"); window.location.href = "command-list.php";</script>';
        exit();
    } else {
        // En cas d'erreur lors de la suppression, afficher un message d'erreur
        echo "Erreur lors de la suppression de la commande : " . mysqli_error($con);
    }
}

// Fermer la connexion à la base de données
mysqli_close($con);
?>
