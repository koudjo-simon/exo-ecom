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
        <div class="card-header">ENREGISTREMENT D'UN GESTIONNAIRE</div>
        <div class="card-body">
            <form action="add-admin-user-registration.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Entre le nom">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="address" name="address"
                           placeholder="Entrer l'adresse">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="Entrer l'adresse">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Entrer le mot de passe">
                </div>
                <div class="mb-3">
                    <label for="conf_pwd" class="form-label">Confirmer Mot de passe</label>
                    <input type="password" class="form-control" id="conf_pwd" name="conf_pwd"
                           placeholder="Entrer de nouveau le mot de passe">
                </div>
                <button class="btn btn-success float-end" type="submit">Valider</button>
            </form>
        </div>
    </div>
    <!-- Afficher la carte de succès ici -->
    <?php if (isset($successCard)) echo $successCard; ?>
</div>
</body>
</html>