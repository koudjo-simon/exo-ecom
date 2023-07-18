<?php
// Vérifier si le formulaire a été soumis
if (isset($_POST['product_name']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['quantite_stock'])) {
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

    // Récupération des données du formulaire
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite_stock = $_POST['quantite_stock'];

    // Récupération de l'image du produit
    $image = $_FILES['image']['name']; // Nom du fichier
    $imageTmp = $_FILES['image']['tmp_name']; // Emplacement temporaire du fichier

    // Chemin vers le dossier où stocker les images des produits
    $uploadDir = 'images/';

    // Vérification et déplacement de l'image vers le dossier de destination
    if (move_uploaded_file($imageTmp, $uploadDir . $image)) {
        // Utilisation d'une requête préparée pour insérer les données
        $query = "INSERT INTO produit (nom, description, prix, quantite_stock, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssdis", $product_name, $description, $prix, $quantite_stock, $image);

        if ($stmt->execute()) {
            // Rediriger l'utilisateur vers la liste des produits après un enregistrement réussi
            echo '<script>alert("Enregistrement réussi"); window.location.href = "product-list.php";</script>';
        } else {
            echo "Erreur lors de l'enregistrement : " . $db->error;
        }

        // Fermeture de la requête préparée
        $stmt->close();
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }

    // Fermeture de la connexion à la base de données
    $db->close();
}
?>