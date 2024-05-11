<?php
// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ventematerielsinformatiques", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        // Requête de suppression de l'utilisateur
        $sql = "DELETE FROM user WHERE id = :user_id";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute(['user_id' => $user_id]);
            // Redirection vers une page ou un message de succès si nécessaire
            header("Location: liste_utilisateur.php"); // Remplacez index.php par votre page d'affichage des utilisateurs
            exit();
        } catch (PDOException $e) {
            // Gestion des erreurs de suppression
            die("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        }
    } else {
        echo "ID utilisateur non spécifié.";
    }
} else {
    echo "Méthode non autorisée pour accéder à cette page.";
}
?>
