<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ventematerielsinformatiques", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérification si un identifiant de produit est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Requête pour récupérer les données du produit avec l'identifiant spécifié
    $sql = "SELECT * FROM produit WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produit) {
        die("Produit non trouvé");
    }
} else {
    die("Identifiant du produit non spécifié");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un produit</title>
    <!-- Intégration des fichiers CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="inc/amal/css.css">
</head>
<body>

<div class="container mt-4">
    <h2>Modifier un produit</h2>

    <form action="modifier_produit.php" method="POST">
        <!-- Champ caché pour conserver l'identifiant du produit -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($produit['id']); ?>">

        <div class="mb-3">
            <label for="designation" class="form-label">Nouvelle désignation :</label>
            <input type="text" class="form-control" name="designation" id="designation" value="<?php echo htmlspecialchars($produit['designation']); ?>">
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Nouveau prix :</label>
            <input type="text" class="form-control" name="prix" id="prix" value="<?php echo htmlspecialchars($produit['prix']); ?>">
        </div>
        <div class="mb-3">
            <label for="quantite" class="form-label">Nouvelle quantité en stock :</label>
            <input type="text" class="form-control" name="quantite" id="quantite" value="<?php echo htmlspecialchars($produit['qte']); ?>">
        </div>
        <div class="mb-3">
    <label for="code_categorie" class="form-label">Nouvelle catégorie :</label>
    <select class="form-select" name="code_categorie" id="code_categorie">
        <?php
        // Récupération des catégories depuis la base de données
        $sql_categories = "SELECT * FROM categorie";
        $stmt_categories = $pdo->query($sql_categories);
        $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $categorie) {
            $selected = ($produit['code_categorie'] == $categorie['code_categorie']) ? 'selected' : '';
            echo "<option value='" . htmlspecialchars($categorie['code_categorie']) . "' $selected>" . htmlspecialchars($categorie['nom_categorie']) . "</option>";
        }
        ?>
    </select>
</div>

        <div class="mb-3">
            <label for="feature" class="form-label">Nouveau feature :</label>
            <input type="text" class="form-control" name="feature" id="feature" value="<?php echo htmlspecialchars($produit['feature']); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Modifier le produit</button>
    </form>
</div>

<!-- Intégration du script Bootstrap JavaScript (optionnel si nécessaire) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
