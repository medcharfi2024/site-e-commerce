<?php
// Connexion à la base de données (à adapter selon votre configuration)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ventematerielsinformatiques";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur de PDO sur Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les catégories depuis la table 'categorie'
    $sql = "SELECT name FROM categorie"; // Adapter avec le nom de votre table et de votre colonne contenant les catégories

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Renvoyer les catégories au format JSON
    header('Content-Type: application/json');
    echo json_encode($categories);
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null; // Fermer la connexion à la base de données après l'utilisation
?>
