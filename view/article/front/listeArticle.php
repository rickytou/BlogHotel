      <!-- Entete Posts Bloc -->
      <div class="recent-posts-group">
        <!-- Bloc .-->
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

            </div>
          </article>
        <?php endforeach; ?>
        <!-- Fin Bloc -->
        <!-- <div class="moreArticles"></div> -->
      </div>