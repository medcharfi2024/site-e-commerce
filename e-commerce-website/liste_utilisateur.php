<?php
// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ventematerielsinformatiques", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Requête pour récupérer les données des utilisateurs
$sql = "SELECT * FROM user"; // Assurez-vous d'adapter cette requête à votre table d'utilisateurs
$result = $pdo->query($sql);

if ($result) {
    $utilisateurs = $result->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("Erreur lors de la récupération des données : " . $pdo->errorInfo());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/amal/css.css">
    <style>
        /* Ajout de styles CSS personnalisés si nécessaire */
    </style>
</head>
<body>
    <div class="container">
        <div class="table-responsive">
            <h2 class="my-4">Liste des <b>Utilisateurs</b></h2>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th> <!-- Nouvelle colonne pour les actions -->
                    </tr>
                </thead>
                <tbody>
    <?php foreach ($utilisateurs as $utilisateur): ?>
        <tr>
            <td><?= $utilisateur['nom'] ?></td>
            <td><?= $utilisateur['prenom'] ?></td>
            <td><?= $utilisateur['email'] ?></td>
            <td><?= $utilisateur['role'] ?></td>
            <td>
                <!-- Formulaire pour Update -->
                <form action="update_util.php" method="GET" style="display: inline;">
                    <input type="hidden" name="user_id" value="<?= $utilisateur['id'] ?>">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>

                <!-- Formulaire pour Delete -->
                <form action="sup_util.php" method="POST" style="display: inline;">
                    <input type="hidden" name="user_id" value="<?= $utilisateur['id'] ?>">
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
            </table>
        </div>
    </div>
    <div class="container mt-4">
        <a href="crudProduit.php" class="btn btn-secondary">Return</a>
    </div>
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
