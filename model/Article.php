<?php declare(strict_types = 1);
/** Creation de namespace article */
namespace Blog\Model\Article;

use DataAccessObject;
use Exception;
use PDOException;

  class Article{
    /**
     * Declaration des proprietes de la classe Article
     */
    /**
     * @var string $titre : Titre de l'article
     */
    private string $titre;
    /**
     * @var string $image : Image de l'article
     */
    private string $image;
    /**
     * @var array $categories: Liste d'article
     */
    private array $categories;
    /**
     * @var string contenu : Description de l'article
     */
    private string $description;
    /**
     * @var string tags : Tags de l'article
     */
    
    /** Constructeur */
    public function __construct($titre, $description){
      $this->titre = $titre;
      $this->description = $description;
    }
    /** Les accesseurs et les mutateurs */
    public function getTitre(): string{ return $this->titre; }
    public function getDescription(): string { return $this->description; }
    /** Fonction permettant d'etablir la connexion
     * @return mixed $con : Retourne l'objet connection
     */
    public static function establishedConnection(){
      $con = DataAccessObject::connexion();
      return $con;
    }
    /** Fonction permettant d'ajouter un nouveau article
     * 
     */
    public static function addArticle(Article $article, array $uploadimage){
      $con = self::establishedConnection();
      try{
        $query = 'Insert into article(titreArticle, tagsArticle, descriptionArticle) 
                  values(:titre, :tags, :description)';
        $requete = $con->prepare($query);
        $requete->execute(array('titre' => $article->getTitre(), 
                                'tags' => $article->getTitre(),
                                'description' => $article->getDescription())
                              );  
        if($requete){
          echo "insertion reussie";
        }
        else{
          throw new Exception('Impossible d\'inserer les donnees dans la base');
        }                              
      }
      catch(PDOException $e){
        echo $e->getMessage();
      }
    }
    private static function uploadImage(array $uploadimage){
      echo "<pre>";
      var_dump($uploadimage);
      echo "</pre>";
      die;
      $arrayup = array();
       $taillemaxfile = 1000000;
       $newName = "";
       $valid = true;       
        /** ----------------------------------------------------------- */

      if($uploadimage['uploadimage']["name"]){
        $name = $uploadimage['uploadimage']['name'];
        $tmpName = $uploadimage['uploadimage']['tmp_name'];
        $size = $uploadimage['uploadimage']['size'];
        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));
        $newName = $_SESSION["utilisateur"].".".$extension;
        //Tableau des extensions que l'on accepte
        $extensions = ['jpg', 'png', 'jpeg', 'svg'];
        if(!in_array($extension, $extensions) && $size > $taillemaxfile){
          $valid = false;
        }   
      }
if(!$valid){
  $messageUserUpdate ='<p class="message__panel__error">Impossible d\'upload l\'image [extension ou taille invalide]</p>';
}
    }
  }


?>