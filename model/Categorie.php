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
     * 
     */
    public static function addCategorie(Categorie $categorie){
      $con = self::establishedConnection();
      try{
        $query = 'Insert into Categories(nomCategorie, descriptionCategorie) 
                  values(:nomCategorie, :descriptionCategorie)';
        $requete = $con->prepare($query);
        $requete->execute(array('nomCategorie' => $categorie->getNomCategorie(), 
                                'descriptionCategorie' => $categorie->getDescriptionCategorie()));  
        if($requete){
          return true;
        }
        else{
          throw new Exception('Impossible d\'inserer les donnees dans la base');
        }                              
      }
      catch(PDOException $e){
        echo $e->getMessage();
        return null;
      }
    }
    /**Fonction permettant d'afficher la liste des categories */
    public static function listCategorie(){
      $con = self::establishedConnection();
      try{
        $query = 'select * from categories';
        $listeCategories = $con->query($query, PDO::FETCH_ASSOC);
        return $listeCategories;                   
      }
      catch(PDOException $e){
        echo $e->getMessage();
        return null;
      }
    } 
}




?>