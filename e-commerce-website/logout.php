<?php
session_start(); // Démarrage de la session

// Suppression de toutes les données de session
session_unset();

// Destruction de la session
session_destroy();

// Redirection vers la page de connexion après la déconnexion
header("Location: login.php");
exit();
?>
