 <!-- Entete Posts Bloc -->
 <div class="recent-posts-group">        <!-- Bloc1 .-->
        <?php foreach ($listArticles as $articles): ?>
          <article class="recent-posts-bloc">
            <!-- Entete Posts Bloc Entete -->
            <div class="recent-posts-image">
              <img src="<?= $articles["imageArticle"] ?>" alt='<= $articles["titreArticle"] ?>'>
            </div>
            <!-- Entete Posts Main -->
            <div class="recent-posts-main">
              <div class="recent-posts-title">
                <strong>
                  <?= $articles["titreArticle"] ?>
                </strong>
              </div>
              <p>
                <?= $articles["descriptionArticle"] ?>
              </p>
            </div>
          </article>
        <?php endforeach; ?>
        <!-- Fin Bloc1 -->

      </div>