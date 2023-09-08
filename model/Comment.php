<?php declare(strict_types=1); 
namespace Blog\Model\Comment;

use PDO;
use PDOException;
use DataAccessObject;

class Comment{
  private const STATUT = 0;
  private int $idCommentaire;
  private int $idComment;

  public function __construct(private int $idArticle, private string $pseudo, private string $descriptioncommentaire){
    $this->idArticle = $idArticle;
    $this->pseudo;
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
     $query = "SELECT * FROM COMMENTAIRES WHERE idArticle = :idArticle and statut = 1";
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
     $query = "SELECT * FROM COMMENTAIRES";
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
private static function findPseudo($pseudo)
  {
    $lstComment = array();
    $con = self::establishedConnection();
    try {
      $query = "select * from commentaires where pseudo = '" . strtolower(trim($pseudo)) . "'";
      $requete = $con->query($query, PDO::FETCH_ASSOC);
      $trouve = false;
      foreach ($requete as $key => $req) {
        $lstComment[$key] = $req;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $lstComment;
  }

  /** Fonction permettant de soumettre un commentaire */
  public static function addComment(Comment $comment){
    $con = self::establishedConnection();
    $message = '';
    $lstCommentPseudo = self::findPseudo(strtolower($comment->getPseudo()));
    if(count($lstCommentPseudo) > 0){
      $message = '<p class="message--erreur">Le pseudo existe d&eacute;j&agrave;</p>';
    }
    else{
    try{
      $query = 'INSERT INTO commentaires (idArticle, pseudo, descriptionCommentaire, statut)
                VALUES(:idArticle, :pseudo, :descriptionCommentaire, :statut)';
      $requete = $con->prepare($query);
      $requete->execute(
                        array(
                              "idArticle" => $comment->getIdArticle(),
                              "pseudo" => $comment->getPseudo(),
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
  }
    return $message;
  }
}