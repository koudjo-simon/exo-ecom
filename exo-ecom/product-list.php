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

// Récupération des produits à partir de la base de données
$query = "SELECT ID, nom, prix, quantite_stock FROM produit";
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
<?php include "navbar.php"; ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex align-content-center justify-content-between">
            <h2>Liste des Produits</h2>
            <a class="btn btn-success" href="product-registration.php">AJOUTER</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Afficher les produits dans le tableau
                if ($result->num_rows > 0) {
                    $i = 1; // Initialisation du compteur de lignes
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $i . '</td>'; // Afficher le numéro ordonné
                        echo '<td>' . $row['nom'] . '</td>';
                        echo '<td>' . $row['prix'] . '</td>';
                        echo '<td>' . $row['quantite_stock'] . '</td>';
                        echo '<td>
    <a href="product-edit.php?id=' . $row['ID'] . '" class="btn btn-warning">Editer</a> |
    <a href="product-delete.php?id=' . $row['ID'] . '" class="btn btn-danger" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce produit ?\')">Supprimer</a>
</td>';
                        echo '</tr>';
                        $i++; // Incrémenter le compteur de lignes
                    }
                } else {
                    echo '<tr><td colspan="5">Aucun produit enregistré</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
