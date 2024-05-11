<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "ventematerielsinformatiques";
$message = "";

try {
    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
            $_SESSION["message"] = '<label class="text-danger">All fields are required</label>';
        } else {
            if (!isEmailExists($connect, $email)) {
                // Insert the new user into the database with the plain password
                insertUser($connect, $nom, $prenom, $email, $password);

                $_SESSION["nom"] = $nom;
                $_SESSION["prenom"] = $prenom;
                header("location: home.php");
                exit;
            } else {
                $_SESSION["message"] = '<label class="text-danger">Email is already registered</label>';
            }
        }
    }
} catch (PDOException $error) {
    $_SESSION["message"] = '<label class="text-danger">' . $error->getMessage() . '</label>';
}

// Vérifie si l'e-mail existe déjà dans la base de données
function isEmailExists($connect, $email)
{
    $check_query = "SELECT * FROM user WHERE email = :email";
    $check_statement = $connect->prepare($check_query);
    $check_statement->execute(array(':email' => $email));
    return $check_statement->rowCount() > 0;
}

// Insère un nouvel utilisateur dans la base de données
function insertUser($connect, $nom, $prenom, $email, $password)
{
    $insert_query = "INSERT INTO user (nom, prenom, email, pwd) VALUES (:nom, :prenom, :email, :pwd)";
    $insert_statement = $connect->prepare($insert_query);

    $insert_statement->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'pwd' => $password
    ));
}

// Redirige avec le message approprié
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="login.css">
    <style>
          body {
            background-color: #d9d9d9; /* Your preferred background color */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: none;
            background-color: #d8dbe2; 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #274c77; 
        }
    </style>
</head>
<body>
    <div class="background-container">
        <div class="background"></div>
    </div>

    <div class="container" style="width:500px; margin-top: 50px;" id="form-container">
        <h2>Register</h2>
        <?php echo isset($message) ? $message : ''; ?>
        <form method="post">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required />
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="togglePasswordVisibility()">Show</button>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

        $(document).ready(function () {
            $("#form-container").fadeIn(1000);
        });
    </script>
</body>
</html>
