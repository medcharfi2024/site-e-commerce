
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Confirmation de réception</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
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
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }
    .container {
      background-color: #fff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }
    h1 {
      color: #333;
      text-align: center;
      margin-bottom: 30px;
    }
    p {
      color: #666;
      font-size: 18px;
      text-align: justify;
    }
    .btn {
      display: block;
      width: 200px;
      margin: 30px auto 0;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-align: center;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }
    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Merci pour votre confiance !</h1>
    <p>
      Nous vous remercions infiniment pour votre confiance. Votre demande a bien été enregistrée.
      Vous recevrez sous peu une confirmation par e-mail.
    </p>
    <!-- Ajoutez ce script à votre page home.php -->

    <a href="home.php" class="btn">Retour à l'accueil</a>
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
