<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        .custom-card {
            width: 250px;
            height: 500px;
        }

        .custom-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .custom-card .card-body {
            height: 250px;
            overflow: hidden;
        }
    </style>
    <title>BOUTIQUE</title>
</head>
<body>
<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">BOUTIQUE</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <!-- Ajouter un span avec un identifiant unique pour afficher le nombre de produits -->
                <a class="nav-link" style="color: #0a53be" href="cart.php">
                    Panier <span id="cartCount"><?php echo isset($_SESSION['panier']) ? '(' . array_sum($_SESSION['panier']) . ')' : '' ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="btn btn-outline-info" href="admin-login.php">CONNECTER</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Produits -->
<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-4">
        <?php
        // Inclure le fichier de connexion à la base de données
        include 'con_db.php';

        // Récupération des produits à partir de la base de données
        $query = "SELECT ID, nom, description, prix, quantite_stock, image, Categorie_ID FROM produit";
        $result = $con->query($query);

        // Afficher les produits dans des cartes
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col mb-4">';
                echo '<div class="card custom-card">';
                echo '<img src="images/' . $row['image'] . '" class="card-img-top" alt="' . $row['nom'] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['nom'] . '</h5>';
                echo '<p class="card-text">' . $row['description'] . '</p>';
                echo '<p class="card-text">Catégorie: ' . getCategoryName($row['Categorie_ID']) . '</p>';
                echo '<p class="card-text">Prix: ' . $row['prix'] . ' $</p>';
                echo '<p class="card-text">Quantité en stock: ' . $row['quantite_stock'] . '</p>';
                echo '</div>';
                echo '<div class="card-footer">';
                $id = $row['ID'];
                echo '<a type="submit" class="btn btn-primary btn-block float-end" href="add-to-card.php?id=' . $id . '">Ajouter</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-center">Aucun produit disponible</p>';
        }

        // Fonction pour récupérer le nom de la catégorie à partir de son ID
        function getCategoryName($categoryId)
        {
            global $con; // Accéder à la connexion à la base de données depuis cette fonction

            // Récupération du nom de la catégorie à partir de l'ID
            $query = "SELECT nom FROM categorie WHERE ID = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $categoryId);
            $stmt->execute();
            $stmt->bind_result($categoryName);
            $stmt->fetch();
            $stmt->close();

            return $categoryName;
        }

        // Fermer la connexion à la base de données
        $con->close();
        ?>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center py-4 mt-5">
    <a class="btn btn-success" href="cart.php">Aller au panier</a>
</footer>

</body>
</html>
