<?php declare(strict_types=1);
namespace Blog\Controller\Temoignage;

use Blog\Model\Temoignages\Temoignages;

class TemoignageController{
  public static function addTemoignage(array $GET, array $arrayPhoto) {
    $invalid = false;
      $message = '';
      foreach($GET as $art){
        if(empty($art)){
          $invalid = true;
        }
      }
      if(isset($arrayPhoto)){
        if(!$arrayPhoto["avatar"]['name']){
          $invalid = true;
        }
      }
      if($invalid){
        $message = '<p class="message--erreur">Tous les champs sont obligatoires</p>';
      }
      else{
        if(self::countWord($_GET["avis"], 300)){
          $message = '<p class="message--erreur">Taille maximum 300 caract&egrave;res</p>';
        }
        else{
          $temoignage = new Temoignages(
            trim($_GET["avis"]), 
            trim($_GET["temoin"])
          );
          $message = Temoignages::addTemoignage($temoignage, $arrayPhoto);
        }

      }
      echo $message;
  } 
  private static function countWord($text, $length) : bool{
    return ((strlen($text) > $length) ? true : false);
  }
  
      /** Fonction permettant d'afficher la liste de categorie */
      public static function listTemoignage(){
        $listTemoignage = Temoignages::listTemoignage();
        if(count($listTemoignage) == 0){
          echo '<p class="message--erreur"> Aucune t&eacute;moignage disponible, veuillez en ajouter';
        }
        else{
          require_once('./view/temoignage/listeTemoignage.php');
        }
      }
}