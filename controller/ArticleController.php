<?php declare(strict_types=1);
/**
 * Fonction Index : Page d'accueil du site web
 */
namespace Blog\Controller\Article;
class ArticleController {


  public static function index(){
    require_once('./view/homepage.php');
  }
}


?>