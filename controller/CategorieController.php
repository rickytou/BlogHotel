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
        $message = Categorie::addCategorie($categorie);
        $message = '<p class="message--succes">'.$message.'</p>';
      }  
      echo $message;
    }
    /** Fonction permettant d'afficher la liste de categorie */
    public static function listCategorie(){
      $listCategories = Categorie::listCategorie();
      if(count($listCategories) == 0){
        echo '<p class="message--erreur"> Aucune cat&eacute;gorie disponible, veuillez en ajouter';
      }else{
        require_once('./view/categorie/listeCategorie.php');
      }
    }
    /** Fonction permettant de supprimer une categorie
     * @param int $idCategorie : Identifiant de la categorie
     */
    public static function deleteCategorie(int $idCategorie){
      $message = Categorie::deleteCategorie($idCategorie);
      $listCategories = Categorie::listCategorie();
      require_once('./view/categorie/listeCategorie.php');
    }

    /** Fonction permettant de supprimer toutes les categories */
    public static function deleteCategories(){
         $message = Categorie::deleteCategories();
         echo $message;
    }

    /** Fonction permettant de modifier la liste des categories */
    public static function viewCategorie(int $idCategorie){
      $viewCategorie = Categorie::viewCategorie($idCategorie);
      require_once('./view/categorie/modifierCategorie.php');
    }
    public static function updateCategorie(array $GET){
      $invalid = false;
      $message = '';
      if(!$GET['nomCategorie']){
        $invalid = true;
      }
      if($invalid){
        $message = '<p class="message--erreur">Nom cat&eacute;gorie obligatoire</p>';
      }
      else{
        $message = Categorie::updateCategorie($GET);
      }
      echo $message;
    }
}
?>