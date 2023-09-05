<?php declare(strict_types = 1);
/** Creation de namespace article */
namespace Blog\Model\Article;

use PDO;
use Exception;
use PDOException;
use DataAccessObject;

  class Article{
    /**
     * Declaration des proprietes de la classe Article
     */
    /**
     * @var string $titre : Titre de l'article
     */
    private string $titreArticle;
    /**
     * @var string $image : Image de l'article
     */
    private string $imageArticle;
    /**
     * @var array $categories: Liste d'article
     */
    private int $idCategories;
    /**
     * @var string contenu : Description de l'article
     */
    private string $descriptionArticle;
    /**
     * @var int $datepubArticle : Date de publication de l'article
     */
    private int $datepubArticle;
    private static int $actif = 1;
    
    /** Constructeur */
    public function __construct(string $titreArticle, string $descriptionArticle, int $idCategories){
      $this->titreArticle = $titreArticle;
      $this->descriptionArticle = $descriptionArticle;
      $this->idCategories = $idCategories;
      $this->datepubArticle = time();
    }
    /** Les accesseurs et les mutateurs */
    public function getTitre(): string{ return $this->titreArticle; }
    public function getDescription(): string { return $this->descriptionArticle; }
    public function getIdCategorie(): int { return $this->idCategories; }
    public function getImageArticle() : string { return $this->imageArticle; }
    public function getDatePubArticle() : int { return $this->datepubArticle; }
    public function getActif() : int { return self::$actif; }
    /** Fonction permettant d'etablir la connexion
     * @return mixed $con : Retourne l'objet connection
     */
    public static function establishedConnection(){
      $con = DataAccessObject::connexion();
      return $con;
    }
    /** Fonction permettant d'ajouter un nouveau article
     * @param Article $article : Objet article
     * @param array $uploadImage : Fichier image uploade
     * @return string $message : Message de confirmation ou d'erreur
     */
    public static function addArticle(Article $article, array $uploadImage){
      $message = self::uploadImage($uploadImage, $article->getTitre());
      if($message){
        return $message;
      }
      else{
        /* Appel a la fonction existArticle */
        $findArticle = self::findArticle(strtolower($article->getTitre()));
        if($findArticle){
          $messageUserUpdate = '<p class="message--erreur">Nom de l\'article existant</p>';
        } 
        else{
          $tabExtension = explode('.', $uploadImage["uploadimage"]["name"]);
          $extension = strtolower(end($tabExtension));
          $newName = $article->getTitre().".".$extension;
          $tmpName = $uploadImage["uploadimage"]["tmp_name"];
          $upload__dir = './upload/article/'.$newName;
          $dateduJour = date("Y-m-d", time());
          $con = self::establishedConnection();
        try{
          $query = 'Insert into article(titreArticle, idCategories, descriptionArticle, imageArticle, datepubArticle, actif) 
                    values(:titre, :idCategories, :descriptionArticle, :imageArticle, :datepubArticle, :actif)';
          $requete = $con->prepare($query);
          $requete->execute(array('titre' => $article->getTitre(),
                                  'idCategories' => $article->getIdCategorie(), 
                                  'descriptionArticle' => $article->getDescription(),
                                  'imageArticle' => $upload__dir,
                                  'datepubArticle' => $dateduJour,
                                  'actif' => self::$actif)
                                );  
          if($requete){
            $messageUserUpdate = '<p class="message--succes">Article ajout&eacute; avec succ&egrave;s</p>';
            move_uploaded_file($tmpName, $upload__dir);
          }
          else{
            throw new Exception('<p class="message--erreur"> Impossible d\'ins&eacute;rer les donn&eacute;es dans la base</p>');
          }                              
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }
      }
    }
      return $messageUserUpdate;
    }
    private static function findArticle($titre){
      $lstArticle = array();
      $con = self::establishedConnection();
      try{
          $query = "select * from article where titreArticle = '".strtolower($titre)."'";
          $requete = $con->query($query, PDO::FETCH_ASSOC);
          $trouve = false;
          foreach($requete as $req){
            if($req){
               $trouve = true; 
            }
          }
      }
      catch(PDOException $e){
        echo $e->getMessage();
      }
      return $trouve;
    } 
    private static function uploadImage(array $uploadimage, string $titre){
      $messageUserUpdate = '';
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
        $newName = $titre.".".$extension;
        //Tableau des extensions que l'on accepte
        $extensions = ['jpg', 'png', 'jpeg', 'svg'];
        if(!in_array($extension, $extensions) && $size > $taillemaxfile){
          $valid = false;
        }  
      }

if(!$valid){
  $messageUserUpdate ='<p class="message--erreur">Impossible d\'upload l\'image [extension ou taille invalide]</p>';
}
return $messageUserUpdate;
  }
  /** Fonction permettant de lister les articles */
  public static function listArticle() : array{
    $con = self::establishedConnection();
    $listArticle = array();
    try{
      $query = 'select * from article order by idArticle desc';
      $listeArt = $con->query($query, PDO::FETCH_ASSOC);
     foreach($listeArt as $key => $article){
      $listArticle[$key] = $article;
     }                   
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $listArticle;
  }
  /** Fonction permettant de lister les articles */
  public static function listArticleActivated() : array{
    $con = self::establishedConnection();
    $listArticle = array();
    try{
      $query = 'select * from article where actif = 1 order by idArticle desc';
      $listeArt = $con->query($query, PDO::FETCH_ASSOC);
     foreach($listeArt as $key => $article){
      $listArticle[$key] = $article;
     }                   
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $listArticle;
  }
  /** Fonction permettant de supprimer un article */
  public static function deleteArticle(int $idArticle){
    $con = self::establishedConnection();
    $message = '';
    try{
      $query = 'delete from article where idArticle = :id';
      $requete = $con->prepare($query);
      $requete->execute(array('id'=>$idArticle));
      if($requete){
        $message = '<p class="message--succes">Article supprim&eacute; avec succ&egrave;s</p>';
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $message;
  }

   /** Fonction permettant de desactiver une categorie */
   public static function desactivatedArticle(array $GET){
    $con = self::establishedConnection();
    $message = '';
    try{
      $query = 'update article set actif = :actif where idArticle = :id';
      $requete = $con->prepare($query);
      $requete->execute(array('actif' => 0,
                              'id' =>  $GET["idArticle"])
                       );
      if($requete){
        $message = '<p class="message--succes">Article d&eacute;sactiv&eacute; avec succ&egrave;s</p>';
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $message;
  }

  public static function activatedArticle(array $GET){
    $con = self::establishedConnection();
    $message = '';
    try{
      $query = 'update article set actif = :actif where idArticle = :id';
      $requete = $con->prepare($query);
      $requete->execute(array('actif' => 1,
                              'id' =>  $GET["idArticle"])
                       );
      if($requete){
        $message = '<p class="message--succes">Article activ&eacute;e avec succ&egrave;s</p>';
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $message;
  }

  /** Rechercher les informations d'une Categorie */
  public static function viewArticle(int $idArticle){
    $con = self::establishedConnection();
    $viewArticle = array();
    try{
      $query = 'select * from article where idArticle ='.$idArticle;
      $requete = $con->query($query, PDO::FETCH_ASSOC);
      foreach($requete as $key => $req){
        $viewArticle[$key] = $req;
      }
      }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $viewArticle;
  }
}
?>