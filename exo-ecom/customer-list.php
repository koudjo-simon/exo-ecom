<?php
// Inclure le fichier con_db.php pour établir la connexion à la base de données
require_once 'con_db.php';

// Vérifier si le formulaire de suppression a été soumis
if (isset($_POST['delete_id'])) {
    $clientId = $_POST['delete_id'];

    // Requête pour supprimer le client de la base de données
    $deleteQuery = "DELETE FROM customer WHERE ID = $clientId";
    mysqli_query($con, $deleteQuery);

    // Rediriger vers la même page après la suppression
    header("Location: customer-list.php");
    exit();
}

// Requête pour récupérer les informations de tous les clients
$query = "SELECT * FROM customer";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Liste des clients</title>
</head>
<body>
<?php include 'navbar.php'?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">LISTE DES CLIENTS</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Variable pour numéroter les clients
                $numero = 1;

                // Afficher les informations de chaque client dans le tableau
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $numero . "</td>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['adresse'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>
                            <!-- Bouton pour la suppression avec confirmation -->
                            <form action='' method='post' onsubmit='return confirm(\"Êtes-vous sûr de vouloir supprimer ce client ?\")'>
                                <input type='hidden' name='delete_id' value='" . $row['ID'] . "'>
                                <button type='submit' class='btn btn-danger'>Supprimer</button>
                            </form>
                          </td>";
                    echo "</tr>";

                    $numero++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
