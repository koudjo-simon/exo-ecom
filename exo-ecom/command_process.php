<?php
session_start();
include_once "con_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations du formulaire
    $nom = $_POST['name'];
    $adresse = $_POST['address'];
    $tel = $_POST['tel'];
    $mot_de_passe = $_POST['mdp'];

    // Étape 1 : Insérer le client dans la table `customer`
    $query_insert_client = "INSERT INTO customer (nom, adresse, email, mot_de_passe) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($query_insert_client);
    $stmt->bind_param("ssss", $nom, $adresse, $tel, $mot_de_passe);
    $stmt->execute();
    $client_id = $con->insert_id; // Récupérer l'ID du client inséré

    // Étape 2 : Insérer la commande dans la table `commande`
    $date_commande = date("Y-m-d"); // Récupérer la date courante
    $statut = "En cours"; // Vous pouvez définir un statut par défaut pour la commande
    $total = $_SESSION['total']; // Récupérer le montant total du panier depuis la session
    $query_insert_commande = "INSERT INTO commande (date_commande, statut, montant_total, Client_ID) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($query_insert_commande);
    $stmt->bind_param("ssdi", $date_commande, $statut, $total, $client_id);
    $stmt->execute();
    $commande_id = $con->insert_id; // Récupérer l'ID de la commande insérée

    // Étape 3 : Insérer les lignes de commande dans la table `commandeline`
    foreach ($_SESSION['panier'] as $produit_id => $quantite) {
        // Récupérer le prix unitaire du produit depuis la base de données
        $query_select_prix = "SELECT prix FROM produit WHERE ID = ?";
        $stmt = $con->prepare($query_select_prix);
        $stmt->bind_param("i", $produit_id);
        $stmt->execute();
        $stmt->bind_result($prix_unitaire);
        $stmt->fetch();
        $stmt->close();

        // Insérer la ligne de commande dans la table `commandeline`
        $query_insert_ligne_commande = "INSERT INTO commandeline (quantite, prix_unitaire, Client_ID, Commande_ID, Produit_ID) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($query_insert_ligne_commande);
        $stmt->bind_param("iidii", $quantite, $prix_unitaire, $client_id, $commande_id, $produit_id);
        $stmt->execute();
    }

    // Étape 4 : Vider le panier et les variables de session
    $_SESSION['panier'] = array(); // Vider le panier
    unset($_SESSION['total']); // Supprimer la variable de session pour le montant total

    // Rediriger vers une page de confirmation ou de remerciement
    header("Location: thank_you_page.php");
    exit();
} else {
    // Rediriger vers la page du panier si l'utilisateur accède directement à checkout_process.php sans soumettre le formulaire
    header("Location: cart.php");
    exit();
}
?>