<?php
// Connexion à votre base de données (assurez-vous de remplacer les valeurs par vos propres informations de connexion)
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base_de_donnees = "ventematerielsinformatiques";

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

$query = $_GET['query'] ?? '';

// Requête SQL pour rechercher des produits
$sql = "SELECT * FROM produit WHERE nom LIKE '%" . $connexion->real_escape_string($query) . "%'"; 

$result = $connexion->query($sql);

// Formater les résultats en HTML
$resultsHTML = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultsHTML .= '<div class="card mb-3">';
        $resultsHTML .= '<a href="details.php?id=' . $row['id'] . '" class="text-decoration-none text-dark">';
        $resultsHTML .= '<div class="row g-0">';
        $resultsHTML .= '<div class="col-md-4">';
        $resultsHTML .= '<img src="' . $row["image"] . '" class="img-fluid product-image" style="max-width: 50px; max-height: 50px;" alt="' . $row["nom"] . '">';
        $resultsHTML .= '</div>';
        $resultsHTML .= '<div class="col-md-8">';
        $resultsHTML .= '<div class="card-body">';
        $resultsHTML .= '<h6 class="card-title" style="font-size: 12px;">' . $row['nom'] . '</h6>';
        // Ajoutez d'autres détails du produit ici si nécessaire
        $resultsHTML .= '</div></div></div></a></div>';
    }
} else {
    $resultsHTML = '<p class="text-center">Aucun produit trouvé.</p>';
}

echo $resultsHTML;

// Fermeture de la connexion à la base de données
$connexion->close();
?>
