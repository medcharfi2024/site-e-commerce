<!DOCTYPE html>
<html>
<head>
    <title>Affichage de la carte avec Bootstrap</title>
    <!-- Ajoutez les liens CDN de Bootstrap CSS pour le style -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title> MachinaStore </title>
        <!-- link pour le css -->
        <link rel="stylesheet" href="inc/css/bootstrap.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="inc/js/bootstrap.min.js"></script>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width= device-width , initial-scale=1.0">

        <link
            href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css"
            rel="stylesheet" />
            <link rel="stylesheet" href="inc/amal/css.css">



<style>
         /* Ajoutez du style CSS personnalisé si nécessaire */
        /* Par exemple, définir une hauteur fixe pour la carte */
        .map-container {
            height: 450px; /* Ajustez la hauteur selon vos besoins */
        }

 
 .navbar-brand {
  font-family: 'Roboto', sans-serif; /* Changer la police de caractères */
  font-size: 30px; /* Changer la taille du texte */
  color: #16324F;
  margin-left: 20px;
 
}
  .container {
    text-align: center;
    margin-top: 20px; 
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
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="home.php">MachinaStore</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0">
            <div class="input-group">
                <input class="form-control" type="search" id="searchInput" placeholder="Search for products..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div id="results" class="mt-3"></div>
    </div>
</nav>

<div class="map-container">
    <div class="row">
        <div class="col-md-12">
            <!-- Title -->
            <h1 class="text-center">Location of MachinaStore</h1>
            
            <!-- Use Bootstrap grid for displaying the map -->
            <div class="map-container">
                <?php
                echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.170903363617!2d10.715168875255278!3d34.72608628185111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13002ca4425ed6a1%3A0x1cb1842d2707fe25!2s%C3%89cole%20Nationale%20d&#39;Ing%C3%A9nieurs%20de%20Sfax%20-%20ENIS!5e0!3m2!1sfr!2stn!4v1701902374342!5m2!1sfr!2stn" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
                ?>
            </div>
        </div>
    </div>
</div>

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
        <!-- Add your existing footer content here -->
    </div>
    <div class="footer3">
        Copyright ©
        <h4>MachinaStore</h4>
        2023-2028
    </div>
</footer>

<!-- Add jQuery and Bootstrap JS CDN links -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your additional scripts here -->

</body>
</html>