<?php session_start(); ?>
<?php
if (isset($_SESSION['prenom'])) {
    $prenom = $_SESSION['prenom'];
    $est_connecte = true ;
}
else {
  $est_connecte = false ;
}

?>

<?php
// Connexion à la base de données

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ventematerielsinformatiques", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Requête pour récupérer les données de la table "produittp"
$sql = "SELECT * FROM produit";
$result = $pdo->query($sql);

if ($result) {
    $produits = $result->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("Erreur lors de la récupération des données : " . $pdo->errorInfo());
}

// Récupérer le produit de la base
if (isset($_GET['id'])) {
    $productCode = $_GET['id'];

    // Connexion à la base de données
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ventematerielsinformatiques", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="inc/amal/css.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('#search').on('input', function () {
        var searchValue = $(this).val().trim();
        $.ajax({
            url: 'ajax_search.php', // Assurez-vous d'adapter l'URL à votre script de traitement de recherche
            method: 'POST',
            data: { searchValue: searchValue },
            success: function (response) {
                $('#table tbody').html(response);
            }
        });
    });
});
</script>

    <style>
     .custom-btn-group {
            display: flex;
            justify-content: center; /* Aligner les boutons horizontalement au centre */
            margin-bottom: 10px; /* Espacement en bas entre les boutons et le reste du contenu */
            padding-right: 200px;
        }

        .custom-btn {
            background-color: #669bbc; /* Couleur de fond des boutons */
            color: white;
            border: none;
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            margin: 0 5px; /* Espacement horizontal entre les boutons */
            cursor: pointer;
            border-radius: 10px;
            width: 180px
        }

        .custom-btn:hover {
            background-color: #45a049; /* Couleur de fond au survol */
        }
        .logo-img {
            max-width: 100px; /* Ajustez la largeur maximale de votre logo */
            height: auto;
            margin-right: 20px; /* Espacement entre le logo et les boutons */
        }

        .custom-btn-group {
            display: flex;
            align-items: center; /* Alignement vertical des éléments dans le groupe de boutons */
        }
        /* Ajoutez ces styles dans votre fichier CSS externe ou dans une balise <style> dans votre fichier HTML */
.custom-input {
    /* Ajoutez vos styles personnalisés ici */
    /* Par exemple : */
    border-color: #ff0000; /* Couleur de la bordure */
    border-radius: 10px; /* Rayon des coins de la bordure */
    /* ... */
}
.btn-outline-danger{
    font-size: 15px;
    margin: 0 5px;
    

}
.navbar-text {
    font-size: 15px;
     margin-left: 10px;
}

    </style>

    <script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $('input[type="text"]').on('input', function () {
            var searchValue = this.value.trim();
            $.ajax({
                url: 'ajax_search.php',
                method: 'POST',
                data: { searchValue: searchValue },
                success: function (response) {
                    $('#table tbody').html(response);
                }
            });
        });
    });
</script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php">MachinaStore</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="container mt-2">
    <input type="text" id="search" class="form-control form-control-sm col-6 col-md-4" placeholder="Rechercher...">
</div>





      <div class="container">
        <!-- Ligne pour le logo et les boutons -->
        <div class="row align-items-center">
            
            <div class="col">
                <!-- Div pour aligner les boutons horizontalement -->
                <div class="custom-btn-group">
                    <a href="add.php" class="btn btn-success custom-btn">Ajouter Produit</a>
                    <a href="liste_utilisateur.php" class="btn btn-success custom-btn">Voir la liste des utilisateurs</a>
                    <a href="gerer_commande.php" class="btn btn-success custom-btn">Voir les commandes</a>
                    <a href="liste_categorie.php" class="btn btn-success custom-btn">gérer catégorie</a>
                </div>
            </div>
        </div>
             <!-- Bouton Se connecter -->
      <div class="ml-auto">
      <?php if ($est_connecte) { ?>
        <span class="navbar-text ">
          Bienvenue, <?php echo $prenom; ?> !
        </span>
        <a href="logout.php" class="btn btn-outline-danger">Déconnexion</a>
      <?php } else { ?>
        <a href="login.php" class="btn btn-outline-primary">Se connecter</a>
      <?php } ?>
    </div>
  </div>
      </nav>
 


</head>
<body>

            <table class="table table-striped table-hover table-bordered" id="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>BrandName</th>
                    <th>Désignation</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité de stock</th>
                    <th>code categorie</th>
                    <th>Image</th>
                 
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($produits as $produit):
                    ?>
                    <tr>
                        
                        <td><?= $produit['id'] ?></td>
                        <td><?= $produit['BrandName'] ?></td>
                        <td><?= $produit['designation'] ?></td>
                        <td><?= $produit['prix'] ?></td>
                        <td><?= $produit['qte'] ?></td>
                        <td><?= $produit['code_categorie'] ?></td>
                        <td>
                            <?php
                            
                            
                            echo "<img src='" . $produit['image'] . "' alt='Image du produit' width='90'>";
                            ?>

                        </td>
                        
                        <td>
                            
                            <a href="edit.php?id=<?= $produit['id'] ?>" class="edit" title="Edit"><i
                                        class="material-icons">&#xE254;</i></a>
                            <a href="supp.php?id=<?= $produit['id'] ?>" class="delete" title="Delete"><i
                                        class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
