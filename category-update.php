<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $categoryID = $_POST['category_id'];
    $categoryName = $_POST['category_name'];
    $categoryDescription = $_POST['description'];

    // Utilisation d'une requête préparée pour mettre à jour les données
    $query = "UPDATE categorie SET nom = ?, description = ? WHERE ID = ?";
    $stmt = $db->prepare($query);

    // Vérification des erreurs de préparation de la requête
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $db->error);
    }

    // Liaison des paramètres et exécution de la requête préparée
    $stmt->bind_param("ssi", $categoryName, $categoryDescription, $categoryID);

    if ($stmt->execute()) {
        // Rediriger l'utilisateur vers la liste des catégories après la mise à jour réussie
        header("Location: category-list.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de la catégorie : " . $stmt->error;
    }

    // Fermeture de la requête préparée
    $stmt->close();

    // Fermeture de la connexion à la base de données
    $db->close();
} else {
    // Rediriger vers la liste des catégories si le formulaire n'a pas été soumis
    header("Location: category-list.php");
    exit();
}
?>
