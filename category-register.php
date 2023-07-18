<?php
// Vérifier si le formulaire a été soumis
if (isset($_POST['name']) && isset($_POST['description'])) {
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
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Utilisation d'une requête préparée pour insérer les données
    $query = "INSERT INTO categorie (nom, description) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $name, $description);

    if ($stmt->execute()) {
        echo '<script>alert("Enregistrement réussi"); window.location.href = "category-list.php";</script>';
    } else {
        echo '<script>alert("L\'enregistrement as  échoué " .error;); window.location.href = "category-list.php";</script>';
    }

    // Fermeture de la requête préparée et de la connexion à la base de données
    $stmt->close();
    $db->close();
}
?>