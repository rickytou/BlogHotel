<?php declare(strict_types=1);
if(!isset($_SESSION["nomutilisateur"])){
  header('Location:./index.php');
} 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Tableau de bord du blog hotel">
  <!-- Shortcut Icon -->
  <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
  <!-- Inclusion du fichier css -->
  <link rel="stylesheet" href="./public/css/stylesdashboard.css">
  <!-- Lien vers le CDN Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Inclusion de Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster+Two:wght@400;700&family=Nunito:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Inclusion du fichier JS apres le chargement complet de la page -->
  <script defer src="./public/js/scriptdashboard.js"></script>
  <title>BlogHotel | Dashboard</title>
</head>
<body>
<div id="wrapper">
   <!-- Entete de la page -->
   <header id="header">
      <div class="header">
        <!-- Logo -->
        <div class="logo">
          <p>
            <a href="./index.php" class="fa-solid fa-blog"></a>
           </p>
        </div>
        <!-- Fin Logo -->
        <!-- Lien de connexion -->
        <div class="account">
          <a href="#" class="fa-solid fa-circle-user"></a>
          <div class="sous-menu">
            <span class="fa-solid fa-power-off"></span>
            <a href="./index.php?controller=user&action=disconnect">d&eacute;connexion</a>
            </div>        
        </div>
        <!-- Fin -->
      </div>
   </header>

