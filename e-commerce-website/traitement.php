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

    $query = "SELECT * FROM user";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $except) {
    echo "Echec de la connexion: " . $except->getMessage();
    die();
}

if (isset($_POST['remember_me'])) {
    // Set a cookie to remember the user for a longer time
    setcookie("remember_user", $username, time() + 3600 * 24 * 30, "/"); // 30 days
    setcookie("remember_pass", $password, time() + 3600 * 24 * 30, "/"); // 30 days
} else {
    setcookie("remember_user", $username, time() - 3600, "/");
    setcookie("remember_pass", $password, time() - 3600, "/");
}

if (
    (!isset($_GET['email']) || !filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
    || (!isset($_GET['pwd']) || empty($_GET['pwd']))
    || (!isset($_GET['nom']) || empty($_GET['nom']))
    || (!isset($_GET['prenom']) || empty($_GET['prenom']))
) {
    echo ("<script>alert(\"you have to fill everything\")</script>");
    header('Location: login.php');
    return;
} else {
    $email = $_GET['email'];
    $password = $_GET['pwd'];
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['pwd'] === $password && $user['nom'] === $nom && $user['prenom'] === $prenom) {
            $_SESSION['prenom'] = $prenom;
            // Vérification spécifique pour rediriger vers différentes pages
            if ($email === 'triguiamal12@gmail.com' && $password === 'amal0000') {
                header('Location: crudProduit.php');
                exit;
            } else {
                header('Location: home.php');
                exit;
            }
        }
    }
    // Si les identifiants ne correspondent pas à ceux de la base de données
    echo ("<script>alert(\"Invalid email or password\")</script>");
    header('Location: login.php');
    return;
}

$pdo->close();
?>
