<?php declare(strict_types=1);
/**
 * CategorieController 
 *            - Controlleur servant d'interface entre la vue [view->Dashboard] 
 *              et le model Categorie
 * Les actions du controlleur : 
 *                            - index (Affichant la page d'accueil)
 *                            - addCategorie (Pour ajouter un article)
 *                            
 */
namespace Blog\Controller\Categorie;
use Blog\Model\Categorie\Categorie;
class CategorieController {

 
  /** Fonction faisant appel au model AddArticle pour ajouter un nouvel article
   * @param array $POSTArticle : Les donnees de l'article envoyees par le formulaire 
    */
    public static function addCategorie($GETCategorie){
      $message = null;
      if(empty($GETCategorie['nomCategorie'])){
        $message = '<p class="message--erreur">Erreur: Nom cat&eacute;gorie obligatoire</p>';
      }
      else{
        $nomCategorie = $GETCategorie['nomCategorie'];
        $descriptionCategorie = $GETCategorie['descriptionCategorie'];
        $categorie = new Categorie($nomCategorie, $descriptionCategorie);
        if(Categorie::addCategorie($categorie)){
          $message = '<p class="message--succes">Cat&eacute;gorie ajout&eacute; avec succ&egrave;s"</p>';
        }
      }  
      echo $message;
    }
    /** Fonction permettant d'afficher la liste de categorie */
    public static function listCategorie(){
      $listCategories = Categorie::listCategorie();
      require_once('./view/categorie/listeCategorie.php');
    }
}
?>