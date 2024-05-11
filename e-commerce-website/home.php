<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> MachinaStore </title>
        <!-- link pour le css -->
        <link rel="stylesheet" href="inc/css/bootstrap.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="inc/js/bootstrap.min.js"></script>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width= device-width , initial-scale=1.0">
        <link rel="stylesheet" href="inc/amal/css.css">
        <link
            href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css"
            rel="stylesheet" />
          <?php require "inc/header.php" ?>
          

      <style>
 /* Styles pour la section de description */
 body {
        background-color: #edede9; /* Couleur de fond souhaitée */
        margin: 0; /* Pour enlever les marges par défaut du body */
        padding: 0; /* Pour enlever les espaces par défaut du body */
    }
 .centered-section {
            display: flex;
            justify-content: center;
            align-items: center;
           
            padding-left: 270px; /* Ajout d'un espacement à gauche de la section */
        }

        /* Styles pour la description */
        .description-title {
    font-size: 28px;
    color: #16324F;
    margin-bottom: 20px;
    text-align: center;
    padding-right: 300px;
    font-family: 'Georgia', serif; /* Changer la police par exemple */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); /* Ajouter une ombre au texte */
}


        .description-text {
            font-size: 16px;
            line-height: 1.6;
            color: #16324F;
            text-align: justify;
            max-width: 80%;
            padding: 20px;
            border: 2px solid #0F1A29;
            background-color: #dad7cd;
            border-radius: 10px;
            font-family: 'Georgia', serif;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Effet de survol pour le texte */
        .description-text:hover {
            color: white;
            transition: color 0.3s ease;
        }
        .navbar-brand {
  font-family: 'Roboto', sans-serif; /* Changer la police de caractères */
  font-size: 30px; /* Changer la taille du texte */
  color: #16324F;
  margin-left: 20px;
 
}
.conteneur {
  background-color: #CCCCCC; /* Utilisez le code hexadécimal ou le nom de couleur pour le gris */
  padding: 20px;
}
.container {
    text-align: center;
    margin-top: 20px;
    border: 2px solid #000; /* Ajoute un cadre de 2px en solide noir */
    padding: 20px; /* Ajoute de l'espace à l'intérieur du cadre */
    border-radius: 40px; /* Arrondit les coins du cadre */
    font-family: 'Georgia', serif; /* Change la police d'écriture */
    font-size: 15px; /* Modifie la taille de la police */
    color: #333; /* Change la couleur du texte */
}
.cont{
  text-align: center;
    margin-top: 20px;
   
    font-family: 'Georgia', serif; /* Change la police d'écriture */
    font-size: 18px; /* Modifie la taille de la police */
    color: #333; /* Change la couleur du texte */


}


  #texte {
    font-size: 36px;
    color: #333;
    border-right: 2px solid #333;
    white-space: nowrap;
    overflow: hidden;
    animation: typing 4s steps(40) infinite, blink-caret 1s step-end infinite;
    }

  @keyframes typing {
    from { width: 0 }
    to { width: 100% }
    }

  @keyframes blink-caret {
    from, to { border-color: transparent }
    50% { border-color: #333 }
    }
 


  .company-bar {
    background-color: white;
    padding: 10px 0;
    height: 100px; /* Hauteur de la barre */
    display: flex;
    justify-content: center;
    align-items: center;
}

  .company-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    height: 100%; /* Utilisation de la hauteur à 100% pour s'adapter à la hauteur de la barre */
}

  .company-list li {
    margin: 0 10px;
    height: 100%; /* Ajustement de la hauteur à 100% */
}

  .company-list img {
    height: 100%; /* Ajustement de la hauteur à 100% */
    width: auto;
}

  footer {
     display:flex;
    flex-direction: column;
     background-color: #121F4E;
   align-items: center;
     color:white;
    
}
  .footer1 {
     display:flex;
     flex-direction: column;
     align-items: center;
     color:white;
     margin-top:15px;
    
}
.social-media {
     display:flex;
 justify-content: center;
    color:white;
     flex-wrap: wrap;
   
}
 .social-media a {
    color:white;
     margin:20px;
     border-radius: 5px;
     margin-top:10px;
     color:white;
    
}
 .social-media a ion-icon {
     color:white;
     background-color: black;
    
}
 .social-media a:hover ion-icon {
     color:red;
     transform: translateY(5px);
    
}
 .footer2 {
     display: flex;
     width:100%;
     justify-content:space-evenly;
     align-items: center;
     text-decoration: none;
     flex-wrap: wrap;
    
}
 .footer0 {
     font-weight:1200;
     transition-duration: 1s;
    
}
 .footer0:hover {
    color:rgb(243, 168, 7);
    
}
 .footer2 .heading {
     font-weight: 900;
    font-size: 18px;
   
}
  .footer3 {
     margin-top:60px;
     margin-bottom: 20px;
    display:flex;
    flex-wrap: wrap;
   justify-content: center;
 
}
 .footer2 .heading:hover {
  color:rgb(243, 168, 7);
  
}
 .footer2 .div:hover {
    transform: scale(1.05);
   
}
 .footer3 h4 {
     margin:0 10px;
  
}
 .footer2 div {
     margin:10px;
   
}
  </style>
