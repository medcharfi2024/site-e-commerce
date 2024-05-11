<?php
session_start();
$host = "localhost";
$base = "ventematerielsinformatiques";
$user = "root";
$pass = "";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT  code_categorie, nom_categorie FROM categorie";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $except) {
    echo "Echec de la connexion: " . $except->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les catégories</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="table-container">
            <div class="table-responsive">
                <h2 class="my-1"><b>Categories</b></h2>
                <a href="add_categorie.php" class="btn btn-success custom-btn">Ajouter une catégorie</a>
                <br><br>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Code Catégorie</th>
                            <th scope="col">Nom Catégorie</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $categorie): ?>
                            <tr>
                                <td><?= $categorie['code_categorie'] ?></td>
                                <td><?= $categorie['nom_categorie'] ?></td>
                                <td>
                                    <!-- Formulaire de suppression -->
                                    <form method="POST" action="supp_categorie.php">
                                        <input type="hidden" name="categorie_code_categorie" value="<?= $categorie['code_categorie'] ?>">
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <a href="crudProduit.php" class="btn btn-secondary">Return</a>
    </div>
</body>
</html>
