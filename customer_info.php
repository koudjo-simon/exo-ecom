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
        <div class="card-header">INFORMATION D'IDENTIFICATION</div>
        <div class="card-body">
            <form action="command_process.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom et Prénos(s)</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Entrer votre nom et prenom(s)">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="address" name="address"
                           placeholder="Entrer où doit être livré la commande">
                </div>
                <div class="mb-3">
                    <label for="tel" class="form-label">Tel</label>
                    <input type="tel" class="form-control" id="tel" name="tel"
                           placeholder="Entrer votre nom complete">
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot ou Phrase Secret</label>
                    <input type="mdp" class="form-control" id="mdp" name="mdp"
                           placeholder="Vous donnerez ce secret au livreur pour confirmer votre identité">
                </div>
                <button class="btn btn-success float-end" type="submit">Valider</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>