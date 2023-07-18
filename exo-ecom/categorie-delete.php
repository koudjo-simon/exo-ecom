<?php
// Vérifier si l'ID de la catégorie à supprimer est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Connection à la base de données
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "e-com-exam";

    $db = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Vérification des erreurs de connexion
    if ($db->connect_error) {
        die("Erreur de connexion à la base de données : " . $db->connect_error);
    }

    // Récupération de l'ID de la catégorie à supprimer
    $id = $_GET['id'];

    // Utilisation d'une requête préparée pour supprimer la catégorie de la base de données
    $queryDelete = "DELETE FROM categorie WHERE ID = ?";
    $stmtDelete = $db->prepare($queryDelete);

    // Vérification des erreurs de préparation de la requête
    if (!$stmtDelete) {
        die("Erreur de préparation de la requête : " . $db->error);
    }

    // Liaison des paramètres et exécution de la requête préparée
    $stmtDelete->bind_param("i", $id);

    if ($stmtDelete->execute()) {
        // Rediriger l'utilisateur vers la liste des catégories après une suppression réussie
        echo '<script>
                if (confirm("Catégorie supprimée avec succès !")) {
                    window.location.href = "category-list.php";
                } else {
                    window.location.href = "category-list.php";
                }
              </script>';
    } else {
        echo "Erreur lors de la suppression : " . $stmtDelete->error;
    }

    // Fermeture de la requête préparée
    $stmtDelete->close();

    // Fermeture de la connexion à la base de données
    $db->close();
} else {
    // Rediriger l'utilisateur vers la liste des catégories si l'ID de la catégorie à supprimer n'est pas présent dans l'URL
    header("Location: category-list.php");
    exit();
}
?>
