<?php declare(strict_types=1);
require_once('./includes/head.php');
?>
<main id="main">
  <div class="main">
    <!-- Header -->
    <div class="video">
      <video autoplay="autoplay" muted="" loop="infinite" src="./public/videos/video.mp4"></video>
      <div class="mainheader">
        <form action="#" class="form-search">
          <div class="input-control">
            <input type="search" name="" id="" placeholder="Trouver un h&ocirc;tel...">
            <p>
              <span class="fa-solid fa-magnifying-glass"></span>
            </p>
          </div>

        </form>
        <h1>
          D&eacute;couvrez les meilleurs
          <span>H&ocirc;tels du Qu&eacute;bec</span>
        </h1>
        <p class="text-accroche">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi commodi ea quod incidunt, voluptas tenetur
          reprehenderit sequi dicta at officiis?
          <a href="#blog" class="fa-solid fa-chevron-down"></a>
        </p>

      </div>
    </div>
    <!-- Fin Header -->
    <!-- Nos recentes publications -->
    <div class="recent-posts" id="blog">
      <h2>Nos r&eacute;centes publications</h2>
      <div class="recent-posts-filtre">
        <p class="recent-posts-filtre-title">
          Filtrer par cat&eacute;gorie <span class="fa-solid fa-chevron-right"></span>
        </p>
        <div class="recent-posts-filtre-categorie-group">
          <p class="recent-posts-filtre-categorie active">
            <span class="recent-posts-filtre-categorie-name">Toutes les cat&eacute;gories (
              <?php echo self::countArticle() ?>)
            </span>
            <a href="index.php?controller=article&action=filter" class="fa-solid fa-toggle-on filter-categorie"></a>
          </p>
          <?php foreach ($listCategories as $categorie): ?>
            <p class="recent-posts-filtre-categorie">
              <span class="recent-posts-filtre-categorie-name">
                <?= $categorie["nomCategorie"] ?>
                (
                <?php echo self::countArticle((int) $categorie['idCategorie']) ?>)
              </span>
              <a href="index.php?controller=article&action=filter&idCategorie=<?= $categorie['idCategorie'] ?>"
                class="fa-solid fa-toggle-off filter-categorie"></a>
            </p>
          <?php endforeach; ?>
        </div>
      </div>
      <!-- Fin Filtre -->
      <!-- Affichage de 8 article s au maximum -->
      <div class="recent-posts-info">
        <p>Affichage de 8 articles au maximum</p>
      </div>

      <!-- Entete Posts Bloc -->
      <div class="recent-posts-group">
        <!-- Bloc1 .-->
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
      <p class="loadingprofil">
      <img src="../public/images/load.gif" alt="loading">
    </p>
    </div>
    <!-- Fin -->
    <!-- Temoignages -->
    <!-- Section Temoignages Wrapper -->
    <section id="temoignages">
      <div class="temoignages">
        <!-- Titre de la section -->
        <h2>
          Ce que disent <span>nos visiteurs ?</span>
        </h2>
        <!-- Temoignages [Zone de navigation] -->
        <div class="temoignages__navigation__bloc">
          <p class="temoignages__navigation temoignages__navigation__left">
            <i class="fa-solid fa-arrow-left"></i>
          </p>
          <p class="temoignages__navigation temoignages__navigation__right active">
            <i class="fa-solid fa-arrow-right"></i>
          </p>

        </div>
        <!-- Bloc de temoignages -->
        <div class="temoignages__bloc">
          <!-- Temoignages comments [Temoignages1] -->
          <div class="temoignages__bloc__group active">
            <div class="temoignages__bloc__comments">
              <div class="temoignages__bloc__comments_user">
                <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                  <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                  </p>
                  <i class="fa-solid fa-quote-right"></i>
                  <cite>
                    <span>John Doe</span>
                  </cite>
                </blockquote>
              </div>
            </div>
            <!-- Temoignages bloc design -->
            <div class="temoignages__bloc__design"></div>
            <!-- Temoignages profil de l'utilisateur -->
            <div class="temoignages__bloc__profil">
              <img src="./public/images/avatar.png" alt="avatar" />
            </div>
          </div>
          <!-- Fin -->

          <!-- Temoignages comments [Temoignages2] -->
          <div class="temoignages__bloc__group">
            <div class="temoignages__bloc__comments">
              <div class="temoignages__bloc__comments_user">
                <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                  <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                  </p>
                  <i class="fa-solid fa-quote-right"></i>
                  <cite>
                    <span>Johnny Doe</span>
                  </cite>
                </blockquote>
              </div>
            </div>
            <!-- Temoignages bloc design -->
            <div class="temoignages__bloc__design"></div>
            <!-- Temoignages profil de l'utilisateur -->
            <div class="temoignages__bloc__profil">
              <img src="./public/images/avatar.png" alt="avatar" />
            </div>
          </div>
          <!-- Fin -->

          <!-- Temoignages comments [Temoignages3] -->
          <div class="temoignages__bloc__group">
            <div class="temoignages__bloc__comments">
              <div class="temoignages__bloc__comments_user">
                <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                  <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                  </p>
                  <i class="fa-solid fa-quote-right"></i>
                  <cite>
                    <span>Jane Doe</span>
                  </cite>
                </blockquote>
              </div>
            </div>
            <!-- Temoignages bloc design -->
            <div class="temoignages__bloc__design"></div>
            <!-- Temoignages profil de l'utilisateur -->
            <div class="temoignages__bloc__profil">
              <img src="./public/images/avatar.png" alt="avatar" />
            </div>
          </div>
          <!-- Fin -->

          <!-- Temoignages comments [Temoignages4] -->
          <div class="temoignages__bloc__group">
            <div class="temoignages__bloc__comments">
              <div class="temoignages__bloc__comments_user">
                <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                  <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                  </p>
                  <i class="fa-solid fa-quote-right"></i>
                  <cite>
                    <span>Spence Doe</span>
                  </cite>
                </blockquote>
              </div>
            </div>
            <!-- Temoignages bloc design -->
            <div class="temoignages__bloc__design"></div>
            <!-- Temoignages profil de l'utilisateur -->
            <div class="temoignages__bloc__profil">
              <img src="./public/images/avatar.png" alt="avatar" />
            </div>
          </div>
          <!-- Fin -->

          <!-- Temoignages comments [Temoignages5] -->
          <div class="temoignages__bloc__group">
            <div class="temoignages__bloc__comments">
              <div class="temoignages__bloc__comments_user">
                <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                  <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                  </p>
                  <i class="fa-solid fa-quote-right"></i>
                  <cite>
                    <span>Steeve Doe</span>
                  </cite>
                </blockquote>
              </div>
            </div>
            <!-- Temoignages bloc design -->
            <div class="temoignages__bloc__design"></div>
            <!-- Temoignages profil de l'utilisateur -->
            <div class="temoignages__bloc__profil">
              <img src="./public/images/avatar.png" alt="avatar" />
            </div>
          </div>
          <!-- Fin -->

          <!-- Temoignages comments [Temoignages6] -->
          <div class="temoignages__bloc__group">
            <div class="temoignages__bloc__comments">
              <div class="temoignages__bloc__comments_user">
                <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                  <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                  </p>
                  <i class="fa-solid fa-quote-right"></i>
                  <cite>
                    <span>Bryan Doe</span>
                  </cite>
                </blockquote>
              </div>
            </div>
            <!-- Temoignages bloc design -->
            <div class="temoignages__bloc__design"></div>
            <!-- Temoignages profil de l'utilisateur -->
            <div class="temoignages__bloc__profil">
              <img src="./public/images/avatar.png" alt="avatar" />
            </div>
          </div>
          <!-- Fin -->

          <!-- Temoignages comments [Temoignages7] -->
          <div class="temoignages__bloc__group">
            <div class="temoignages__bloc__comments">
              <div class="temoignages__bloc__comments_user">
                <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                  <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                  </p>
                  <i class="fa-solid fa-quote-right"></i>
                  <cite>
                    <span>Jack Doe</span>
                  </cite>
                </blockquote>
              </div>
            </div>
            <!-- Temoignages bloc design -->
            <div class="temoignages__bloc__design"></div>
            <!-- Temoignages profil de l'utilisateur -->
            <div class="temoignages__bloc__profil">
              <img src="./public/images/avatar.png" alt="avatar" />
            </div>
          </div>
          <!-- Fin -->

          <!-- Temoignages comments [Temoignages8] -->
          <div class="temoignages__bloc__group">
            <div class="temoignages__bloc__comments">
              <div class="temoignages__bloc__comments_user">
                <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                  <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                  </p>
                  <i class="fa-solid fa-quote-right"></i>
                  <cite>
                    <span>Pitt Doe</span>
                  </cite>
                </blockquote>
              </div>
            </div>
            <!-- Temoignages bloc design -->
            <div class="temoignages__bloc__design"></div>
            <!-- Temoignages profil de l'utilisateur -->
            <div class="temoignages__bloc__profil">
              <img src="./public/images/avatar.png" alt="avatar" />
            </div>
          </div>
          <!-- Fin -->
          <!-- Fin Temoignages -->
        </div>
    </section>
    <section id="contact">
      <div class="contact">
        <h2>Comment nous trouver ?</h2>
        <div class="contact-social-media">
          <div class="contact-social-media-bloc">
            <span class="fa-solid fa-phone"></span>
            <p>
              <b>Telephone</b>
              <span>Appelez:+00-11-22-33-44</span>
            </p>
          </div>
          <div class="contact-social-media-bloc">
            <span class="fa-regular fa-envelope"></span>
            <p>
              <b>Courriel</b>
              <span>bloghotel@gbloghotel.ca</span>
            </p>
          </div>
          <div class="contact-social-media-bloc">
            <span class="fa-brands fa-facebook-f"></span>
            <p>
              <b>Facebook</b>
              <span>Page compagnie</span>
            </p>
          </div>
        </div>
      </div>
    </section>
</main>
<?php require_once('./includes/footer.php');
use Blog\Controller\Article\ArticleController;