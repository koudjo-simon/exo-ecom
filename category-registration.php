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
        <div class="card-header">ENREGISTREMENT D'UNE CATECORIE DE PRODUIT</div>
        <div class="card-body">
            <form action="category-register.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de la Catégorie</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Appareil, ...">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="description" class="form-control" id="description" name="description" placeholder="Entrer une description de la catégorie">

                    </textarea>
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