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
    
    if(isset($_POST["login"])) {  
        if(empty($_POST["email"]) || empty($_POST["password"])) {  
            $message = '<label>All fields are required</label>';  
        } else {  
            $query = "SELECT * FROM user WHERE email = :email AND pwd = :pwd";  
            $statement = $connect->prepare($query);  
            $statement->execute(  
                array(  
                    'email' => $_POST["email"],  
                    'pwd' => $_POST["password"]   
                )  
            );  
           // ... (votre code existant reste inchangé jusqu'à la vérification du nombre de lignes affectées)

$count = $statement->rowCount();

if ($count > 0) {
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $_SESSION["email"] = $user["email"];
    $_SESSION["nom"] = $user["nom"];
    $_SESSION['prenom'] = $user["prenom"];
    
    // Check the role of the user fetched from the database
    if ($user["role"] === "admin") {
        header("location: crudProduit.php"); // Rediriger vers la page admin
    } else {
        // Normal user, redirect to home.php
        header("location: home.php");
    }

    // Check if "Remember Me" is checked
    if (isset($_POST['remember'])) {
        // Set cookies for email and password
        setcookie("email", $_POST["email"], time() + (2 * 60 * 60));
        setcookie("password", $_POST["password"], time() + (2 * 60 * 60));
    }

    // Remove the redundant redirection to home.php here
} else {
    $message = '<label>Invalid email or password</label>';
}

        }  
    }  
} catch(PDOException $error) {  
    $message = $error->getMessage();  
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="login.css">
    <style>
        /* Add your custom styles for animation */
        body {
            background-color: #d9d9d9; /* Your preferred background color */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .login-container {
            display: none;
            background-color: #f9f7f3; 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #274c77; 
        }
 
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-container" id="login-container">
                <h3 class="login-title">Login</h3>
                    <?php
                        if(isset($message)) {
                            echo '<div class="alert alert-danger">'.$message.'</div>';
                        }
                    ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="email">Email</label>  
                            <input type="text" name="email" class="form-control" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>" />  
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>  
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="passwordField" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>" />
                                <div class="input-group-addon">
                                    <button type="button" id="togglePassword" class="btn btn-default">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember" <?php if(isset($_COOKIE['email'])) echo 'checked'; ?>> Remember Me
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" class="btn btn-info" value="Login" />
                            <a href="register.php" class="btn btn-primary">Register</a>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script> 
        $(document).ready(function() {
            $('#login-container').fadeIn(1000); 
            $('#togglePassword').click(function() {
                var passwordField = $('#passwordField');
                var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).find('span').toggleClass('glyphicon-eye-open glyphicon-eye-close');
            });
        });
    </script>

</body>
</html>
