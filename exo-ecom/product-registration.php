<?php
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

// Récupération des catégories à partir de la base de données
$query = "SELECT ID, nom FROM categorie";
$result = $db->query($query);

// Fermer la connexion à la base de données
$db->close();
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
<div class="container mt-5">
    <div class="card col-md-6 offset-3">
        <div class="card-header">AJOUT DE PRODUIT</div>
        <div class="card-body">
            <form action="product-register.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="product_name" class="form-label">Nom du Produit</label>
                    <input type="text" class="form-control" id="product_name" name="product_name"
                           placeholder="Appareil, ...">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" class="form-control"
                              id="description" name="description"
                              placeholder="Ecrivez une description du produit ici">

                </textarea>
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix du Produit</label>
                    <input type="number" class="form-control" id="prix" name="prix"
                           placeholder="Entrez le prix du produit">
                </div>
                <div class="mb-3">
                    <label for="quantite_stock" class="form-label">Quantité en stock</label>
                    <input type="number" class="form-control" id="quantite_stock" name="quantite_stock"
                           placeholder="Ex: 50">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image du Produit</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Nom du Produit</label>
                    <select class="form-select" id="category" name="category">
                        <option selected disabled>Sélectionnez un produit</option>
                        <?php
                        // Générer les options du menu déroulant à partir des catégories
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-success float-end" type="submit">Valider</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>