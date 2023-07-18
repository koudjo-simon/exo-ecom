<?php
global $con;
session_start();
include_once "con_db.php";

// supprimer les produits s'ils existent
if (isset($_GET['del'])) {
    $id_del = $_GET['del'];
    // Suppression
    unset($_SESSION['panier'][$id_del]);
    header("Location: cart.php");
    exit;
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

<div class="container mt-3">
    <div class="mt-5">
        <div class="card-header">
            <h3>Votre Panier</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                // Vérifier si le panier existe dans la session
                if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
                    // liste des produits
                    $ids = array_keys($_SESSION['panier']);
                    $produits = mysqli_query($con, "SELECT * FROM produit WHERE ID IN (" . implode(',', $ids) . ")");
                    // liste des produits avec une boucle
                    foreach ($produits as $product):
                        // calculer le prix total
                        $total += $product["prix"] * $_SESSION['panier'][$product['ID']];
                        ?>
                        <tr>
                            <td><?= $product["nom"] ?></td>
                            <td><?= $product["prix"] ?></td>
                            <td><?= $_SESSION['panier'][$product['ID']] ?></td>
                            <td>
                                <a class="btn btn-danger" href="cart.php?del=<?= $product["ID"] ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach;
                } else {
                    echo "<tr><td colspan='4'>Votre panier est vide</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-content-center justify-content-between">
            <h5>Prix Total</h5>
            <h5><?= $total ?> $</h5>
            <?php $_SESSION['total'] = $total; ?>
            <a class="btn btn-success" href="customer_info.php">Commander</a>
        </div>
    </div>
</div>

</body>
</html>
