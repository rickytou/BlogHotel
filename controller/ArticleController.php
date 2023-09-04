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
         Article::addArticle($GET, $arrayPhoto);
        // echo $message;
      }
      echo $message;
}

}
?>