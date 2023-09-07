<?php declare(strict_types=1);

use Blog\Controller\Article\ArticleController;

require_once('./includes/headcustom.php');
?>
<section class="description-article">
  <div class="description-article-header">
    <div class="description-article-header-img">
      <p>
        <img src="<?= $listArticle[0]["imageArticle"] ?>" alt="">
      </p>
      <h1 class="description-article-header-titre"><?= $listArticle[0]["titreArticle"] ?></h1>
      <div class="description-article-header-date-publication">
        <span>
              Publi&eacute; le <?= ArticleController::convertDate($listArticle[0]["datepubArticle"],'j F Y') ?>
        </span>
      </div>
    </div>
  </div>
  <div class="description-article-details">
    <p>
    <?= $listArticle[0]["descriptionArticle"] ?>
    </p>
    <div>
      <strong>
              Cat&eacute;gorie : <?= ArticleController::nomCategorie((int) $listArticle[0]["idCategories"]) ?>
      </strong>
    </div>
    <div class="descriptionArticle-liste-commentaire"></div>
    <div class="description-article-commentaires-message"></div>
    <form action="" class="description-article-commentaires">
      <legend>Qu'en pensez-vous ?</legend>
      <div class="description-article-commentaires-input-control">
       <input type="text" placeholder="pseudo">
      </div>
      <div class="description-article-commentaires-input-control">
        <textarea name="" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="Envoyer">
      </div>
    </form>
  </div>
</section>
<?php 
require_once('./includes/footer.php');
?>