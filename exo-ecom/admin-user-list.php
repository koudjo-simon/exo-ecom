<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Liste des utilisateurs</title>
</head>
<body>
<script>
    function confirmDelete(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce gestionnaire?")) {
            window.location.href = 'admin-delete-user.php?id=' + id;
        }
    }
</script>
<?php include 'navbar.php'?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex align-content-center justify-content-between">
            <h3>LISTE DES GESTIONNAIRES</h3>
            <a class="btn btn-success" href="add-admin-user.php">Ajouter</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once 'con_db.php';

                // Récupérer les informations des gestionnaires (excepté le mot de passe)
                $query = "SELECT id, nom, adresse, email FROM utilisateur";
                $result = mysqli_query($con, $query);

                // Vérifier s'il y a des gestionnaires enregistrés
                if (mysqli_num_rows($result) > 0) {
                    // Afficher les informations de chaque gestionnaire dans le tableau
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['nom'] . "</td>";
                        echo "<td>" . $row['adresse'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>";
                        echo "<a href='admin-edit-user.php?id=" . $row['id'] . "' class='btn btn-warning'>Editer</a> | ";
                        echo "<a href='#' onclick='confirmDelete(" . $row['id'] . ")' class='btn btn-danger'>Supprimer</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Aucun gestionnaire enregistré
                    echo "<tr><td colspan='4'>Aucun gestionnaire enregistré.</td></tr>";
                }

                // Fermer la connexion à la base de données
                mysqli_close($con);
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
