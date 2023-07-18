<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Liste des utilisateurs</title>
</head>
<body>
<?php include 'navbar.php' ?>
<div class="container mt-5">
    <div class="card col-md-6 offset-3">
        <div class="card-header">EDITION DU GESTIONNAIRE</div>
        <div class="card-body">
            <?php
            // Inclure le fichier con_db.php pour établir la connexion à la base de données
            require_once 'con_db.php';

            // Vérifier si l'ID du gestionnaire à éditer est passé en paramètre dans l'URL
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];

                // Récupérer les informations du gestionnaire à partir de l'ID
                $query = "SELECT id, nom, adresse, email FROM utilisateur WHERE id = $id";
                $result = mysqli_query($con, $query);

                // Vérifier si le gestionnaire existe
                if (mysqli_num_rows($result) === 1) {
                    $row = mysqli_fetch_assoc($result);

                    // Afficher le formulaire d'édition avec les informations pré-remplies
                    ?>
                    <form action="admin-edit-user-register.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['nom']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['adresse']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                        </div>
                        <button class="btn btn-primary float-end" type="submit">Enregistrer</button>
                    </form>
                    <?php
                } else {
                    echo "Gestionnaire introuvable.";
                }
            } else {
                echo "ID de gestionnaire non spécifié.";
            }

            // Fermer la connexion à la base de données
            mysqli_close($con);
            ?>
        </div>
    </div>
</div>
</body>
</html>
