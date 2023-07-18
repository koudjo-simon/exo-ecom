<?php
// Vérifier si l'ID de la commande est passé via l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $orderId = $_GET['id'];

    // Inclure le fichier con_db.php pour établir la connexion à la base de données
    require_once 'con_db.php';

    // Récupérer les informations de la commande à partir de son ID
    $query = "SELECT c.*, cu.* 
              FROM commande c
              INNER JOIN customer cu ON c.Client_ID = cu.ID
              WHERE c.ID = $orderId";
    $result = mysqli_query($con, $query);

    // Vérifier si la commande existe
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // ... Afficher les détails de la commande, y compris les lignes de commande et les infos du client ...

        // Récupérer les lignes de commandes pour la commande sélectionnée
        $queryCommandeLine = "SELECT cl.*, p.nom AS nom_produit, p.prix AS prix_unitaire
                              FROM commandeline cl
                              INNER JOIN produit p ON cl.Produit_ID = p.ID
                              WHERE cl.Commande_ID = $orderId";
        $resultCommandeLine = mysqli_query($con, $queryCommandeLine);
    } else {
        // La commande n'existe pas, rediriger vers la page des commandes
        header("Location: afficher-commandes.php");
        exit();
    }

    // Fermer la connexion à la base de données
    mysqli_close($con);
} else {
    // L'ID de la commande n'est pas fourni, rediriger vers la page des commandes
    header("Location: afficher-commandes.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Détails de la commande</title>
</head>
<body>
<?php include 'navbar.php'?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex align-content-center justify-content-between">
            <h3>DÉTAILS DE LA COMMANDE</h3>
            <a class="btn btn-info" href="command-list.php">Retour</a>
        </div>
        <div class="card-body">
            <h4>Informations de la commande :</h4>
            <p><strong>N° de commande :</strong> <?php echo $row['ID']; ?></p>
            <p><strong>Date de commande :</strong> <?php echo $row['date_commande']; ?></p>
            <p><strong>Statut :</strong> <?php echo $row['statut']; ?></p>
            <p><strong>Montant total :</strong> <?php echo $row['montant_total']; ?> $</p>
            <h4>Informations du client :</h4>
            <p><strong>Nom du client :</strong> <?php echo $row['nom']; ?></p>
            <p><strong>Adresse du client :</strong> <?php echo $row['adresse']; ?></p>
            <p><strong>Code secret du client :</strong> <?php echo $row['mot_de_passe']; ?></p>
            <h4>Lignes de commande :</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom du produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Prix total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $numero = 1;
                $totalCommande = 0;
                while ($rowCommandeLine = mysqli_fetch_assoc($resultCommandeLine)) {
                    $prixTotal = $rowCommandeLine['quantite'] * $rowCommandeLine['prix_unitaire'];
                    echo "<tr>";
                    echo "<td>" . $numero . "</td>";
                    echo "<td>" . $rowCommandeLine['nom_produit'] . "</td>";
                    echo "<td>" . $rowCommandeLine['quantite'] . "</td>";
                    echo "<td>" . $rowCommandeLine['prix_unitaire'] . " $</td>";
                    echo "<td>" . $prixTotal . " $</td>";
                    echo "</tr>";

                    $totalCommande += $prixTotal;
                    $numero++;
                }
                ?>
                </tbody>
            </table>
            <p><strong>Montant total de la commande :</strong> <?php echo $totalCommande; ?> $</p>
        </div>
    </div>
</div>
</body>
</html>
