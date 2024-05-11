<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'ventematerielsinformatiques';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $designation = $_POST['designation'];
    $categorie = $_POST['categorie'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $quantite = $_POST['quantite'];
    $feature = $_POST['feature'];
    $BrandName = $_POST['BrandName'];
    $nom = $_POST['nom'];

    $targetDirectory = "inc/images/produitImg/"; // Répertoire où vous souhaitez enregistrer les images
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "Le fichier " . htmlspecialchars(basename($_FILES["image"]["name"])) . " a été téléchargé.";
            // Maintenant, insérez le chemin d'accès à l'image dans la base de données
            $imagePath = $targetFile;

            // Utilisation de requête préparée pour éviter les injections SQL
            $sql = "INSERT INTO produit (nom, BrandName, designation, prix, qte, image,feature,code_categorie) VALUES (?, ?, ?, ?, ?, ? , ? , ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $nom, $BrandName, $designation, $prix_unitaire, $quantite, $imagePath,$feature,$categorie);

            if ($stmt->execute()) {
                echo "Le produit a été ajouté avec succès";
                header("Location: crudProduit.php"); // Redirection vers crudProduit.php
                exit();
              
            } else {
                echo "Erreur lors de l'insertion du produit : " . $stmt->error;
            }
        } else {
            echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }
    }
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
