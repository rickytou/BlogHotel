 <!-- Entete Posts Bloc -->
 <div class="recent-posts-group">
        <!-- Bloc1 .-->
        <?php foreach ($listArticles as $articles): ?>
          <article class="recent-posts-bloc">
            <!-- Entete Posts Bloc Entete -->
            <div class="recent-posts-image">
              <a href='./index.php?controller=article&action=description&idArticle=<?= $articles["idArticle"] ?>'>
              <img src="<?= $articles["imageArticle"] ?>" alt='<?= $articles["titreArticle"] ?>'>
              </a>
            </div>
            <!-- Entete Posts Main -->
            <div class="recent-posts-main">
              <div class="recent-posts-title">
                <strong>
                <a href='./index.php?controller=article&action=description&idArticle=<?= $articles["idArticle"] ?>'>  
                <?= self::substringName($articles["titreArticle"],40) ?>
                </a>
                </strong>
              </div>
              <p>
                <?= self::substringName($articles["descriptionArticle"],160) ?>
              </p>
              <p class="recent-posts-article-categories">
                <!-- <span class="recent-posts-article-nomcategories">Cat&eacute;gorie : </span> -->
                <span>:: <?= self::nomCategorie($articles["idCategories"]) ?></span>
              </p>
            </div>
          </article>
        <?php endforeach; ?>
        <!-- Fin Bloc1 -->

      </div>