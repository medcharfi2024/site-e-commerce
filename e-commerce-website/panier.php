<?php
$host = "localhost";
$dbname = "ventematerielsinformatiques";
$user = "root";
$pass = "";
session_start();?>

<?php

if (!isset($_SESSION['prenom'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.php");
    exit(); // Arrêter l'exécution du script après la redirection
}


?>
<?php
function getCartContents()
{
    global $host, $dbname, $user, $pass, $pdo;

    try {
        $cartContentsHTML = '';
        $totalPrice = 0;

        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                if ($product_id != 0) {
                    $query = "SELECT id, nom, prix,image FROM produit WHERE id = :product_id";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->execute();
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($product) {
                        $productTotal = $product['prix'] * $quantity;
                        $totalPrice += $productTotal;

                        $cartContentsHTML .= "<tr>";
                        $cartContentsHTML .= "<td>{$product['nom']}</td>";
                        $cartContentsHTML .= "<td>{$quantity}</td>";
                        $cartContentsHTML .= "<td>{$product['prix']} TND</td>";
                        $cartContentsHTML .= "<td>{$productTotal} TND</td>";
                        $cartContentsHTML .= "<td><img src='{$product['image']}' alt='{$product['nom']}' style='width: 100px; height: auto;'></td>";
                        $cartContentsHTML .= "<td>
                        <a href='panier.php?remove={$product['id']}' class='btn btn-danger'>delete</a>
                        <a href='panier.php?decrement={$product['id']}' class='btn btn-warning'>-</a>
                        <a href='panier.php?increment={$product['id']}' class='btn btn-success'>+</a>
                     </td>";

                        $cartContentsHTML .= "</tr>";
                    } else {
                        echo "Product not found for ID: $product_id<br>";
                    }
                }
            }
        }

        return array('html' => $cartContentsHTML, 'total' => $totalPrice);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
        return array('html' => '', 'total' => 0);
    }
}

if (isset($_GET['remove'])) {
    $remove_id = htmlspecialchars($_GET['remove']);
    // Remove the product from the cart
    unset($_SESSION['cart'][$remove_id]);
    // Reload the page to reflect the changes
    header("Location: panier.php");
    exit;
}
if (isset($_GET['decrement'])) {
    $decrement_id = htmlspecialchars($_GET['decrement']);
    // Decrement the quantity in the cart
    if (isset($_SESSION['cart'][$decrement_id])) {
        $_SESSION['cart'][$decrement_id]--;
        if ($_SESSION['cart'][$decrement_id] <= 0) {
            unset($_SESSION['cart'][$decrement_id]);
        }
        // Reload the page to reflect the changes
        header("Location: panier.php");
        exit;
    }
}
if (isset($_GET['increment'])) {
    $increment_id = htmlspecialchars($_GET['increment']);
    // Increment the quantity in the cart
    if (isset($_SESSION['cart'][$increment_id])) {
        $_SESSION['cart'][$increment_id]++;
        // Reload the page to reflect the changes
        header("Location: panier.php");
        exit;
    }
}


$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="inc/amal/css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
   
      table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Styles for the buttons */
        .btn-action {
            margin-right: 0px;
          
        }
        /* Styles pour la classe titre-panier */
        .titre-panier {
    font-size: 40px; /* Taille de la police */
    color: #333; /* Couleur du texte */
    border-bottom: 2px solid #ccc; /* Ajoute une bordure au bas du titre */
    margin-bottom: 10px; /* Décale le titre vers le bas de 20 pixels */
    /* Autres styles que vous souhaitez appliquer */
}
/* Styles pour le bouton "Vider le Panier" */
.btn-vider-panier {
    /* Ajoutez vos styles personnalisés ici */
    background-color: #ff0000; /* Exemple : couleur de fond rouge */
    color: #ffffff; /* Exemple : texte en blanc */
    border: 1px solid white; /* Exemple : bordure rouge de 1 pixel */
    padding: 10px 20px; /* Exemple : espacement interne de 10px en haut/bas et 20px à gauche/droite */
    margin-top : 20px;
}
/* Styles pour l'élément <p> du montant total */
.total-panier {
    font-size: 18px; /* Taille de la police */
    color: #555; /* Couleur du texte */
    margin-top: -30px;
  
}
.cadre-bouton {
    display: inline-block; /* Pour que le cadre s'adapte à la largeur du contenu */
    padding: 8px 16px; /* Espacement interne */
    border: 1px solid #ccc; /* Bordure */
    border-radius: 4px; /* Coins arrondis */
    background-color: #f5f5f5; /* Couleur de fond */
    cursor: pointer; /* Curseur indiquant l'interactivité */
    margin-top: -50px;
}
/* Styles pour l'élément <p> lorsque le panier est vide */
.panier-vide-message {
    font-style: italic; /* Style d'écriture italique */
    font-size: 30px; /* Taille de la police */
    color: #888; /* Couleur du texte */
    text-align: center; /* Alignement centré du texte */
    margin-top: 20px; /* Espacement vers le haut pour la mise en page */
    /* Autres styles que vous souhaitez appliquer */
}
/* Styles pour le bouton de retour à la page d'accueil */
.btn-primary {
    display: inline-block;
    padding: 8px 16px;
    margin-top: 10px; /* Espacement vers le haut pour la mise en page */
    font-size: 14px;
    font-weight: bold;
    text-decoration: none;
    color: #fff;
    background-color: #0096c7;
    border: 1px solid #007bff;
    border-radius: 4px;
    margin-left: 200px;
    
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    border-right: 50px
}
.btn-ajout-produits {
    /* Vos styles personnalisés pour le bouton "Ajout de produits" */
    background-color: #0077b6;
    color: #ffffff;
   margin-top : -65px ;
}






    </style>
</head>

<body>

<div class="container">
    <h2 class="titre-panier">Votre Panier</h2>
    <form method="post" class="d-flex justify-content-end">
        <button type="submit" class="btn btn-danger" name="empty_cart">Vider le Panier</button>
    </form>
    <form action="home.php" method="get">
    <button type="submit" class="btn btn-ajout-produits" name="empty_cart">Ajout de produits</button>
</form>
<form action="commande.php" method="get">
        <button type="submit" class="btn btn-danger">valider  Commande</button>
    </form>


</br>

    <p class="total-panier cadre-bouton">Total: <?= getCartContents()['total']; ?> TND</p>
  
</div>

        <!-- Handle Empty Cart Button Submission -->
        <?php
        if (isset($_POST['empty_cart'])) {
            // Clear the cart
            $_SESSION['cart'] = array();
            // Reload the page to reflect the changes
            header("Location: panier.php");
            exit;
        }
        ?>




        <!-- Display cart contents in a table -->
        <?php if (!empty($_SESSION['cart'])) : ?>
            <table class="table">
            <thead>
    <tr>
        <th colspan="10" style="background-color: #f2f2f2; text-align: center;">Détails du Panier</th>
    </tr>
    <tr>
        <th scope="col">Produit</th>
        <th scope="col">Quantité</th>
        <th scope="col">Prix Unitaire</th>
        <th scope="col">Prix Total</th>
        <th scope="col">image</th>
        <th scope="col">Action</th>
    </tr>
</thead>
                <tbody>
                    <?php
                    // Get cart contents HTML and total
                    $cartDetails = getCartContents();
                    echo $cartDetails['html'];
                    $_SESSION['total_price'] = $cartDetails['total'];
                    ?>
                </tbody>
            </table>
            <?php else : ?>
    <p class="panier-vide-message">Votre panier est vide.</p>
    
<?php endif; ?>


    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>