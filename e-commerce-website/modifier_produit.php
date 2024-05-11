<?php
// Vérification si les données du formulaire sont soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assurez-vous de sécuriser vos données avant de les utiliser dans une requête SQL
    $code_produit = $_POST["id"];
    $designation = $_POST["designation"];
    $prix = $_POST["prix"];
    $quantite = $_POST["quantite"];
    $code_categorie = $_POST["code_categorie"];
    $feature = $_POST["feature"];

    // Connexion à votre base de données - Assurez-vous d'utiliser les informations de connexion correctes
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'ventematerielsinformatiques';
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparation et exécution de la requête de mise à jour
    $sql = "UPDATE produit SET designation='$designation', prix='$prix', qte='$quantite', code_categorie='$code_categorie', feature='$feature' WHERE id='$code_produit'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>";
        echo "alert('edit succeded!');";
        echo "window.location.href = 'crudProduit.php';"; // Redirection vers une page spécifique après l'ajout
        echo "</script>";
    } else {
        echo "Erreur lors de la mise à jour du produit : " . $conn->error;
    }}
    
    // Fermeture de la connexion
    $conn->close();
    ?>