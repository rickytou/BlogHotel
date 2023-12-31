<?php declare(strict_types=1);

use Blog\Controller\Article\ArticleController;
if(!isset($listArticle[0])){
  header('Location: ./index.php');
}
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
    <div class="description-article-details-categorie">
      <strong>
              Cat&eacute;gorie : <?= ArticleController::nomCategorie((int) $listArticle[0]["idCategories"]) ?>
      </strong>
    </div>
    <div class="descriptionArticle-liste-commentaire">
      <!-- Commentaire -->
      <?php
      if(isset($listeCommentaires) && (count($listeCommentaires) > 0)) : ?>        
      <?php foreach($listeCommentaires as $comment) : ?>
      <div class="descriptionArticle-liste-commentaire-group">
        <div class="descriptionArticle-liste-commentaire-description">
          <?= $comment["descriptionCommentaire"] ?>
        </div>
        <div class="descriptionArticle-liste-commentaire-title">
          <p>
            <img src="./public/images/avatar.png" alt="icon user commentaires">
          </p>
          <span>Anonyme</span>
        </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>
      <!-- Fin Commentaire -->
    </div>
    <form action="./index.php?controller=comment&action=addComment" class="description-article-commentaires">
      <div class="description-article-commentaires-message"></div>
      <legend>Qu'en pensez-vous ?</legend>
      <div class="description-article-commentaires-input-control">
        <textarea name="descriptioncommentaire" id="descriptioncommentaire" placeholder="Entrez votre commentaire"></textarea>
        <p>
          <label>Max.: 300 caract&egrave;res</label>
        </p>
      </div>
      <div class="description-article-commentaires-input-control">
        <input type="hidden" name="idArticle" id="idArticle" value="<?= $listArticle[0]["idArticle"] ?>">
        <input type="submit" value="Envoyer">
      </div>
      <p class="loadingprofil">
      <img src="./public/images/load.gif" alt="loading">
    </p>
    </form>
  </div>
</section>
<?php 
require_once('./includes/footer.php');
?>