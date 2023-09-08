<?php declare(strict_types=1);
namespace Blog\Controller\User;

use Blog\Model\Article\Article;
use Blog\Model\Categorie\Categorie;
use Blog\Controller\Article\ArticleController;


class UserController{
  public static function index(){
    $allCategories = Categorie::listCategorie();
    $listArticles = Article::listArticle();
    require_once('./view/article/front/connexion.php');
  }
  /** Fonction permettant d'etablir la connexion */
  public static function connect(array $POST){
    $donneesPostees = array();
    $donneesPostees["nomutilisateur"] = $POST["nomutilisateur"];
    $donneesPostees["motdepasse"] = $POST["motdepasse"];
    $valide = false;
    $message = '';
    $post_empty = array();
    foreach($donneesPostees as $key => $login){
      if(empty($login)){
        $valide = true;
      }
    }
    if($valide){
      $message = '<p class="message--erreur">Nom utlisateur et mot de passe requis';
    }
    else{
      $user = new User($donneesPostees["nomutilisateur"], $donneesPostees["nomutilisateur"]);
      User::connect($user);
    }
    echo $message;
  }
}
?>