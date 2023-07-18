<?php
// Vérifier si un ID de catégorie a été passé en paramètre
if (isset($_GET['id'])) {
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

    // Récupération de l'ID de catégorie à partir des paramètres GET
    $categoryID = $_GET['id'];

    // Récupération des informations de la catégorie depuis la base de données
    $query = "SELECT ID, nom, description FROM categorie WHERE ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $categoryID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si la catégorie existe
    if ($result->num_rows === 1) {
        $category = $result->fetch_assoc();
        $categoryName = $category['nom'];
        $categoryDescription = $category['description'];
    } else {
        // Rediriger vers la liste des catégories si la catégorie n'existe pas
        header("Location: category-list.php");
        exit();
    }

    // Fermeture de la connexion à la base de données
    $stmt->close();
    $db->close();
} else {
    // Rediriger vers la liste des catégories si aucun ID n'a été passé en paramètre
    header("Location: category-list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>ECOM-APP</title>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container mt-5">
    <div class="card col-md-6 offset-3">
        <div class="card-header">Édition de Catégorie</div>
        <div class="card-body">
            <form action="category-update.php" method="post">
                <input type="hidden" name="category_id" value="<?php echo $categoryID; ?>">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Nom de la Catégorie</label>
                    <input type="text" class="form-control" id="category_name" name="category_name"
                           value="<?php echo $categoryName; ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" class="form-control"
                              id="description" name="description"><?php echo $categoryDescription; ?></textarea>
                </div>
                <button class="btn btn-success float-end" type="submit">Valider</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
