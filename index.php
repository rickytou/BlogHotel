<?php
require_once('./controller\articleController.php');
use Blog\Controller\Article\ArticleController;

/**
 * Index : Route
 * La route permet de rediriger toutes les requetes vers leur controlleur
 * L'application suit le modele MVC [Modele - Vue - Controlleur]
 * Utilisation du PHP Oriente Objet(POO)
 * Bases de donnees (MySQL)
 **/

if(isset($_GET['controller']) && !empty($_GET['controller'])){
  echo 'Controller existant';
}
else{
  ArticleController::index();
}

?>