</head>


<!-- Section où les produits seront affichés -->
<div id="productsList">
</div>


<div class="cont">
    <h1 id="texte">Celebrate innovation with premium computer hardware and accessories!</h1>
</div>
</br>
<div id="sliderContent">
  <?php
include("inc/slider.html");
?>
</div>
<?php
$host="localhost";
$base="ventematerielsinformatiques";
$user="root";
$pass="";
try{
$pdo= new PDO("mysql:host=$host;dbname=$base" ,$user,$pass);
// set the PDO error mode to exception
$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$query = "SELECT * FROM produit WHERE feature=1";
$statement = $pdo->prepare($query);
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

}
catch(PDOException $except){
echo"Echec de la connexion: ". $except->getMessage();
die();
}

?>
</br>
<section class="container-fluid">
        <div class="row" id="row">
            <div class="col-md-12 centered-section">
                <div>
                    <h2 class="description-title">Page Description</h2>
                    <p class="description-text">MachinaStore is an e-commerce platform specializing in the retail of computer equipment, PCs, phones, and related technological devices. The website boasts a sleek and user-friendly interface, inviting visitors with its seamless navigation and visually appealing design. From high-end PCs to the latest smartphone models, MachinaStore offers a diverse range of products, accompanied by detailed descriptions, specifications, and customer reviews to assist buyers in making informed decisions. The platform's secure payment system and efficient checkout process ensure a hassle-free shopping experience. Additionally, MachinaStore's commitment to customer service shines through its responsive support team, ready to assist users with any inquiries or technical assistance needed. With its comprehensive range of tech products and user-oriented approach, MachinaStore stands as a go-to destination for tech enthusiasts seeking quality and reliability in their online shopping experience.</p>
                </div>
            </div>
        </div>
    </section>

<script>// Effet de survol pour le texte
const descriptionText = document.querySelector('.description-text');

descriptionText.addEventListener('mouseover', function() {
    this.style.transform = 'scale(1.05)'; // Augmenter la taille du texte au survol
    this.style.transition = 'transform 0.3s ease'; // Animation de transition en cas de changement de taille
});

descriptionText.addEventListener('mouseout', function() {
    this.style.transform = 'scale(1)'; // Revenir à la taille normale lorsque le curseur quitte le texte
    this.style.transition = 'transform 0.3s ease'; // Animation de transition en cas de changement de taille
});
</script>
</br>
<?php
include("inc/amal/html.php");
?>
<!--part of best seller  -->

<div class="container" >
  <h2 class="text-center">BEST SELLERS</h2>
  <div class="row">
    <?php foreach ($products as $product) { ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="<?= $product['image']; ?>" class="card-img-top" alt="<?= $product['nom']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $product['nom']; ?></h5>
            <p class="card-text">TND <?= $product['prix']; ?></p>
            <!-- le bouton more -->
            <a href="details.php?id=<?= $product['id']; ?>" class="btn btn-success">More</a>

          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

</br>


<footer>
    <div class="footer0"><h1>MachinaStore</h1></div>
    <div class="footer1">
        Connect with us at
        <div class="social-media">
            <a href="fb"> <ion-icon name="logo-facebook"></ion-icon> </a>
            <a href="linkedin"> <ion-icon name="logo-linkedin"></ion-icon> </a>
            <a href="insta"> <ion-icon name="logo-instagram"></ion-icon> </a>
            <a href="twiter"> <ion-icon name="logo-twitter"></ion-icon> </a>
        </div>
    </div>
    <div class="footer2">
        <div class="product">
            <div class="heading">Products</div>
            <div class="div">Sell your Products</div>
            <div class="div">Advertise</div>
            <div class="div">Pricing</div>
            <div class="div">Product Buisness</div>
        </div>
        <div class="services">
            <div class="heading">Services</div>
            <div class="div">Return</div>
            <div class="div">Cash Back</div>
            <div class="div">Affiliate Marketing</div>
            <div class="div">Others</div>
        </div>
        <div class="Company">
            <div class="heading">Company</div>
            <div class="div">Complaint</div>
            <div class="div">Careers</div>
            <div class="div">Affiliate Marketing</div>
            <div class="div">Support</div>
        </div>
        <div class="Get Help">
            <div class="heading">Get Help</div>
            <div class="div">Help Center</div>
            <div class="div">Privacy Policy</div>
            <div class="div">Terms</div>
            <div class="div">Login</div>
        </div>
    </div>
    <div class="footer3">
        Copyright ©
        <h4>MachinaStore</h4>
        2023-2028
    </div>
</footer>
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
      


</body>




</html>