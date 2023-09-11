<?php declare(strict_types=1);
namespace Blog\Model\Temoignages;

use PDO;
use Exception;
use PDOException;
use DataAccessObject;

class Temoignages{
  private const STATUT = 1;
  private int $idTemoignage; 
  private string $image;
  private int $datepubTemoignage;

  public function __construct(private string $avis, private string $temoin){
    $this->avis = $avis;
    $this->temoin = $temoin; 
    $this->datepubTemoignage = time();
  }
public function getTemoin(): string { return $this->temoin; } 
public function getAvis(): string { return $this->avis; } 
public function getIdTemoignage(): int { return $this->idTemoignage; } 
public function getImage(): string { return $this->image; } 
public function getStatut(): int { return self::STATUT; } 
public function getDatePubTemoignage(): int { return $this->datepubTemoignage; } 

public function setTemoin(string $temoin) { $this->temoin = $temoin; }
public function setAvis(string $avis) { $this->avis = $avis; }
public function setImage(string $image) { $this->image = $image; }
public function setDatePubTemoignage(int $datePubTemoignage) { $this->datepubTemoignage = $datePubTemoignage; }


public static function establishedConnection()
{
  $con = DataAccessObject::connexion();
  return $con;
}

  /** Fonction permettant d'ajouter un nouveau article
   * @param Temoignages $temoins : Objet Temoignage
   * @param array $uploadImage : Fichier image uploade
   * @return string $message : Message de confirmation ou d'erreur
   */
  public static function addTemoignage(Temoignages $temoins, array $uploadImage)
  {
    $messageImage = '';
    $message = '';
    $messageImage = self::uploadImage($uploadImage, $temoins->getTemoin());
    if ($messageImage) {
      return $messageImage;
    } else {
      /* Appel a la fonction de recherche du temoin */
      $findTemoignageTemoin = self::findTemoignageTemoin(strtolower($temoins->getTemoin()));
      if (count($findTemoignageTemoin) > 0) {
        $message = '<p class="message--erreur">Choisissez un autre t&eacute;moin</p>';
      } 
      else {
        $tabExtension = explode('.', $uploadImage['avatar']["name"]);
        $extension = strtolower(end($tabExtension));
        $newName = $temoins->getTemoin() . "." . $extension;
        $tmpName = $uploadImage['avatar']["tmp_name"];
        $upload__dir = './upload/avatar/' . $newName;
        $con = self::establishedConnection();
        try {
          $temoins->setImage($upload__dir);
          $query = 'Insert into temoignages(avis, temoin, image, statut, datepubTemoignage) 
                    values(:avis, :temoin, :image, :statut, :datepubTemoignage)';
          $requete = $con->prepare($query);
          $requete->execute(
            array(
              'avis' => $temoins->getAvis(),
              'temoin' => $temoins->getTemoin(),
              'image' => $temoins->getImage(),
              'statut' => self::STATUT,
              'datepubTemoignage' => (int) $temoins->getDatePubTemoignage()
              )
          );
          if ($requete) {
            $message = '<p class="message--succes">T&eacute;moignage ajout&eacute; avec succ&egrave;s</p>';
            move_uploaded_file($tmpName, $upload__dir);
          } else {
            throw new Exception('<p class="message--erreur"> Impossible d\'ins&eacute;rer les donn&eacute;es dans la base</p>');
          }
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }
    }
    return $message;
  }

  public static function listTemoignage(): array
  {
    $con = self::establishedConnection();
    $listTemoignage = array();
    try {
      $query = 'select * from temoignages order by idTemoignages desc';
      $listeTem = $con->query($query, PDO::FETCH_ASSOC);
      foreach ($listeTem as $key => $temoignage) {
        $listTemoignage[$key] = $temoignage;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
   
    return $listTemoignage;
  }

  private static function findTemoignageTemoin($temoin)
  {
    $lstTemoignage = array();
    $con = self::establishedConnection();
    try {
      $query = "select * from temoignages where temoin = '" . strtolower(trim($temoin)) . "'";
      $requete = $con->query($query, PDO::FETCH_ASSOC);
      $trouve = false;
      foreach ($requete as $key => $req) {
        $lstTemoignage[$key] = $req;
    }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $lstTemoignage;
  }

  private static function uploadImage(array $uploadimage, string $titre)
  {
    $messageUserUpdate = '';
    $taillemaxfile = 2000000;
    $newName = "";
    $valid = true;
    /** ----------------------------------------------------------- */

    if ($uploadimage['avatar']["name"]) {
      $name = $uploadimage['avatar']['name'];
      $tmpName = $uploadimage['avatar']['tmp_name'];
      $size = $uploadimage['avatar']['size'];
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



}