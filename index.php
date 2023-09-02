<?php
require_once('./controller/articleController.php');
require_once('./controller/CategorieController.php');
require_once('./model/Article.php');
require_once('./model/Categorie.php');
require_once('./model/dao/DataAccessObject.php');
use Blog\Controller\Article\ArticleController;
use Blog\Controller\Categorie\CategorieController;
use Blog\Model\Categorie\Categorie;

/**
 * Index : Route
 * La route permet de rediriger toutes les requetes vers leur controlleur
 * L'application suit le modele MVC [Modele - Vue - Controlleur]
 * Utilisation du PHP Oriente Objet(POO)
 * Bases de donnees (MySQL)
 **/

if(isset($_GET['controller']) && !empty($_GET['controller'])){
  if($_GET['controller'] === 'article'){
    if($_GET['action'] === 'addArticle'){
      /** Nettoyage des donnees recues par le fomulaire d'ajout d'article */
      $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      /** Envoie des donnees au controlleur */
      ArticleController::addArticle($_GET);
    }
  }
  if($_GET['controller'] === 'categorie'){
    if($_GET['action'] === 'addCategorie'){
      /** Nettoyage des donnees recues par le fomulaire d'ajout d'article */
      $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      /** Envoie des donnees au controlleur */
      CategorieController::addCategorie($_GET);
    }
    if($_GET['action'] === 'listCategorie'){
      CategorieController::listCategorie();
    }
  }
}
else{
  ArticleController::index();
}

?>