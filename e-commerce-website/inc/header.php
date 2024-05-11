<?php
if (isset($_SESSION['prenom'])) {
    $prenom = $_SESSION['prenom'];
    $est_connecte = true;
} else {
    $est_connecte = false;
}
$host = "localhost";
$dbname = "ventematerielsinformatiques";
$user = "root";
$pass = "";
function getCartTotalPrice()
{
    global $host, $dbname, $user, $pass;
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $totalPrice = 0;
        // Check if cart is not empty
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $query = "SELECT nom, prix FROM produit WHERE id = :product_id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':product_id', $product_id);
                $stmt->execute();
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($product && isset($product['prix'])) {
                    $productTotal = $product['prix'] * $quantity;
                    $totalPrice += $productTotal;
                } else {
                    error_log("Product not found or price not set for ID: $product_id");
                }
            }
        }

        return $totalPrice;
    } catch (PDOException $e) {
        error_log("Erreur de connexion à la base de données: " . $e->getMessage());
        return 0; 
    }
}

function getProductCategories()
{
    global $host, $dbname, $user, $pass;
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT nom_categorie FROM categorie";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return $categories;
    } catch (PDOException $e) {
        error_log("Erreur de connexion à la base de données: " . $e->getMessage());
        return array(); 
    }
}

$categories = getProductCategories();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php">MachinaStore</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>


        
      <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle"  href="1" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    About us 
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
 
    <a class="nav-link" id="adresseLink" href="adresse.php">Adress</a>
    <div class="dropdown-divider"></div>
    <a class="nav-link" id="description" href="description.php">Description</a>
  </div>
</li>


<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Products
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php foreach ($categories as $categoryName) { ?>
            <a class="dropdown-item" href="#" data-categorie="<?php echo htmlspecialchars($categoryName); ?>"><?php echo htmlspecialchars($categoryName); ?></a>
            <div class="dropdown-divider"></div>
        <?php } ?>
    </div>
</li>


      

    </ul>


<!-- partie affichage avec la categorie -->
<script>
document.querySelectorAll('.dropdown-item').forEach(item => {
  item.addEventListener('click', function(event) {
    event.preventDefault();
    const selectedCategory = this.getAttribute('data-categorie');
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('productsList').innerHTML = xhr.responseText;
        document.getElementById('sliderContent').style.display = 'none'; // Masquer le contenu du slider
        document.getElementById('texte').style.display = 'none';
    
        document.getElementById('row').style.display = 'none';
      }
    };
    xhr.open('GET', 'getProduct.php?categorie=' + selectedCategory, true);
    xhr.send();
  });
});


</script>

<form class="form-inline my-2 my-lg-0">
  <div class="input-group">
    <input class="form-control" type="search" id="searchInput" placeholder="Rechercher des produits..." aria-label="Search">
    <div class="input-group-append">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </div>
  </div>
</form>
<div id="results" class="mt-3"></div>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const resultsContainer = document.getElementById('results');

    searchInput.addEventListener('input', function() {
      let query = this.value;

      let xhr = new XMLHttpRequest();
      xhr.open('GET', 'search.php?query=' + query, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            resultsContainer.innerHTML = xhr.responseText;
            adjustSearchBar();
          } else {
            console.error('Une erreur s\'est produite.');
          }
        }
      };
      xhr.send();
    });

    function adjustSearchBar() {
      if (resultsContainer.innerHTML.trim() !== '') {
        resultsContainer.classList.add('pt-3'); // Ajout d'un padding en haut pour espacer les résultats
      } else {
        resultsContainer.classList.remove('pt-3');
      }
    }
  });
</script>

<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" href="panier.php">
            <img src="inc/images/panier.webp" alt="Panier" width="24" height="24">
            <span id="cartCounter"><?php $cartTotal = getCartTotalPrice(); echo is_numeric($cartTotal) ? $cartTotal : 0; ?> TND</span>
        </a>
    </li>
</ul>
    

      <!-- Bouton Se connecter -->
      <div class="ml-auto">
      <?php if ($est_connecte) { ?>
        <span class="navbar-text mr-3">
          Bienvenue, <?php echo $prenom; ?> !
        </span>
        <a href="logout.php" class="btn btn-outline-danger">Déconnexion</a>
      <?php } else { ?>
        <a href="login.php" class="btn btn-outline-primary">Se connecter</a>
      <?php } ?>
    </div>
  </div>


</nav>
