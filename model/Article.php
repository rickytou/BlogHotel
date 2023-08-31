<?php declare(strict_types = 1);
/** Creation de namespace article */
namespace Blog\Model\Article;
  class Article{
    /**
     * Declaration des proprietes de la classe Article
     */
    /**
     * @var string $titre : Titre de l'article
     */
    private string $titre;
    /**
     * @var string $image : Image de l'article
     */
    private string $image;
    /**
     * @var array $categories: Liste d'article
     */
    private array $categories;
    /**
     * @var string contenu : Description de l'article
     */
    private string $contenu;

  }


?>