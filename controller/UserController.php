<?php declare(strict_types=1);
namespace Blog\Controller\User;
use Blog\Model\User\User;
use Blog\Model\Article\Article;
use Blog\Model\Comment\Comment;
use Blog\Model\Categorie\Categorie;
use Blog\Model\Temoignages\Temoignages;
use Blog\Controller\Article\ArticleController;

class UserController{
  public static function index(){
    require_once('./view/user/connexion.php');
  }

  /** Fonction permettant de faire la redirection vers la page d'administration */
  public static function connectEstablished(){
    $allCategories = Categorie::listCategorie();
    $allCategoriesActived = Categorie::listCategorie(1);
    $listArticles = Article::listArticle();
    $listCommentaire = Comment::listCommentaire();
    $listTemoignage = Temoignages::listTemoignage();
    require_once('./view/dashboard.php');
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
      $message = '<p class="message--erreur">Il faut remplir tous les champs';
    }
    else{
      $user = new User(trim($donneesPostees["nomutilisateur"]), trim($donneesPostees["motdepasse"]));
      $userconnect = User::connect($user);
      if(!$userconnect){
        header('Location:index.php?controller=user&action=login&wrong');
      }
      else{
        $_SESSION["nomutilisateur"] = $user->getNomUtilisateur();
        header('Location:./index.php?controller=user&action=connectEstablished');
      }
    }
    echo $message;
  }

  /** Fonction permettant de fermer la connexion */
  public static function disconnect(){
    session_destroy();
    header('Location: ./index.php');
  }
}
?>