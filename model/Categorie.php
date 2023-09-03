<?php declare(strict_types=1);
/** Espace de nom pour le model Categorie */
namespace Blog\Model\Categorie;

use PDO;
use Exception;
use PDOException;
use DataAccessObject;

/** Classe Categories */
class Categorie{
  /**
   * @var int $categoriesID : Description de la categorie
   */
  private string $descriptionCategorie;
  /**
   * @var string $nomCategories : Nom de la categorie
   */
  private string $nomCategorie;

  /** Constructeur */
      public function __construct($nomCategorie, $descriptionCategorie){
        $this->nomCategorie = $nomCategorie;
        $this->descriptionCategorie = $descriptionCategorie;
      }
          /** Les accesseurs et les mutateurs */
    public function getNomCategorie(): string{ return $this->nomCategorie; }
    public function getDescriptionCategorie(): string { return $this->descriptionCategorie; }

    public static function establishedConnection(){
      $con = DataAccessObject::connexion();
      return $con;
    }
      /** Fonction permettant d'ajouter une nouvelle categorie
     * @param Categorie $categorie : Objet categorie
     * @return string $message : Retourne un message personnalise de confirmation 
     */
    public static function addCategorie(Categorie $categorie){
      $con = self::establishedConnection();
      $message = '';
      try{
        $query = 'Insert into Categories(nomCategorie, descriptionCategorie, actif) 
                  values(:nomCategorie, :descriptionCategorie, :actif)';
        $requete = $con->prepare($query);
        $requete->execute(array('nomCategorie' => $categorie->getNomCategorie(), 
                                'descriptionCategorie' => $categorie->getDescriptionCategorie(),
                                 'actif' => 1));  
        if($requete){
          $message = $categorie->getNomCategorie().' ajout&eacute; avec succ&egrave;s';
        }
        else{
          throw new Exception('Impossible d\'inserer les donnees dans la base');
        }                              
      }
      catch(PDOException $e){
        echo $e->getMessage();
      }
      return $message;
    }
    /**Fonction permettant d'afficher la liste des categories */
    public static function listCategorie(){
      $listeCategories = array();
      $con = self::establishedConnection();
      try{
        $query = 'select * from categories';
        $listeCat = $con->query($query, PDO::FETCH_ASSOC);
       foreach($listeCat as $key => $lstCat){
        $listeCategories[$key] = $lstCat;
       }                   
       return $listeCategories;
      }
      catch(PDOException $e){
        echo $e->getMessage();
        return array();
      }
    } 

    /** Fonction permettant de supprimer une categorie
     * @param int $idCategorie : Identifiant de la categorie
     * @return string $message : Message de suppression reussie avec succes
     */
    public static function deleteCategorie(int $idCategorie){
      $con = self::establishedConnection();
      $message = '';
      try{
        $query = 'delete from categories where idCategorie = :id';
        $requete = $con->prepare($query);
        $requete->execute(array('id'=>$idCategorie));
        if($requete){
          $message = '<p class="message--succes">Cat&eacute;gorie supprim&eacute;e avec succ&egrave;s</p>';
        }
      }
      catch(PDOException $e){
        echo $e->getMessage();
      }
      return $message;
    }

    /** Fonction permettant de supprimer toutes les categories */
    public static function deleteCategories(){
      $con = self::establishedConnection();
      $message = '';
      try{
        $query = 'delete from categories';
        $requete = $con->exec($query);
        if($requete > 0){
          $message = '<p class="message--succes">Les cat&eacute;gories ont &eacute;t&eacute; supprim&eacute;es avec succ&egrave;s</p>';
        }
      }
      catch(PDOException $e){
        echo $e->getMessage();
      }
      return $message;
    }

    /** Rechercher les informations d'une Categorie */
    public static function viewCategorie(int $idCategorie){
      $con = self::establishedConnection();
      $viewCategorie = array();
      try{
        $query = 'select * from categories where idCategorie ='.$idCategorie;
        $requete = $con->query($query, PDO::FETCH_ASSOC);
        foreach($requete as $key => $req){
          $viewCategorie[$key] = $req;
        }
        }
      catch(PDOException $e){
        echo $e->getMessage();
      }
      return $viewCategorie;
    }
    /** Fonction permettant de modifier une categorie */
    public static function updateCategorie(array $GET){
 
      $con = self::establishedConnection();
      $message = '';
      try{
        $query = 'update categories set nomCategorie = :nom, descriptionCategorie = :desc, actif = :actif where idCategorie = :id';
        $requete = $con->prepare($query);
        $requete->execute(array(
                                'nom' => $GET["nomCategorie"],
                                'desc' => $GET["descriptionCategorie"],
                                'actif' => (int) $GET["actif"],
                                'id' =>  $GET["idCategorie"])
                         );
        if($requete){
          $message = '<p class="message--succes">Cat&eacute;gorie modifi&eacute;e avec succ&egrave;s</p>';
        }
      }
      catch(PDOException $e){
        echo $e->getMessage();
      }
      return $message;
    }
}




?>