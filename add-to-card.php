<?php
// inclure la page de connexion
global $con;
include_once "con_db.php";
// Vérifier si une session existe
if (!isset($_SESSION)){
    // si non, démarrer une session
    session_start();
}
// créer la session
if (!isset($_SESSION['panier'])){
    // s'il n'existe pas une session, on crée une et on met un tableau à l'intérieur
    $_SESSION['panier'] = array();
}
// récupération de l'id dans le lien
if (isset($_GET['id'])){
    // si l'id a été envoyé alors
    $id = $_GET['id'];
    // vérifier grâce à l'id si le produit existe dans la base de données
    $produit = mysqli_query($con, "SELECT * FROM produit WHERE ID = $id");
    if (empty(mysqli_fetch_assoc($produit))){
        // si le produit n'existe pas
        die("Ce produit n'existe pas");
    }
    // ajouter le produit dans le panier
    if (isset($_SESSION['panier'][$id])){
        // si le produit est déjà dans le panier
        $_SESSION['panier'][$id]++; // Représente la quantité
    }else{
        // si non on ajoute le produit
        $_SESSION['panier'][$id] = 1;
    }
    // redirection vers la page index.php
    header("Location: index.php");
    exit;
}
