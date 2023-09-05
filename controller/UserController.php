<?php declare(strict_types=1);
namespace Blog\Controller\User;

use Blog\Model\Article\Article;
use Blog\Model\Categorie\Categorie;
use Blog\Controller\Article\ArticleController;


class UserController{
  public static function index(){
    $allCategories = Categorie::listCategorie();
    $listArticles = Article::listArticle();
    require_once('./view/dashboard.php');
  }
}
?>