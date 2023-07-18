<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Liste des commandes</title>
</head>
<body>
<?php include 'navbar.php'?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">LISTE DES COMMANDES</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Date de commande</th>
                    <th>Statut</th>
                    <th>Montant total</th>
                    <th>Client</th>
                    <th>Adresse</th>
                    <th>Code secret du client</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Inclure le fichier con_db.php pour établir la connexion à la base de données
                require_once 'con_db.php';

                // Récupérer les informations des commandes du plus récent au plus ancien
                $query = "SELECT c.ID, c.date_commande, c.statut, c.montant_total, cu.nom AS nom_client, cu.adresse, cu.mot_de_passe
                          FROM commande c
                          INNER JOIN customer cu ON c.Client_ID = cu.ID
                          ORDER BY c.date_commande DESC";
                $result = mysqli_query($con, $query);

                // Vérifier s'il y a des commandes enregistrées
                if (mysqli_num_rows($result) > 0) {
                    // Variable pour numéroter les commandes
                    $numero = 1;

                    // Afficher les informations de chaque commande dans le tableau
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Ajouter l'attribut data-id à la ligne pour stocker l'ID de la commande
                        echo "<tr data-id='" . $row['ID'] . "'>";
                        echo "<td>" . $numero . "</td>";
                        echo "<td>" . $row['date_commande'] . "</td>";
                        echo "<td>" . $row['statut'] . "</td>";
                        echo "<td>" . $row['montant_total'] . "</td>";
                        echo "<td>" . $row['nom_client'] . "</td>";
                        echo "<td>" . $row['adresse'] . "</td>";
                        echo "<td>" . $row['mot_de_passe'] . "</td>";
                        echo "<td><button class='btn btn-danger' onclick='confirmDelete(" . $row['ID'] . ")'>Supprimer</button></td>";
                        echo "</tr>";

                        $numero++;
                    }
                } else {
                    // Aucune commande enregistrée
                    echo "<tr><td colspan='7'>Aucune commande enregistrée.</td></tr>";
                }

                // Fermer la connexion à la base de données
                mysqli_close($con);
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Fonction pour afficher une boîte de dialogue de confirmation avant la suppression
    function confirmDelete(orderId) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette commande ?")) {
            // Rediriger vers le fichier delete-commande.php avec l'ID de la commande à supprimer
            window.location.href = 'commande-delete.php?id=' + orderId;
        }
    }

    // Fonction pour afficher les détails de la commande en double-cliquant
    function viewOrderDetails(event) {
        // Récupérer l'ID de la commande à partir de l'attribut data-id de la ligne cliquée
        const orderId = event.currentTarget.getAttribute('data-id');

        // Rediriger vers la page des détails de la commande en utilisant l'ID récupéré
        window.location.href = 'details-commande.php?id=' + orderId;
    }

    // Fonction d'initialisation pour ajouter un écouteur d'événement de double-clic à chaque ligne du tableau
    function initDoubleClickEvent() {
        const tableRows = document.querySelectorAll('tr[data-id]');
        tableRows.forEach(row => {
            row.addEventListener('dblclick', viewOrderDetails);
        });
    }

    // Appeler la fonction d'initialisation après le chargement de la page
    document.addEventListener('DOMContentLoaded', initDoubleClickEvent);
</script>

</body>
</html>
