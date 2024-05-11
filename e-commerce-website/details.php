<?php
session_start();
if (isset($_POST['add'])) {
    $product_id = htmlspecialchars($_POST['add']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Initialize the cart if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // If so, update the quantity
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        // If not, add the product and quantity to the cart
        $_SESSION['cart'][$product_id] = $quantity;
    }

    // Redirect back to the details page to avoid form resubmission
    header("Location: details.php?id=$product_id");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "inc/header.php" ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du produit</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/amal/css.css">

    <style>
      
         input[type="number"] {
            width: 50px; /* Largeur personnalisée */
            padding: 5px; /* Espacement intérieur */
            border: 1px solid #ccc; /* Bordure */
            border-radius: 4px; /* Coins arrondis */
            font-size: 16px; /* Taille de la police */
        }
         .quantity-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 10px;
      

    }
        
        body {
            padding-top: 0px;
        }

        .product-details {
            max-width: 600px;
            margin: 0 auto;
        }

        .product-details img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    <div class="container product-details">
        <h2 class="mt-4">Détails du produit :</h2>

        <?php
        if (isset($_GET['id'])) {
            $product_id = htmlspecialchars($_GET['id']);
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ventematerielsinformatiques";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM produit WHERE id = :product_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':product_id', $product_id);
                $stmt->execute();
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($product) {
        ?>
                    <div class="card">
                        <img src="<?= $product['image']; ?>" class="card-img-top" alt="<?= $product['nom']; ?>">
                        <div class="card-body">
                            <h3 class="card-title"><?= $product['nom']; ?></h3>
                            <p class="card-text"><strong>Prix :</strong>TND <?= $product['prix']; ?></p>
                            <p class="card-text"><strong>BrandName :</strong> <?= $product['BrandName']; ?></p>
                            <p class="card-text"><strong>Designation :</strong> <?= $product['designation']; ?></p>
                            <!-- Bouton pour retourner à la liste des produits -->
                            <a href="home.php" class="btn btn-primary">Retour à la page d'accueil</a>
                            <div class="quantity-container">
                             <form method="post" action="details.php?id=<?= $product_id ?>">
                               <input type="hidden" name="add" value="<?= $product_id ?>">
                              <input type="number" name="quantity" value="1" min="1">
                               <input type="submit" class="btn btn-primary" value="Ajouter au panier">
                               </form>
                             <!-- Formulaire pour accéder au panier -->
                            <form method="post" action="panier.php">
                           <input type="submit" class="btn btn-primary" value="Total">
                              </form>
                            </div>

                        </div>
                    </div>
                <?php
                    // Fermer la connexion à la base de données
                    $conn = null;
                } else {
                    echo "Aucun produit trouvé";
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            echo "ID du produit non spécifié";
        }
                ?>



      
</body>


</html>
