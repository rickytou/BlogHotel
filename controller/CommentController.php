<?php declare(strict_types=1);
namespace Blog\Controller\Comments;
use Blog\Model\Comment\Comment;

class CommentController{

/** fonction permettant de liste tous les commentaires */
public static function listCommentaire(){
  $listeCommentaires = Comment::listCommentaire();
  if(count($listeCommentaires) == 0){
    echo '<p class="message--erreur"> Aucune commentaire disponible, veuillez en ajouter';
  }else{
    require_once('./view/comment/listeCommentaire.php');
  }
}

  /** Fonction permettant de soumettre un commentaire */
  public static function addComment(array $GETData){
  $message = '';
  $valid = false;
  $Datas = [
            "descriptioncommentaire" => $GETData["descriptioncommentaire"]
          ]; 
  foreach($Datas as $data){
    if(empty($data)){
      $valid = true;
    }
  }
  if($valid){
    $message = '<p class="message--erreur">Il faut remplir tous les champs</p>';
  }
  else{
    if(self::countWord($GETData["descriptioncommentaire"], 300)){
      $message = '<p class="message--erreur">Maximum de 300 caracteres pour le commentaire</p>';
    }
    else{
      $comment = new Comment(
        (int) $GETData["idArticle"],
        $GETData["descriptioncommentaire"]
      );
    $message = Comment::addComment($comment);
    //$message = '<p class="message--succes">ok</p>';
  }
}
  echo $message;
  } 

  private static function countWord($text, $length) : bool{
    return ((strlen($text) > $length) ? true : false);
  }

     /** Fonction permettant d'activer un commentaire */
     public static function activatedComment(array $GET){
      $update = '';
      $update = Comment::activatedComment($GET);
      $listeCommentaires = Comment::listCommentaire();
      require_once('./view/comment/listeCommentaire.php');
    } 

    /** Fonction permettant de desactiver un commentaire */
  public static function desactivatedComment(array $GET){
    $update = '';
    $update = Comment::desactivatedComment($GET);
    $listeCommentaires = Comment::listCommentaire();
    require_once('./view/comment/listeCommentaire.php');
  }
  /** Fonction permmettant de supprimer un commentaire */
  public static function deleteComment(int $idComment){
    $message = Comment::deleteComment($idComment);
    $listeCommentaires = Comment::listCommentaire();
    require_once('./view/comment/listeCommentaire.php');
  }
    /** Fonction permettant de supprimer tous les commentaires */
    public static function deleteComments(){
      $message = Comment::deleteComments();
      echo $message;
 }
}
?>