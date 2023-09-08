<?php declare(strict_types=1);
namespace Blog\Model\User;
use PDO;
use PDOException;
use DataAccessObject;

class User{
  private const STATUT = 1;
  public function __construct(private string $nomutilisateur, private string $motdepasse){
    $this->nomutilisateur = $nomutilisateur;
    $this->motdepasse = $motdepasse;
  }
  /** Les accesseurs et mutateurs */
  public function getNomUtilisateur(){ return $this->nomutilisateur; }
  public function getMotdepasse(){ return $this->motdepasse; }

  public function setNomUtilisateur($nomutilisateur) { $this->nomutilisateur = $nomutilisateur; }
  public function setMotdepasse($motdepasse) { $this->motdepasse = $motdepasse; }

  public static function establishedConnection()
  {
    $con = DataAccessObject::connexion();
    return $con;
  }

  /** Fonction permettant d'etablir la connexion */
  public static function connect(User $user)
  {
    $message = '';
    $userconnect = false;
    $lstUser = array();
    $con = self::establishedConnection();
    try {
      $query = "select * from utilisateur where nomutilisateur = '".strtolower($user->getNomUtilisateur())."' AND motdepasse = '".strtolower($user->getMotdepasse())."'";
      $requete = $con->query($query, PDO::FETCH_ASSOC);
      foreach ($requete as $key => $req) {
        $lstUser[$key] = $req;
      }
      if(count($lstUser) > 0) {
        $userconnect = true;
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $userconnect;
  }



  
}