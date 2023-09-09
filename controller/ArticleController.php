<?php declare(strict_types=1);
/**
 * ArticleController 
 *            - Controlleur servant d'interface entre les vues [view->index] 
 *              et le model Article
 * Les actions du controlleur : 
 *                            - index (Affichant la page d'accueil)
 *                            - addArticle (Pour ajouter un article)
 *                            
 */
namespace Blog\Controller\Article;

use Blog\Controller\Categorie\CategorieController;
use Blog\Model\Article\Article;
use Blog\Model\Categorie\Categorie;
use Blog\Model\Comment\Comment;

class ArticleController {

  /** Fonction faisant appel a la vue de la page d'accueil 
   * @return void
  */
  public static function index(){
    $listArticles = Article::listArticleActivated(8);
    $listCategories = Categorie::listCategorie();
    require_once('./view/homepage.php');
  }
  /** Fonction faisant appel au model AddArticle pour ajouter un nouvel article
   * @param array $GETArticle : Les donnees de l'article envoyees par le formulaire 
    */
    public static function addArticle($GET, $arrayPhoto){
      $invalid = false;
      $message = '';
      foreach($GET as $art){
        if(empty($art)){
          $invalid = true;
        }
      }
      if(isset($arrayPhoto)){
        if(!$arrayPhoto["uploadimage"]['name']){
          $invalid = true;
        }
      }
      if($invalid){
        $message = '<p class="message--erreur">obligatoire</p>';
      }
      else{
        $article = new Article(
                                trim($_GET["titre"]), 
                                trim($_GET["description"]), 
                                (int) $_GET["idCategories"],
                              );
        $message = Article::addArticle($article, $arrayPhoto);
      }
      echo $message;
}
/** Fin */

/** Fonctione permettant de supprimer un article */
public static function deleteArticle($idArticle){
  $message = Article::deleteArticle($idArticle);
  $listArticles = Article::listArticle();
  require_once('./view/article/listeArticle.php');
}

    /** Fonction permettant de supprimer tous les articles */
    public static function deleteArticles(){
      Article::deleteArticles();
      $message = '<p class="message--succes">Les articles ont &eacute;t&eacute; supprim&eacute;es avec succ&egrave;s</p>';
      echo $message;die;
}

/** Fonction permettant de lister les articles */
public static function listArticle(){
  $listArticles = Article::listArticle();
  if(count($listArticles) == 0){
    echo '<p class="message--erreur"> Aucun article disponible, veuillez en ajouter';
  }else{
    require_once('./view/article/listeArticle.php');
  }
} 
/** Fin */
/** Recuperer le nom des categories */
public static function nomCategorie($idCategorie): string{
  $cat = Categorie::viewCategorie($idCategorie);
  return $cat[0]["nomCategorie"];
}

public static function convertDate($date, $format) 
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
}
  /** Fonction permettant de desactiver une categorie */
  public static function desactivatedArticle(array $GET){
    $update = '';
    $update = Article::desactivatedArticle($GET);
    $listArticles = Article::listArticle();
    require_once('./view/article/listeArticle.php');
  }
  public static function activatedArticle(array $GET){
    $update = '';
    $update = Article::activatedArticle($GET);
    $listArticles = Article::listArticle();
    require_once('./view/article/listeArticle.php');
  } 

  /** Fonction permettant de modifier la liste des categories */
  public static function viewArticle(int $idArticle){
    $viewArticle = Article::viewArticle($idArticle);
    $allCategories = Categorie::listCategorie();
    require_once('./view/article/modifierArticle.php');
  }
  /** Fonction permettant de modifier un article */
  public static function updateArticle(array $GET, $FILES){
    $invalid = false;
    $message = '';
    foreach($GET as $article){
      if($article == ""){
        $invalid = true;
      }
    }
    // if(isset($FILES["uploadimage"])){
    //   if(!$FILES["uploadimage"]['name']){
    //     $invalid = true;
    //   }
    // }
    if($invalid){
      $message = '<p class="message--erreur">Il faut remplir tous les champs</p>';
    }
    else{
        $article = new Article(
        trim($GET["nomArticle"]), 
        trim($GET["descriptionArticle"]), 
        (int) trim($GET["idCategorie"])
      );
      $article->setIdArticle((int) trim($GET['idArticle']));
      $article->setActif((int) $GET['actif']);
          if(isset($FILES["uploadimage"])){
      
            $message = Article::updateArticle($article, $FILES);
    }
    else{
      $message = Article::updateArticle($article);
    }
    }  
      echo $message;
  }
  /** Fonction permettant de compter le nombre d'articles dans une categorie */
  public static function countArticle(int $idCategorie = null){
    $count = Article::countArticle($idCategorie);
    return $count;
  } 
  //Filter
  public static function filter(int $idCategorie = null, int $limit = null){
    $listArticles = Article::filter((int) $idCategorie, $limit);
    require_once('./view/article/front/listeArticle.php');
  }

  /** Fonction permettant d'afficher la description d'un article */
  public static function descriptionArticle(int $idArticle){
    $listArticle = Article::descriptionArticle($idArticle);
    $listCategories = Categorie::listCategorie();
    $listeCommentaires = Comment::listCommentaireByArticle($idArticle);
    require_once('./view/article/front/description-article.php');
  }

  /** Fonction permettant de couper la description d'un article si la longueur de la chaine description est superieure a 100
 * @param string $nomplat : Chaine de caracteres a decouper
 * @return string 
 */
public static function substringName($nomarticle, $length) : string{
  return (ucfirst(strlen($nomarticle) < $length ? $nomarticle : substr($nomarticle,0,$length)."..."));
}
}
?>