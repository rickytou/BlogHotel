<?php declare(strict_types=1); 
namespace Blog\Model\Comment;

use PDO;
use PDOException;
use DataAccessObject;

class Comment{
  private const STATUT = 0;
  private int $idCommentaire;
  private int $idComment;

  public function __construct(private int $idArticle, private string $descriptioncommentaire){
    $this->idArticle = $idArticle;
    $this->descriptioncommentaire = $descriptioncommentaire;
  }
  public function getIdCommentaire() { return $this->idArticle; }
  public function getIdArticle() { return $this->idArticle; }
  public function getPseudo() { return $this->pseudo; }
  public function getDescriptionCommentaire() { return $this->descriptioncommentaire; }
  public function getStatut() { return self::STATUT; }

  public function setIdArticle(int $idArticle){ $this->idArticle = $idArticle; }

  private static function establishedConnection()
  {
    $con = DataAccessObject::connexion();
    return $con;
  }

  /** Fonction permettant de d'afficher la liste des commentaires */
  public static function listCommentaireByArticle(int $idArticle){
    $con = self::establishedConnection();
    $listCommentaire = array();
    try{
     $query = "SELECT * FROM commentaires WHERE idArticle = :idArticle and statut = 1";
     $requete = $con->prepare($query);
     $requete->execute(array("idArticle" => $idArticle));
     foreach($requete as $key => $req){
      $listCommentaire[$key] = $req;
     } 
    }
    catch(PDOException $e){
      echo 'Erreur : '.$e->getMessage();
    }
    return $listCommentaire;
  }

  public static function listCommentaire(){
    $con = self::establishedConnection();
    $listCommentaire = array();
    try{
     $query = "SELECT * FROM commentaires";
     $requete = $con->query($query);
     foreach($requete as $key => $req){
      $listCommentaire[$key] = $req;
     } 
    }
    catch(PDOException $e){
      echo 'Erreur : '.$e->getMessage();
    }
    return $listCommentaire;
  }
/** Fonction permettant de rechercher si le pseudo existe deja */
// private static function findPseudo($pseudo)
//   {
//     $lstComment = array();
//     $con = self::establishedConnection();
//     try {
//       $query = "select * from commentaires where pseudo = '" . strtolower(trim($pseudo)) . "'";
//       $requete = $con->query($query, PDO::FETCH_ASSOC);
//       $trouve = false;
//       foreach ($requete as $key => $req) {
//         $lstComment[$key] = $req;
//       }
//     } catch (PDOException $e) {
//       echo $e->getMessage();
//     }
//     return $lstComment;
//   }

  /** Fonction permettant de soumettre un commentaire */
  public static function addComment(Comment $comment){
    $con = self::establishedConnection();
    $message = '';
    try{
      $query = 'INSERT INTO commentaires (idArticle, descriptionCommentaire, statut)
                VALUES(:idArticle, :descriptionCommentaire, :statut)';
      $requete = $con->prepare($query);
      $requete->execute(
                        array(
                              "idArticle" => $comment->getIdArticle(),
                              "descriptionCommentaire" => $comment->getDescriptionCommentaire(),
                              "statut" => $comment->getStatut()
                              )
                      );
      if($requete){
        $message = '<p class="message--succes">Commentaire soumis, un moderateur l\'activera sous peu</p>';
      }
    }
    catch(PDOException $e){
      echo 'Erreur : '.$e->getMessage();
    }
    return $message;
  }

   /** Fonction permettant de d'activer un commentaire */
   public static function activatedComment(array $GET){
    $con = self::establishedConnection();
    $message = '';
    try{
      $query = 'update commentaires set statut = :statut where idCommentaire = :id';
      $requete = $con->prepare($query);
      $requete->execute(array('statut' => 1,
                              'id' =>  $GET["idCommentaire"])
                       );
      if($requete){
        $message = '<p class="message--succes">Commentaire activ&eacute;e avec succ&egrave;s</p>';
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $message;
  }

  /** Fonction permettant de desactiver un commentaire */
  public static function desactivatedComment(array $GET)
  {
    $con = self::establishedConnection();
    $message = '';
    try {
      $query = 'update commentaires set statut = :statut where idCommentaire = :id';
      $requete = $con->prepare($query);
      $requete->execute(
        array(
          'statut' => 0,
          'id' => $GET["idCommentaire"]
        )
      );
      if ($requete) {
        $message = '<p class="message--succes">Commentaire d&eacute;sactiv&eacute; avec succ&egrave;s</p>';
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $message;
  }

  public static function deleteComment(int $idCommentaire){
    $con = self::establishedConnection();
    $message = '';
    try{
      $query = 'delete from commentaires where idCommentaire = :id';
      $requete = $con->prepare($query);
      $requete->execute(array('id'=>$idCommentaire));
      if($requete){
        $message = '<p class="message--succes">Commentaire supprim&eacute; avec succ&egrave;s</p>';
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $message;
  }

  /** Fonction permettant de supprimer toutes les categories */
  public static function deleteComments(){
    $con = self::establishedConnection();
    $message = '';
    try{
      $query = 'delete from commentaires';
      $requete = $con->exec($query);
      if($requete > 0){
        $message = '<p class="message--succes">Les commentaires ont &eacute;t&eacute; supprim&eacute;es avec succ&egrave;s</p>';
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $message;
  }
  /** Fonction permettant de supprimer tous les commentaires d'un article donne */
  public static function deleteCommentByArticle(int $idArticle){
    $con = self::establishedConnection();
    $execute = false;
    try{
      $query = 'delete from commentaires where idArticle = :id';
      $requete = $con->prepare($query);
      $requete->execute(array('id'=>$idArticle));
      if($requete){
        $execute = true;
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
    return $execute;
  }
}