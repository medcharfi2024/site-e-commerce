<?php

$host = "localhost";
$base = "ventematerielsinformatiques";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données des commandes et des produits liés
    $query = "SELECT c.id AS id_commande, c.id_user, c.adresse, c.mode_paiement, c.email, c.tel_user, c.montant, c.etat, cp.id_produit, cp.quantite
    FROM commande c
    INNER JOIN commandeProduit cp ON c.id = cp.id_commande";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Créer un tableau associatif pour stocker les commandes regroupées par ID Commande et ID User
    $groupedOrders = [];
    foreach ($result as $row) {
        $id_commande = $row['id_commande'];
        $id_user = $row['id_user'];

        if (!isset($groupedOrders[$id_commande][$id_user])) {
            $groupedOrders[$id_commande][$id_user] = [
                'id_commande' => $id_commande,
                'id_user' => $id_user,
                'adresse' => $row['adresse'],
                'mode_paiement' => $row['mode_paiement'],
                'email' => $row['email'],
                'tel_user' => $row['tel_user'],
                'montant' => $row['montant'],
                'etat' => $row['etat'],
                'produits' => [] // Tableau pour stocker les produits associés à la commande
            ];
        }

        // Ajouter les produits associés à la commande dans le format spécifique id-produit: quantite
        $groupedOrders[$id_commande][$id_user]['produits'][] = $row['id_produit'] . ' (' . $row['quantite'] . ')';
    }
} catch (PDOException $except) {
    echo "Echec de la connexion: " . $except->getMessage();
    die();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Affichage des commandes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/amal/css.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Table Commandes</h2>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Commande</th>
                            <th>ID User</th>
                            <th>Adresse</th>
                            <th>Mode de Paiement</th>
                            <th>Email</th>
                            <th>Téléphone User</th>
                            <th>Montant</th>
                            <th>etat </th>
                            <th>Produits</th>
                            <th>Action</th> <!-- Nouvelle colonne pour les boutons d'action -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($groupedOrders as $orders) {
    foreach ($orders as $order) { ?>
        <tr>
            <td><?= $order['id_commande']; ?></td>
            <td><?= $order['id_user']; ?></td>
            <td><?= $order['adresse']; ?></td>
            <td><?= $order['mode_paiement']; ?></td>
            <td><?= $order['email']; ?></td>
            <td><?= $order['tel_user']; ?></td>
            <td><?= $order['montant']; ?></td>
            <td><?= $order['etat']; ?></td> <!-- Affichage de l'état -->
            <td><?= implode(', ', $order['produits']); ?></td>
            <td>
            <form action="accepter_refuser_commande.php" method="post">
    <input type="hidden" name="id_commande" value="<?= $order['id_commande']; ?>">
    <button type="submit" name="accepter" class="btn btn-success">Accepter</button>
    <button type="submit" name="refuser" onclick="return confirmDelete();" class="btn btn-danger">Refuser</button>
</form>

            </td>
        </tr>
<?php }
} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmDelete() {
            if (confirm("Êtes-vous sûr de vouloir refuser cette commande ?")) {
                return true;
            }
            return false;
        }
    </script>
     <div class="container mt-4">
        <a href="crudProduit.php" class="btn btn-secondary">Return</a>
    </div>
</body>
</html>
