<?php declare(strict_types=1);
/** Espace de nom */
namespace Blog\Auteur;
/** Classe Auteur */
class Auteur{
  /** 
   * @var int $auteurID : Identifiant de l'auteur 
  */
  private int $auteurID;
  /**
   * @var string $nomAuteur : Nom de l'auteur
   */
  private string $nomAuteur;
  /**
   * @var string $motdepasseAuteur : Mot de passe de l'auteur
   */
  private string $motdepasseAuteur;
  /**
   * @var string $courriel : Adresse courriel de l'auteur
   */
  private string $courriel;
  /**
   * @var string $photoAuteur : Photo profil de l'auteur
   */
  private string $photoAuteur;
}




?>