<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Formulaire Produit</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/amal/css.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 50px;
        }

        form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            color: #666;
            font-size: 16px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
session_start();
$host = "localhost";
$base = "ventematerielsinformatiques";
$user = "root";
$pass = "";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM produit";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $except) {
    echo "Echec de la connexion: " . $except->getMessage();
    die();
}
?>

<form action="submit_add.php" method="POST" enctype="multipart/form-data">
    <h2 class="mb-4">Ajouter Produit</h2>
    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="BrandName">BrandName :</label>
        <input type="text" id="BrandName" name="BrandName" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="designation">Désignation :</label>
        <input type="text" id="designation" name="designation" class="form-control" required>
    </div>

    <div class="form-group">
                <label for="categorie">Catégorie :</label>
                <select class="form-control" id="categorie" name="categorie" required>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "ventematerielsinformatiques";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("La connexion a échoué : " . $conn->connect_error);
                    }

                    $sql = "SELECT code_categorie, nom_categorie FROM categorie";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['code_categorie'] . "'>" . $row['nom_categorie'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Aucune catégorie trouvée</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

    <div class="form-group">
        <label for="prix_unitaire">Prix Unitaire :</label>
        <input type="number" id="prix_unitaire" name="prix_unitaire" step="0.01" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="quantite">Quantité :</label>
        <input type="number" id="quantite" name="quantite" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="image">Image :</label>
        <input type="file" id="image" name="image" class="form-control-file" required>
    </div>
    <div class="form-group">
        <label for="feature">Feature :</label>
        <input type="text" id="feature" name="feature" class="form-control" required>
    </div>

    <input type="submit" value="Enregistrer" class="btn btn-success">
</form>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
