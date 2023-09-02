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
    public static function addArticle($GETArticle){
      $invalid = false;
      $message = null;
      foreach($GETArticle as $article){
        if(empty($article)){
          $invalid = true;
        }
      }
      if($invalid){
        $message = '<p class="message--erreur">Tous les champs doivent &ecirc;tre renseign&eacute;s </p>';
      }
      else{
        $titre = $GETArticle['titre'];
        $tags = $GETArticle['tags'];
        $description = $GETArticle['description'];
        $article = new Article($titre, $tags, $description);
       Article::addArticle($article);
      }
      echo $message;
    }
}


?>