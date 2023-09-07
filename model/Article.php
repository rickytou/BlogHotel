<?php declare(strict_types=1);
/** Creation de namespace article */
namespace Blog\Model\Article;

use PDO;
use Exception;
use PDOException;
use DataAccessObject;

class Article
{
  /**
   * Declaration des proprietes de la classe Article
   */
  /**
   * @var string $titre : Titre de l'article
   */
  private string $titreArticle;
  /** */
  private int $idArticle;
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
  public function __construct(string $titreArticle, string $descriptionArticle, int $idCategories)
  {
    $this->titreArticle = $titreArticle;
    $this->descriptionArticle = $descriptionArticle;
    $this->idCategories = $idCategories;
    $this->datepubArticle = time();
  }
  /** Les accesseurs et les mutateurs */
  private function getIdArticle(): int
  {
    return $this->idArticle;
  }
  public function getTitre(): string
  {
    return $this->titreArticle;
  }
  public function getDescription(): string
  {
    return $this->descriptionArticle;
  }
  public function getIdCategorie(): int
  {
    return $this->idCategories;
  }
  public function getImageArticle(): string
  {
    return $this->imageArticle;
  }
  public function getDatePubArticle(): int
  {
    return $this->datepubArticle;
  }
  public function getActif(): int
  {
    return self::$actif;
  }
  /** */
  public function setIdArticle(int $idArticle)
  {
    $this->idArticle = $idArticle;
  }
  public function setActif(int $actif)
  {
    self::$actif = $actif;
  }
  /** Fonction permettant d'etablir la connexion
   * @return mixed $con : Retourne l'objet connection
   */
  public static function establishedConnection()
  {
    $con = DataAccessObject::connexion();
    return $con;
  }
  /** Fonction permettant d'ajouter un nouveau article
   * @param Article $article : Objet article
   * @param array $uploadImage : Fichier image uploade
   * @return string $message : Message de confirmation ou d'erreur
   */
  public static function addArticle(Article $article, array $uploadImage)
  {
    $message = self::uploadImage($uploadImage, $article->getTitre());
    if ($message) {
      return $message;
    } else {
      /* Appel a la fonction existArticle */
      $findArticle = self::findArticle(strtolower($article->getTitre()));
      if (count($findArticle) > 0) {
        $messageUserUpdate = '<p class="message--erreur">Nom de l\'article existant</p>';
      } else {
        $tabExtension = explode('.', $uploadImage["uploadimage"]["name"]);
        $extension = strtolower(end($tabExtension));
        $newName = $article->getTitre() . "." . $extension;
        $tmpName = $uploadImage["uploadimage"]["tmp_name"];
        $upload__dir = './upload/article/' . $newName;
        $dateduJour = date("Y-m-d", time());
        $con = self::establishedConnection();
        try {
          $query = 'Insert into article(titreArticle, idCategories, descriptionArticle, imageArticle, datepubArticle, actif) 
                    values(:titre, :idCategories, :descriptionArticle, :imageArticle, :datepubArticle, :actif)';
          $requete = $con->prepare($query);
          $requete->execute(
            array(
              'titre' => $article->getTitre(),
              'idCategories' => $article->getIdCategorie(),
              'descriptionArticle' => $article->getDescription(),
              'imageArticle' => $upload__dir,
              'datepubArticle' => $dateduJour,
              'actif' => self::$actif
            )
          );
          if ($requete) {
            $messageUserUpdate = '<p class="message--succes">Article ajout&eacute; avec succ&egrave;s</p>';
            move_uploaded_file($tmpName, $upload__dir);
          } else {
            throw new Exception('<p class="message--erreur"> Impossible d\'ins&eacute;rer les donn&eacute;es dans la base</p>');
          }
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }
    }
    return $messageUserUpdate;
  }
  private static function findArticle($titre)
  {
    $lstArticle = array();
    $con = self::establishedConnection();
    try {
      $query = "select * from article where titreArticle = '" . strtolower(trim($titre)) . "'";
      $requete = $con->query($query, PDO::FETCH_ASSOC);
      $trouve = false;
      foreach ($requete as $key => $req) {
        $lstArticle[$key] = $req;
        // if ($req) {
        //   $trouve = true;
        // }
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $lstArticle;
  }
  private static function uploadImage(array $uploadimage, string $titre)
  {
    $messageUserUpdate = '';
    $taillemaxfile = 1000000;
    $newName = "";
    $valid = true;
    /** ----------------------------------------------------------- */

    if ($uploadimage['uploadimage']["name"]) {
      $name = $uploadimage['uploadimage']['name'];
      $tmpName = $uploadimage['uploadimage']['tmp_name'];
      $size = $uploadimage['uploadimage']['size'];
      $tabExtension = explode('.', $name);
      $extension = strtolower(end($tabExtension));
      $newName = $titre . "." . $extension;
      //Tableau des extensions que l'on accepte
      $extensions = ['jpg', 'png', 'jpeg', 'svg'];
      if (!in_array($extension, $extensions) || $size > $taillemaxfile) {
        $valid = false;
      }
    }

    if (!$valid) {
      $messageUserUpdate = '<p class="message--erreur">Impossible d\'upload l\'image [extension ou taille invalide]</p>';
    }
    return $messageUserUpdate;
  }
  /** Fonction permettant de lister les articles */
  public static function listArticle(): array
  {
    $con = self::establishedConnection();
    $listArticle = array();
    try {
      $query = 'select * from article order by idArticle desc';
      $listeArt = $con->query($query, PDO::FETCH_ASSOC);
      foreach ($listeArt as $key => $article) {
        $listArticle[$key] = $article;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $listArticle;
  }
  /** Fonction permettant de lister les articles */
  public static function listArticleActivated(int $rowCount): array
  {
    $con = self::establishedConnection();
    $listArticle = array();
    try {
      $query = 'SELECT * FROM article WHERE actif = 1 ORDER BY idArticle DESC LIMIT '.$rowCount;
      $listeArt = $con->query($query, PDO::FETCH_ASSOC);
      foreach ($listeArt as $key => $article) {
        $listArticle[$key] = $article;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $listArticle;
  }
  /** Fonction permettant de supprimer un article */
  public static function deleteArticle(int $idArticle)
  {
    $con = self::establishedConnection();
    /** Recuperer le path de l'image de l'article pour l'identifiant */
    $articleimagepath = self::viewArticle($idArticle)[0]['imageArticle'];
    $message = '';
    try {
      $query = 'delete from article where idArticle = :id';
      $requete = $con->prepare($query);
      $requete->execute(array('id' => $idArticle));
      if ($requete) {
        $message = '<p class="message--succes">Article supprim&eacute; avec succ&egrave;s</p>';
        unlink($articleimagepath);
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $message;
  }
  /** Fonction permettant de supprimer toutes les categories */
  public static function deleteArticles()
  {
    $con = self::establishedConnection();
    /** Recuperer tous les articles pour avoir le path de tous les images  */
    $listArticles = self::listArticle();
    try {
      $query = 'delete from article';
      $requete = $con->exec($query);
      if ($requete > 0) {
        foreach ($listArticles as $article) {
          unlink($article['imageArticle']);
        }
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  /** Fonction permettant de desactiver une categorie */
  public static function desactivatedArticle(array $GET)
  {
    $con = self::establishedConnection();
    $message = '';
    try {
      $query = 'update article set actif = :actif where idArticle = :id';
      $requete = $con->prepare($query);
      $requete->execute(
        array(
          'actif' => 0,
          'id' => $GET["idArticle"]
        )
      );
      if ($requete) {
        $message = '<p class="message--succes">Article d&eacute;sactiv&eacute; avec succ&egrave;s</p>';
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $message;
  }
  public static function activatedArticle(array $GET)
  {
    $con = self::establishedConnection();
    $message = '';
    try {
      $query = 'update article set actif = :actif where idArticle = :id';
      $requete = $con->prepare($query);
      $requete->execute(
        array(
          'actif' => 1,
          'id' => $GET["idArticle"]
        )
      );
      if ($requete) {
        $message = '<p class="message--succes">Article activ&eacute; avec succ&egrave;s</p>';
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $message;
  }

  /** Rechercher les informations d'une Categorie */
  public static function viewArticle(int $idArticle)
  {
    $con = self::establishedConnection();
    $viewArticle = array();
    try {
      $query = 'select * from article where idArticle =' . $idArticle;
      $requete = $con->query($query, PDO::FETCH_ASSOC);
      foreach ($requete as $key => $req) {
        $viewArticle[$key] = $req;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $viewArticle;
  }
  public static function updateArticle(Article $article, array $uploadImage = null)
  {
    $lstArticle = Article::listArticle();
    $upload__dir = '';
    $imagepath = '';
    $message = '';
    $messageUserUpdate = '';
    $query = '';
    $tmpName = '';
    if($uploadImage["uploadimage"]["name"]){
      $message = self::uploadImage($uploadImage, $article->getTitre());
      $tabExtension = explode('.', $uploadImage["uploadimage"]["name"]);
      $extension = strtolower(end($tabExtension));
      $newName = $article->getTitre() . "." . $extension;
      $tmpName = $uploadImage["uploadimage"]["tmp_name"];
      $upload__dir = './upload/article/' . $newName;
       /** Recuperer l'ancienne image */
      foreach ($lstArticle as $art) {
        if ($art["idArticle"] == $article->getIdArticle()) {
          $imagepath = $art["imageArticle"];
        }
      }
    }

    if ($message) {
      return $message;
    } else {
      $con = self::establishedConnection();
      $findArticle = self::findArticle($article->getTitre());
      $validation = false;
      if (count($findArticle) > 0) {
        foreach ($lstArticle as $art) {
          if (
            (int) $article->getIdArticle() != (int) $findArticle[0]['idArticle'] &&
            strtolower($findArticle[0]["titreArticle"]) == strtolower($art["titreArticle"])
          ) {
            $validation = true;
          }
        }
      }
      if ($validation) {
        $messageUserUpdate = '<p class="message--erreur">Nom de l\'article existant</p>';
      } 
      else {
        try {
          if($uploadImage["uploadimage"]["name"]){
          unlink($imagepath);
          $query = 'update article set titreArticle =:titre, idCategories=:idCategories, descriptionArticle=:descriptionArticle, imageArticle=:imageArticle, actif=:actif where idArticle=:idArticle';
          $requete = $con->prepare($query);
          $requete->execute(
            array(
              'titre' => $article->getTitre(),
              'idCategories' => $article->getIdCategorie(),
              'descriptionArticle' => $article->getDescription(),
              'imageArticle' => $upload__dir,
              'actif' => $article->getActif(),
              'idArticle' => $article->getIdArticle()
            )
          );
          }
          else{
            $query = 'update article set titreArticle =:titre, idCategories=:idCategories, descriptionArticle=:descriptionArticle, actif=:actif where idArticle=:idArticle';
          $requete = $con->prepare($query);
            $requete->execute(
              array(
                'titre' => $article->getTitre(),
                'idCategories' => $article->getIdCategorie(),
                'descriptionArticle' => $article->getDescription(),
                'actif' => $article->getActif(),
                'idArticle' => $article->getIdArticle()
              )
            );
          }
         
          if ($requete) {
            $messageUserUpdate = '<p class="message--succes">Article modifi&eacute; avec succ&egrave;s</p>';
            if($uploadImage["uploadimage"]["name"]){
            move_uploaded_file($tmpName, $upload__dir);
            }
          } else {
            throw new Exception('<p class="message--erreur"> Impossible de modifier les donn&eacute;es dans la base</p>');
          }
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }
    }
    return $messageUserUpdate;
  }
  public static function countArticle(int $idCategorie = null){
    $result = array();
    $con = self::establishedConnection();
    try{
      if($idCategorie){
        $query ="SELECT * FROM article AS a, categories AS c 
        WHERE a.idCategories = c.idCategorie 
        AND a.idCategories = ".$idCategorie." AND a.actif = 1";
      }
      else{
        $query ="SELECT * FROM article AS a, categories AS c 
        WHERE a.idCategories = c.idCategorie 
        AND a.actif = 1";
      }
    
      $rows = $con->query($query);     
      foreach($rows as $key => $row){
        $result[$key] = $row;
      }   
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return count($result);
  }
  /** Filter */
  public static function filter(int $idCategorie = null, int $limit = null){
    $result = array();
    $con = self::establishedConnection();
    try{
      if($idCategorie){
        $query ="SELECT * FROM article WHERE idCategories =".$idCategorie." AND actif = 1";
      }
      else{
        $query ="SELECT * FROM article WHERE actif = 1 LIMIT ".$limit;
      }
      $rows = $con->query($query);     
      foreach($rows as $key => $row){
        $result[$key] = $row;
      }   
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $result;
  }
  
  /** Fonction permettant d'afficher la desction */
  public static function descriptionArticle(int $idArticle)
  {
    $lstArticle = array();
    $con = self::establishedConnection();
    try {
      $query = "select * from article where idArticle = ".$idArticle;
      $requete = $con->query($query, PDO::FETCH_ASSOC);
      $trouve = false;
      foreach ($requete as $key => $req) {
        $lstArticle[$key] = $req;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $lstArticle;
  }
  
}