<?php
// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ventematerielsinformatiques", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if (isset($_POST['searchValue'])) {
    $searchValue = $_POST['searchValue'];

    // Requête pour récupérer les produits correspondants au terme de recherche
    $sql = "SELECT * FROM produit WHERE BrandName LIKE :search OR designation LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', '%' . $searchValue . '%', PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Générer la structure HTML pour les résultats de la recherche
        $output = '';
        if ($result) {
            foreach ($result as $produit) {
                $output .= '<tr>';
                $output .= '<td>' . $produit['id'] . '</td>';
                $output .= '<td>' . $produit['BrandName'] . '</td>';
                $output .= '<td>' . $produit['designation'] . '</td>';
                $output .= '<td>' . $produit['prix'] . '</td>';
                $output .= '<td>' . $produit['qte'] . '</td>';
                $output .= '<td>' . $produit['code_categorie'] . '</td>';
                $output .= '<td><img src="' . $produit['image'] . '" alt="Image du produit" width="90"></td>';
                $output .= '<td>';
                $output .= '<a href="#" class="view" title="View"><i class="material-icons">&#xE417;</i></a>';
                $output .= '<a href="edit.php?id=' . $produit['id'] . '" class="edit" title="Edit"><i class="material-icons">&#xE254;</i></a>';
                $output .= '<a href="supp.php?id=' . $produit['id'] . '" class="delete" title="Delete"><i class="material-icons">&#xE872;</i></a>';
                $output .= '</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr><td colspan="8">Aucun résultat trouvé</td></tr>';
        }
        echo $output; // Renvoyer le HTML des résultats de la recherche
    } else {
        echo "Erreur lors de la récupération des données : " . $pdo->errorInfo();
    }
}
?>
