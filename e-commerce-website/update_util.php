<?php
// Connexion à la base de données (à adapter si nécessaire)
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ventematerielsinformatiques", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérification si un utilisateur a été sélectionné
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Récupération des informations de l'utilisateur à mettre à jour
    $sql = "SELECT * FROM user WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Utilisateur non trouvé !");
    }

    // Vérification si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['role'])) {
        // Récupération du nouveau rôle
        $new_role = $_POST['role'];

        // Mise à jour du rôle de l'utilisateur dans la base de données
        $update_sql = "UPDATE user SET role = :new_role WHERE id = :user_id";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->bindParam(':new_role', $new_role, PDO::PARAM_STR);
        $update_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $update_stmt->execute();

        // Redirection vers la page précédente ou une autre page après la mise à jour
        header("Location: liste_utilisateur.php"); // Remplacez par le nom de votre page
        exit();
    }
} else {
    die("Aucun utilisateur sélectionné !");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le rôle d'utilisateur</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Ajoutez d'autres liens CSS si nécessaire -->
</head>
<body>
    <div class="container">
        <h2>Modifier le rôle de <?= $user['nom'] ?> <?= $user['prenom'] ?></h2>
        <form method="post">
            <div class="form-group">
                <label for="role">Nouveau rôle :</label>
                <select class="form-control" id="role" name="role">
                    <option value="client" <?= ($user['role'] === 'client') ? 'selected' : '' ?>>Client</option>
                    <option value="admin" <?= ($user['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Ajoutez d'autres liens JavaScript si nécessaire -->
</body>
</html>
