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
        <div class="card-header">ENREGISTREMENT D'UN UTILISATEUR</div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de l'Utilisateur</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Appareil, ...">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="exemple@email.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de Passe</label>
                    <input type="email" class="form-control" id="password" name="password" placeholder="Entrez le mot de passe">
                </div>
                <div class="mb-3">
                    <label for="confMdp" class="form-label">Confirmer le Mot de passe</label>
                    <input type="confMdp" class="form-control" id="confMdp" name="confMdp" placeholder="Entrer à nouveau le mot de passe">
                </div>
                <button class="btn btn-success float-end" type="submit">Valider</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>