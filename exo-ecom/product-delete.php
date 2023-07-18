<?php
// Vérifier si l'ID du produit à supprimer est présent dans l'URL
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

    // Récupération de l'ID du produit à supprimer
    $id = $_GET['id'];

    // Récupération du nom de l'image du produit à supprimer pour la supprimer du dossier
    $queryImage = "SELECT image FROM produit WHERE ID = ?";
    $stmtImage = $db->prepare($queryImage);
    $stmtImage->bind_param("i", $id);
    $stmtImage->execute();
    $stmtImage->store_result();
    if ($stmtImage->num_rows == 1) {
        $stmtImage->bind_result($image);
        $stmtImage->fetch();
        // Supprimer l'image du dossier si elle existe
        if (!empty($image)) {
            $uploadDir = 'D:/IMAGE_EXO/';
            unlink($uploadDir . $image);
        }
    }
    $stmtImage->close();

    // Utilisation d'une requête préparée pour supprimer le produit de la base de données
    $queryDelete = "DELETE FROM produit WHERE ID = ?";
    $stmtDelete = $db->prepare($queryDelete);

    // Vérification des erreurs de préparation de la requête
    if (!$stmtDelete) {
        die("Erreur de préparation de la requête : " . $db->error);
    }

    // Liaison des paramètres et exécution de la requête préparée
    $stmtDelete->bind_param("i", $id);

    if ($stmtDelete->execute()) {
        // Rediriger l'utilisateur vers la liste des produits après une suppression réussie
        echo '<script>
                if (confirm("Produit supprimé avec succès !")) {
                    window.location.href = "product-list.php";
                } else {
                    window.location.href = "product-list.php";
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
    // Rediriger l'utilisateur vers la liste des produits si l'ID du produit à supprimer n'est pas présent dans l'URL
    header("Location: product-list.php");
    exit();
}
?>
