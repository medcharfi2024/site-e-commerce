<?php
session_start();
$host = "localhost";
$base = "ventematerielsinformatiques";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    // Définit le mode d'erreur PDO sur exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM produit";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $except) {
    echo "Échec de la connexion : " . $except->getMessage();
    die();
}

if (isset($_GET['id'])) {
    $codeProduit = $_GET['id'];

    try {
        $sql1 = "DELETE FROM produit WHERE produit.id = :codeProduit";
        $statement = $pdo->prepare($sql1);
        $statement->bindParam(':codeProduit', $codeProduit);
        $statement->execute();
        header("Location: crudProduit.php");

    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
}
?>
