<?php declare(strict_types=1);
class DataAccessObject{
  private const DNS = 'mysql:host=localhost;dbname=bloghotel';
  private const USER = 'root';
  private const PASS = '';

/** Connexion au serveur MySql */
public static function connexion(){
  try{
    $con = new PDO(self::DNS,self::USER,self::PASS);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $con;
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return null;
}

}

?>