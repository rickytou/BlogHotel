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
use Blog\Model\Article\Article;
use Blog\Model\Categorie\Categorie;

class ArticleController {

  /** Fonction faisant appel a la vue de la page d'accueil 
   * @return void
  */
  public static function index(){
    $listArticles = Article::listArticleActivated();
    // echo "<pre>";
    // var_dump($listArticles);
    // echo "</pre>";
    // die;
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
    require_once('./view/article/modifierArticle.php');
  }
}
?>