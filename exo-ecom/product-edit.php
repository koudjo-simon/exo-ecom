<?php
// Vérifier si un ID de produit a été passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

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

    // Récupération des informations du produit à partir de la base de données
    $query = "SELECT ID, nom, description, prix, quantite_stock, image, Categorie_ID FROM produit WHERE ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si le produit existe
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $product_name = $row['nom'];
        $description = $row['description'];
        $prix = $row['prix'];
        $quantite_stock = $row['quantite_stock'];
        $image = $row['image'];
        $category_id = $row['Categorie_ID'];
    } else {
        // Rediriger l'utilisateur vers la liste des produits s'il n'existe pas
        header("Location: product-list.php");
        exit();
    }

    // Fermer la connexion à la base de données
    $stmt->close();
    $db->close();
} else {
    // Rediriger l'utilisateur vers la liste des produits s'il manque l'ID
    header("Location: product-list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>ECOM-APP - Modifier le Produit</title>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="container mt-5">
    <div class="card col-md-6 offset-3">
        <div class="card-header">Modifier le Produit</div>
        <div class="card-body">
            <form action="product-update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="product_name" class="form-label">Nom du Produit</label>
                    <input type="text" class="form-control" id="product_name" name="product_name"
                           value="<?php echo $product_name; ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"
                              placeholder="Ecrivez une description du produit ici"><?php echo $description; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix du Produit</label>
                    <input type="number" class="form-control" id="prix" name="prix" value="<?php echo $prix; ?>">
                </div>
                <div class="mb-3">
                    <label for="quantite_stock" class="form-label">Quantité en stock</label>
                    <input type="number" class="form-control" id="quantite_stock" name="quantite_stock"
                           value="<?php echo $quantite_stock; ?>">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image du Produit</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <p>Image actuelle : <?php echo $image; ?></p>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie du Produit</label>
                    <select class="form-select" id="category" name="category">
                        <?php
                        // Connection à la base de données
                        $db = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

                        // Vérification des erreurs de connexion
                        if ($db->connect_error) {
                            die("Erreur de connexion à la base de données : " . $db->connect_error);
                        }

                        // Récupération des catégories à partir de la base de données
                        $query = "SELECT ID, nom FROM categorie";
                        $result = $db->query($query);

                        // Fermer la connexion à la base de données
                        $db->close();

                        // Afficher les catégories dans le menu déroulant
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $selected = ($row['ID'] == $category_id) ? 'selected' : '';
                                echo '<option value="' . $row['ID'] . '" ' . $selected . '>' . $row['nom'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-success float-end" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
