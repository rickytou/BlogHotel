<?php declare(strict_types=1);
namespace Blog\Controller\User;

use Blog\Model\Categorie\Categorie;


class UserController{
  public static function index(){
    $allCategories = Categorie::listCategorie();
    require_once('./view/dashboard.php');
  }
}
?>