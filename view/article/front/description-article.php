<?php declare(strict_types=1);

use Blog\Controller\Article\ArticleController;

require_once('./includes/head.php');
?>
<section class="description-article">
  <div class="description-article-header">
    <div class="description-article-header-img">
      <p>
        <img src="<?= $listArticle[0]["imageArticle"] ?>" alt="">
      </p>
      <h1 class="description-article-header-titre"><?= $listArticle[0]["titreArticle"] ?></h1>
    </div>
  </div>
  <div class="description-article-details">
    <div>
      <span>Publi&eacute; le <?= ArticleController::convertDate($listArticle[0]["datepubArticle"],'j F Y') ?></span>
      <strong>Cat&eacute;gorie : <?= ArticleController::nomCategorie((int) $listArticle[0]["idCategories"]) ?></strong>
</div>
    <p>
    <?= $listArticle[0]["descriptionArticle"] ?>
    </p>
  </div>
</section>
<?php 
require_once('./includes/footer.php');
?>