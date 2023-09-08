<?php
require_once('./controller/ArticleController.php');
require_once('./controller/CategorieController.php');
require_once('./controller/UserController.php');
require_once('./model/Article.php');
require_once('./model/Categorie.php');
require_once('./model/dao/DataAccessObject.php');
use Blog\Controller\Article\ArticleController;
use Blog\Controller\Categorie\CategorieController;
use Blog\Controller\User\UserController;
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
      ArticleController::addArticle($_GET, $_FILES);
    }
    if($_GET['action'] === 'listArticle'){
        ArticleController::listArticle();
      }
      if($_GET['action'] === 'deleteArticle'){
        if(isset($_GET['idArticle'])){
          ArticleController::deleteArticle((int) $_GET['idArticle']);
        }
        else{
          ArticleController::deleteArticles();
        }
      }
      if($_GET['action'] === 'desactivatedArticle'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        ArticleController::desactivatedArticle($_GET);
      }
      if($_GET['action'] === 'activatedArticle'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       ArticleController::activatedArticle($_GET);
      }
      if($_GET['action'] === 'viewArticle'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        ArticleController::viewArticle($_GET["idArticle"]);
      }
      if($_GET['action'] === 'updateArticle'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        ArticleController::updateArticle($_GET, $_FILES);
      }
      if($_GET['action'] === 'filter'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(isset($_GET['idCategorie'])){
          ArticleController::filter($_GET['idCategorie']);
        }
        else{
          ArticleController::filter(null,8);
        }
      }
      /** Description d'un article */
      if($_GET['action'] === 'description'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        ArticleController::descriptionArticle($_GET["idArticle"]);
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
    if($_GET['action'] === 'deleteCategorie'){
      $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      if(isset($_GET['idCategorie'])){
        CategorieController::deleteCategorie($_GET['idCategorie']);
      }
      else{
        CategorieController::deleteCategories();
      }
    }
    if($_GET['action'] === 'viewCategorie'){
      $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      CategorieController::viewCategorie($_GET["idCategorie"]);
    }
    if($_GET['action'] === 'updateCategorie'){
      $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      CategorieController::updateCategorie($_GET);
    }
    if($_GET['action'] === 'desactivatedCategorie'){
      $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      CategorieController::desactivatedCategorie($_GET);
    }
    if($_GET['action'] === 'activatedCategorie'){
      $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      CategorieController::activatedCategorie($_GET);
    }
  }
  if($_GET['controller'] === 'user'){
   if($_GET['action'] === 'connect'){
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    UserController::connect($_GET);
   }  
   if($_GET['action'] === 'login'){
    UserController::index();
   }
  }
}
else{
  ArticleController::index();
}

?>