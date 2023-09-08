<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Blog">
  <meta name="author" content="Ricardo Samedi">
  <!-- Shortcut Icon -->
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <!-- Inclusion du fichier css -->
  <link rel="stylesheet" href="./public/css/styles.css">
  <!-- Lien vers le CDN Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Inclusion de Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster+Two:wght@400;700&family=Nunito:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Inclusion du fichier JS apres le chargement complet de la page -->
  <script defer src="./public/js/script.js"></script>
  <!-- Generer dynamiquement le titre de la page -->
  <title>BlogHotel | Bienvenue</title>
</head>
<body>
  <div id="wrapper">
     <!-- Entete de la page -->
  <header id="header">
   <div class="header">
    <!-- Nav -->
    <nav id="nav">
      <!-- Menu -->
      <div class="menu">
        <div class="menuburger">
          <div class="menuburger-ligne menuburger-ligne-1"></div>
          <div class="menuburger-ligne menuburger-ligne-2"></div>
          <div class="menuburger-ligne menuburger-ligne-3"></div>
        </div>
        <!-- Fin Menuburger -->
      </div>
      <ul class="menulink">
          <li class="active">
            <a href="#">
              <span class="fa-solid fa-home"></span>
              <span>Accueil</span></a>
            </li>
          <li>
            <a href="#blog">
              <span class="fa-brands fa-blogger-b"></span>
              <span>Blog</span></a>
            </li>
          <!-- Temoignages -->
          <li>
            <a href="#temoignages">
              <span class="fa-solid fa-comments"></span>
              <span>T&eacute;moignages</span></a>
            </li>
          <!-- Contact -->  
          <li>
            <a href="#">
              <span class="fa-solid fa-envelope"></span>
              <span>Contact</span></a>
          </li>
          <li>
            <a href="#">
              <span class="fa-solid fa-hotel"></span>
              <span>Services</span></a>
            </li>
        </ul>
    </nav>
    <!-- Fin Nav -->
    <div class="logo">
      <p>
        <span class="fa-solid fa-blog"></span>
        <a href="./index.php">
          <span>Blog</span><span>Hotel</span>
        </a>
      </p>
    </div>
    <!-- Fin logo -->
    <!-- Lien de connexion -->
    <div class="account">
      <a href="../index.php?controller=user&action=login" class="fa-solid fa-circle-user"></a>
      <?php if(isset($_SESSION["nomutilisateur"])) : ?><span><?= ucfirst($_SESSION["nomutilisateur"]) ?></span><?php endif; ?>
    </div>
   </div>
  </header>  
  <!-- Fin Header -->

 
