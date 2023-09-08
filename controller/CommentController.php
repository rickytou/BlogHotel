<?php declare(strict_types=1);
namespace Blog\Controller\Comments;
use Blog\Model\Comment\Comment;

class CommentController{

  /** Fonction permettant de soumettre un commentaire */
  public static function addComment(array $GETData){
  $message = '';
  $valid = false;
  $Datas = [
            "pseudo" => $GETData["pseudo"],
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
    if(self::countWord($GETData["descriptioncommentaire"], 500)){
      $message = '<p class="message--erreur">Maximum de 150 caracteres pour le commentaire</p>';
    }
    else{
    $comment = new Comment(
                            (int) $GETData["idArticle"],
                            $GETData["pseudo"],
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
}
?>