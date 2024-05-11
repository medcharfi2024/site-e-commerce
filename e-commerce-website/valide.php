<?php
session_start();

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'ventematerielsinformatiques';

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    // Paramétrer PDO pour afficher les exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $adresse = $_POST['adresse'];
        $typePaiement = $_POST['typePaiement'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $montant = $_POST['montantTotal'];
      

        $queryUserId = "SELECT id FROM user WHERE email = ?";
        $stmtUserId = $pdo->prepare($queryUserId);
        $stmtUserId->execute([$email]);
        $userData = $stmtUserId->fetch(PDO::FETCH_ASSOC);
    
        if ($userData) {
            $id_user = $userData['id'];


        
        $queryCommande = "INSERT INTO commande (id_user,adresse, mode_paiement, email, tel_user, montant) VALUES (?,?, ?, ?, ?, ?)";
        $stmtCommande = $pdo->prepare($queryCommande);
        // Exécuter la requête avec les valeurs fournies
        $stmtCommande->execute([$id_user,$adresse, $typePaiement, $email, $tel, $montant]);}

        $idCommande = $pdo->lastInsertId();

        // Insérer les produits du panier dans la table "commande_produit"
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                if ($product_id != 0) {
                    // Insérer les détails du produit dans la table "commande_produit"
                    $queryCommandeProduit = "INSERT INTO commandeProduit (id_commande, id_produit, quantite) VALUES (?, ?, ?)";
                    $stmtCommandeProduit = $pdo->prepare($queryCommandeProduit);
                    // Exécuter la requête avec les valeurs fournies
                    $stmtCommandeProduit->execute([$idCommande, $product_id, $quantity]);
                }
            }
        }

       
   

$_SESSION['cart'] = array(); // Cela vide le panier

header("Location: confirmation.php");
exit;

    }
} catch (PDOException $e) {
    // En cas d'erreur, afficher le message d'erreur
    echo "Erreur : " . $e->getMessage();
}
?>
