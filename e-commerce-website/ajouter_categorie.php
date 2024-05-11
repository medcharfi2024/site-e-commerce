<?php

// Connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motdepasse = ""; // Mot de passe MySQL
$basededonnees = "ventematerielsinformatiques"; // Nom de la base de données

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupération du nom de la catégorie depuis le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_categorie = $_POST["nom_categorie"];

    // Requête d'insertion dans la table 'categorie'
    $requete = "INSERT INTO categorie (nom_categorie) VALUES ('$nom_categorie')";


    if ($connexion->query($requete) === TRUE) {
        echo "La catégorie a été ajoutée avec succès.";
        header("Location: liste_categorie.php");
    } else {
        echo "Erreur : " . $requete . "<br>" . $connexion->error;
    }
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>

