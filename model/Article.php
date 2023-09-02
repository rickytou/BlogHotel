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
    private string $tags;

    /** Constructeur */
    public function __construct($titre, $tags, $description){
      $this->titre = $titre;
      $this->tags = $tags;
      $this->description = $description;
    }
    public function __toString() : string{
      return $this->titre.' a ete ajoutee';
    }
    /** Les accesseurs et les mutateurs */
    public function getTitre(): string{ return $this->titre; }
    public function getTags(): string { return $this->tags; }
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
    public static function addArticle(Article $article){
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
  }


?>