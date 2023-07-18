<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
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

    // Récupération de l'ID du produit à mettre à jour
    $id = $_POST['id'];

    // Récupération des données du formulaire
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite_stock = $_POST['quantite_stock'];
    $image = $_FILES['image']['name']; // Ajout de cette ligne pour récupérer la valeur de l'image
    $category = $_POST['category'];

    // Vérification si une nouvelle image a été téléchargée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Récupération de l'image du produit
        $imageTmp = $_FILES['image']['tmp_name'];

        // Chemin vers le dossier où stocker les images des produits
        $uploadDir = 'images/';

        chmod($uploadDir, 0755);

        // Vérification et déplacement de la nouvelle image vers le dossier de destination
        if (move_uploaded_file($imageTmp, $uploadDir . $image)) {
            // Suppression de l'ancienne image du produit (s'il en a une)
            $queryDeleteOldImage = "SELECT image FROM produit WHERE ID = ?";
            $stmtDeleteOldImage = $db->prepare($queryDeleteOldImage);
            $stmtDeleteOldImage->bind_param("i", $id);
            $stmtDeleteOldImage->execute();
            $stmtDeleteOldImage->store_result();
            if ($stmtDeleteOldImage->num_rows == 1) {
                $stmtDeleteOldImage->bind_result($oldImage);
                $stmtDeleteOldImage->fetch();
                if (!empty($oldImage)) {
                    unlink($uploadDir . $oldImage);
                }
            }
            $stmtDeleteOldImage->close();
        } else {
            echo "Erreur lors du téléchargement de la nouvelle image.";
            exit();
        }
    } else {
        // Si aucune nouvelle image n'a été téléchargée, conserver l'ancienne image
        $queryOldImage = "SELECT image FROM produit WHERE ID = ?";
        $stmtOldImage = $db->prepare($queryOldImage);
        $stmtOldImage->bind_param("i", $id);
        $stmtOldImage->execute();
        $stmtOldImage->store_result();
        if ($stmtOldImage->num_rows == 1) {
            $stmtOldImage->bind_result($oldImage);
            $stmtOldImage->fetch();
            $image = $oldImage;
        }
        $stmtOldImage->close();
    }

    // Utilisation d'une requête préparée pour mettre à jour les données
    $queryUpdate = "UPDATE produit SET nom = ?, description = ?, prix = ?, quantite_stock = ?, image = ?, Categorie_ID = ? WHERE ID = ?";
    $stmtUpdate = $db->prepare($queryUpdate);

// Vérification des erreurs de préparation de la requête
    if (!$stmtUpdate) {
        die("Erreur de préparation de la requête : " . $db->error);
    }

    $stmtUpdate->bind_param("sssissi", $product_name, $description, $prix, $quantite_stock, $image, $category, $id);

// Liaison des paramètres et exécution de la requête préparée
    if ($stmtUpdate->execute()) {
        // Rediriger l'utilisateur vers la liste des produits après une mise à jour réussie
        echo '<script>alert("Mise à jour réussie"); window.location.href = "product-list.php";</script>';
    } else {
        echo "Erreur lors de la mise à jour : " . $stmtUpdate->error;
    }

// Fermeture de la requête préparée
    $stmtUpdate->close();

// Fermeture de la connexion à la base de données
    $db->close();
} else {
    // Rediriger l'utilisateur vers la page d'édition du produit si le formulaire n'a pas été soumis correctement
    header("Location: edit-product.php?id=" . $_POST['id']);
    exit();
}
?>