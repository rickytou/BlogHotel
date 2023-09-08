<?php declare(strict_types=1);
namespace Blog\Model\User;
class User{
  private const STATUT = 1;
  public function __construct(private string $nomutilisateur, private string $motdepasse,){
    $this->nomutilisateur = $nomutilisateur;
    $this->$motdepasse = $motdepasse;
  }
  
}