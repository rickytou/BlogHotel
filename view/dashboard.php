<?php 
use Blog\Controller\Article\ArticleController;
use Blog\Controller\Categorie\CategorieController;
use Blog\Model\Categorie\Categorie;

require_once('./includes/headdashboard.php');
$nombre_de_categories = count($allCategories);
$nombre_articles = count($listArticles);
?>
  <main id="main">
    <div class="main">
      <!-- Entete -->
    <header>
        <h1>Tableau de board</h1>
        <div class="header-bloc">
          <!-- header-bloc-group-1 -->
          <div class="header-bloc-group header-bloc-group-1 active">
            <span class="fa-regular fa-newspaper"></span>
            <strong>Article</strong>
            <p>
              <b><?= $nombre_articles ?></b><span>posts</span>
            </p>
            
            <p class="header-bloc-group-actions">
            <span class="fa-regular fa-eye viewListArticle active" title="Liste article"></span>
            <span class="fa-solid fa-circle-plus addArticleBlog" title="ajouter article"></span>
            </p>
          </div>
          <!-- Fin -->
          <!-- header-bloc-group-2 -->
          <div class="header-bloc-group header-bloc-group-2">
          <span class="fa-solid fa-layer-group"></span>
            <strong>Cat&eacute;gories</strong>
            <p>
              <b><?= $nombre_de_categories ?></b><span>cat&eacute;gories</span>
            </p>
            <p class="header-bloc-group-actions">
            <span class="fa-regular fa-eye viewListCategorie" title="Liste cat&eacute;gorie"></span>
            <span class="fa-solid fa-circle-plus addCategorieBlog" title="ajouter cat&eacute;gorie"></span>
            </p>
          </div>
          <!-- Fin -->
          <!-- header-bloc-group-3 -->
          <div class="header-bloc-group header-bloc-group-3">
          <span class="fa-solid fa-comments"></span>
            <strong>Commentaires</strong>
            <p>
              <b><?php echo count($listCommentaire); ?></b><span> comments</span>
            </p>
            <p class="header-bloc-group-actions">
            <span class="fa-regular fa-eye viewListCommentaire" title="List commentaire"></span>
            <!-- <span class="fa-solid fa-circle-plus"></span> -->
            </p>
          </div>
          <!-- Fin -->
          <!-- header-bloc-group-4 -->
          <div class="header-bloc-group header-bloc-group-4">
          <span class="fa-solid fa-message"></span>
            <strong>T&eacute;moignages</strong>
            <p>
              <b>15</b><span> avis</span>  
            </p>
            <p class="header-bloc-group-actions">
            <span class="fa-regular fa-eye"></span>
            <span class="fa-solid fa-circle-plus"></span>
            </p>
          </div>
          <!-- Fin -->
          
        </div>
    </header>
    <!-- Fin Entete -->
    <section id="list">
      <div class="list-group">
        <?php if(count($listArticles) > 0) : ?>
        <h2>Liste d'articles</h2>
        <div class="afficher--message"></div>
        <table class="list-group-table">
        <thead>
            <tr>
              <th class="list-group-table-check">&nbsp;</th>
              <th class="list-group-table-img">&nbsp</th>
              <th class="list-group-table-img">Identifiant</th>
              <th>Titre</th>
              <th>Cat&eacute;gorie</th>
              <th>Date Publication</th>
              <th>Statut</th>
              <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach($listArticles as $article) : ?>
          <tr>
            <td class="list-group-table-check"><input type="checkbox" name="article[]"></td>
            <td class="list-group-table-img"><p><img src="<?= $article["imageArticle"]; ?>" /></p></td>
            <td><?= $article["idArticle"] ?></td>
            <td><?= $article["titreArticle"] ?></td>
            <td><?php echo ArticleController::nomCategorie($article["idCategories"]); ?></td>
            <td><?= ArticleController::convertDate($article["datepubArticle"], 'j F Y') ?></td>
            <td class="list-group-table-check"><?= ($article['actif'] == 1) ? 'Activ&eacute;' : 'd&eacute;sactiv&eacute;' ?></td>
          <td class="list-group-table-actions">
            <!-- Actions -->
            <p class="actions">
              <a href='./index.php?controller=article&action=viewArticle&idArticle=<?= $article["idArticle"] ?>' class="fa-solid fa-pencil viewArticle" title="modifier"></a> 

              <a href='./index.php?controller=article&action=deleteArticle&idArticle=<?= $article["idArticle"] ?>' class="fa-regular fa-trash-can deleteArticle" title="supprim&eacute;"></a>
            <a href='./index.php?controller=article&action=<?= ($article['actif'] == 1) ? 'desactivatedArticle' : 'activatedArticle' ?>&idArticle=<?= $article["idArticle"] ?>&actif=<?= $article["actif"] ?>' title="<?= ($article['actif'] == 1) ? 'd&eacute;sactiv&eacute;' : 'activ&eacute;' ?>" class="fa-solid <?= ($article['actif'] == 1) ? 'fa-toggle-off' : 'fa-toggle-on' ?> <?= ($article['actif'] == 1) ? 'desactivatedArticle' : 'activatedArticle' ?>"></a>
            </p>
          </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot class="list-group-table-foot">
        <tr>
          <td colspan="5">
            <p>
                <input type="checkbox" name="articles[]" id="allChecked">
                <label for="allChecked">Tout cocher</label>            
            </p>
            <p>
            <a href="#" class="fa-regular fa-trash-can"></a>
            <a href="./index.php?controller=article&action=deleteArticle" class="deleteAllArticles">Tout supprimer</a>
            </p>
          </td>
        </tr>
       </tfoot>
        </table>
        <?php else: ?>
          <p class="message--erreur">Liste vide, veuillez en ajouter un article</p>
        <?php endif; ?>
      </div>
    </section>


    <footer id="footer">
      <div class="footer">
        <div class="footer-copyright">
          <p>
            <span>BlogHotel2023&copy;Tous droits r&eacute;serv&eacute;s</span>
          </p>
          <p class="designer">
            Conception : <span>Ricardo Samedi</span>
          </p>
        </div>
      </div>
    </footer>    
    </div>
    <p class="loadingprofil">
      <img src="./public/images/load.gif" alt="loading">
    </p>
  </main>  
   <!-- Ajouter Article -->
  <div id="article">
    <div class="article-popup">
    <form action="#" class="ajouter" method="POST" id="form-ajouter-article" enctype="multipart/form-data">
      <legend>Ajouter un article</legend>
      <div class="ajouter-article-message"></div>
      <div class="ajouter-article-input-control">
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre">
      </div>
      <div class="ajouter-article-input-control">
        <label for="idCategorieArticle">Cat&eacute;gorie</label>
        <select name="idCategorieArticle" id="idCategorieArticle">
          <?php foreach($allCategoriesActived as $categorie) : ?>
          <option value="<?= $categorie['idCategorie'] ?>">
            <?= $categorie['nomCategorie'] ?>
          </option>
          <?php endforeach; ?>
        </select>
      <!-- </div> -->
        <div class="ajouter-article-input-control">
        <label for="uploadimage">Telecharger une image</label>
        <input type="file" name="uploadimage" id="uploadimage">
      </div>
      </div>
      <div class="ajouter-article-input-control">
        <label for="desc">Description</label>
        <textarea name="description" id="desc"></textarea>
      </div>
      <input type="submit" value="Ajouter">
      <span class="fa-solid fa-close closeArticle"></span>
    </form>
    </div>
  </div>
  <!-- Fin Ajouter Article -->
  <!-- Ajouter Categorie -->
  <div id="categorie">
    <div class="categorie-popup">
    <form action="#" class="ajouter" method="POST" id="form-ajouter-categorie">
      <legend>Ajouter une cat&eacute;gorie</legend>
      <div class="ajouter-categorie-message"></div>
      <div class="ajouter-article-input-control">
        <label for="nomCategorie">Nom de la cat&eacute;gorie</label>
        <input type="text" name="nomCategorie" id="nomCategorie">
      </div>
      <div class="ajouter-article-input-control">
        <label for="descriptionCategorie">Description</label>
        <textarea name="descriptionCategorie" id="descriptionCategorie"></textarea>
      </div>
      <input type="submit" value="Ajouter">
      <span class="fa-solid fa-close closeCategorie"></span>
    </form>
    </div>
  </div>
  <!-- Fin Ajouter Categorie -->
  <div class="form-updatecategorie"></div>
  <!-- Form Update Article -->
  <div class="form-updatearticle"></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>



