<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categorie_code_categorie'])) {
    $host = "localhost";
    $base = "ventematerielsinformatiques";
    $user = "root";
    $pass = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Suppression de la catégorie en fonction du code de catégorie
        $categorie_code = $_POST['categorie_code_categorie'];

        $query = "DELETE FROM categorie WHERE code_categorie = :code_categorie";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':code_categorie', $categorie_code);
        $statement->execute();

        // Redirection vers la page principale après la suppression
        header("Location: liste_categorie.php");
        exit();
    } catch (PDOException $except) {
        echo "Echec de la suppression de la catégorie: " . $except->getMessage();
        die();
    }
} else {
    // Redirection vers la page principale si la requête n'est pas de type POST ou si le code de la catégorie n'est pas défini
    header("Location: liste_categorie.php");
    exit();
}
?>
