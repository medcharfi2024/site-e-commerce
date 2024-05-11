<?php
$host = "localhost";
$base = "ventematerielsinformatiques";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['refuser'])) {
            $id_commande_a_supprimer = $_POST['id_commande'];

            try {
                $pdo->beginTransaction();

                // Supprimer la commande de la table commande
                $query_delete_commande = "DELETE FROM commande WHERE id = :id_commande";
                $stmt_delete_commande = $pdo->prepare($query_delete_commande);
                $stmt_delete_commande->bindParam(':id_commande', $id_commande_a_supprimer, PDO::PARAM_INT);
                $stmt_delete_commande->execute();

                // Supprimer les lignes correspondantes dans la table produitCommande
                $query_delete_produitCommande = "DELETE FROM commandeproduit WHERE id_commande = :id_commande";
                $stmt_delete_produitCommande = $pdo->prepare($query_delete_produitCommande);
                $stmt_delete_produitCommande->bindParam(':id_commande', $id_commande_a_supprimer, PDO::PARAM_INT);
                $stmt_delete_produitCommande->execute();

                $pdo->commit();
                header("Location: gerer_commande.php");
                exit();
            } catch (PDOException $except) {
                $pdo->rollBack();
                echo "Erreur lors de la suppression de la commande : " . $except->getMessage();
            }
        } elseif (isset($_POST['accepter'])) {
            $id_commande_a_accepter = $_POST['id_commande'];

            try {
                $pdo->beginTransaction();

                // Mettre à jour l'état de la commande dans la table commande
                $query_update_commande = "UPDATE commande SET etat = 'accepté' WHERE id = :id_commande";
                $stmt_update_commande = $pdo->prepare($query_update_commande);
                $stmt_update_commande->bindParam(':id_commande', $id_commande_a_accepter, PDO::PARAM_INT);
                $stmt_update_commande->execute();

                // Mettre à jour la quantité en stock dans la table produit
                $query_update_stock = "UPDATE produit
                                       SET qte = qte - (SELECT SUM(quantite) FROM commandeproduit WHERE id_commande = :id_commande)
                                       WHERE id IN (SELECT id_produit FROM commandeproduit WHERE id_commande = :id_commande)";
                $stmt_update_stock = $pdo->prepare($query_update_stock);
                $stmt_update_stock->bindParam(':id_commande', $id_commande_a_accepter, PDO::PARAM_INT);
                $stmt_update_stock->execute();

                $pdo->commit();
                header("Location: gerer_commande.php");
                exit();
            } catch (PDOException $except) {
                $pdo->rollBack();
                echo "Erreur lors de la mise à jour de l'état de la commande : " . $except->getMessage();
            }
        }
    }
} catch (PDOException $e) {
    // Handle any connection-related errors here
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
