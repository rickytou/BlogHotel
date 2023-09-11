<?php declare(strict_types=1);
session_start();
require_once('./controller/CommentController.php');
require_once('./controller/ArticleController.php');
require_once('./controller/CategorieController.php');
require_once('./controller/TemoignageController.php');
require_once('./controller/UserController.php');
require_once('./model/Article.php');
require_once('./model/Temoignage.php');
require_once('./model/Comment.php');
require_once('./model/Categorie.php');
require_once('./model/User.php');
require_once('./model/dao/DataAccessObject.php');
use Blog\Model\User\User;
use Blog\Model\Categorie\Categorie;
// use Blog\Model\Comment\Comment;
use Blog\Controller\User\UserController;
use Blog\Controller\Article\ArticleController;
use Blog\Controller\Comments\CommentController;
use Blog\Controller\Categorie\CategorieController;
use Blog\Controller\Temoignage\TemoignageController;

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
        ArticleController::viewArticle((int) $_GET["idArticle"]);
      }
      if($_GET['action'] === 'updateArticle'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        ArticleController::updateArticle($_GET, $_FILES);
      }
      if($_GET['action'] === 'filter'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(isset($_GET['idCategorie'])){
          ArticleController::filter((int) $_GET['idCategorie']);
        }
        else{
          ArticleController::filter(null,4);
        }
      }
      /** Description d'un article */
      if($_GET['action'] === 'description'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          ArticleController::descriptionArticle((int) $_GET["idArticle"]);
      }
      if($_GET['action'] === 'moreArticles'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        ArticleController::moreArticles((int) $_GET["nbArticleParPage"], (int) $_GET["perPage"]);
       }
       /** Rechercher un article a partir d'un critere */
       if($_GET['action'] === 'search'){
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        /** Envoie des donnees au controlleur */
        ArticleController::searchArticle($_GET["query"]);
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
        CategorieController::deleteCategorie((int) $_GET['idCategorie']);
      }
      else{
        CategorieController::deleteCategories();
      }
    }
    if($_GET['action'] === 'viewCategorie'){
      $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      CategorieController::viewCategorie((int) $_GET["idCategorie"]);
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
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    UserController::connect($_POST);
   }  
   if($_GET['action'] === 'login'){
    UserController::index();
   }
   if($_GET['action'] === 'connectEstablished'){
    UserController::connectEstablished();
   }
   if($_GET['action'] === 'disconnect'){
    UserController::disconnect();
   }
  }
  if($_GET['controller'] === 'comment'){
   if($_GET['action'] === 'addComment'){
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    CommentController::addComment($_GET);
   }
   if($_GET['action'] === 'listCommentaire'){
    CommentController::listCommentaire();
  }
  if($_GET['action'] === 'activatedComment'){
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    CommentController::activatedComment($_GET);
  }
  if($_GET['action'] === 'desactivatedComment'){
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    CommentController::desactivatedComment($_GET);
  }
  if($_GET['action'] === 'deleteComment'){
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(isset($_GET['idCommentaire'])){
      CommentController::deleteComment((int) $_GET['idCommentaire']);
    }
    else{
      CommentController::deleteComments();
    }
  }
  }
  if($_GET['controller'] === 'temoignage'){
    if($_GET['action'] === 'addTemoignage'){
      /** Nettoyage des donnees recues par le fomulaire d'ajout de temoignage */
      $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      /** Envoie des donnees au controlleur */
       TemoignageController::addTemoignage($_GET, $_FILES);
    }
    if($_GET['action'] === 'listTemoignage'){
      TemoignageController::listTemoignage();
    }
  }
}
else{
  ArticleController::index();
}

?>