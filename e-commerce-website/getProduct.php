<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des Produits</title>
  <!-- Intégration de Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="inc/amal/css.css">
  <!-- Votre style CSS personnalisé -->
  <style>
    /* Ajoutez ici vos styles personnalisés */
    /* Par exemple : */
    .product-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
      background-color: #fff;
    }
    .product-card img {
      max-width: 100%;
      height: auto;
      border-radius: 6px;
      margin-bottom: 10px;
    }
    .product-card h4 {
      font-size: 18px;
      margin-bottom: 10px;
    }
    .product-card p {
      margin-bottom: 5px;
    }
    .quantity-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 10px;
    }
    .quantity-container input {
      width: 50px;
      text-align: center;
    }
    .quantity-container button {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      border: none;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
    }
    .quantity-container button.plus {
      background-color: #28a745;
    }
    .quantity-container button.minus {
      background-color: #dc3545;
    }
  </style>
</head>
<body>


<div class="container mt-4">
  <h1 class="mb-4">Liste des Produits</h1>
  <div class="row" id="productList">
    <?php
    // Votre code PHP pour récupérer les produits ici
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ventematerielsinformatiques";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("La connexion a échoué : " . $conn->connect_error);
    }

    if (isset($_GET['categorie'])) {
      $category = $_GET['categorie'];
      $category = $conn->real_escape_string($category);

      $sql = "SELECT * FROM produit INNER JOIN categorie ON produit.code_categorie = categorie.code_categorie WHERE categorie.nom_categorie= '$category'";
      $result = $conn->query($sql);

      if ($result === false) {
        echo "Erreur d'exécution de la requête : " . $conn->error;
      } else {
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Affichage des produits avec Bootstrap
            echo '<div class="col-lg-4 col-md-6 mb-4">';
            echo '<div class="product-card">';
            echo '<img src="' . $row["image"] . '" alt="' . $row["nom"] . '">';
            echo '<h4>' . $row["nom"] . '</h4>';
            echo '<p><strong>Prix: </strong>' . $row["prix"] . '</p>';
            echo '<a href="details.php?id=' . $row['id'] . '" class="btn btn-primary mb-2">More</a>';
            echo '<div class="quantity-container">';
            
            echo '<div>';
          
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
        } else {
          echo "Aucun produit trouvé pour cette catégorie.";
        }
      }
    } else {
      echo "Catégorie non spécifiée.";
    }

    $conn->close();
    ?>
  </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
