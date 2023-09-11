<?php declare(strict_types=1);
class DataAccessObject{
  private const DNS = 'mysql:host=sql207.infinityfree.com;dbname=if0_35006902_bloghotel';
  private const USER = 'if0_35006902';
  private const PASS = 'aySYaH79eC';

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