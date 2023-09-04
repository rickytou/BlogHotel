<?php declare(strict_types=1);
require_once('./includes/headdashboard.php');
$nombre_de_categories = count($allCategories);
?>
  <main id="main">
    <div class="main">
      <!-- Entete -->
    <header>
        <h1>Tableau de board</h1>
        <div class="header-bloc">
          <!-- header-bloc-group-1 -->
          <div class="header-bloc-group header-bloc-group-1">
            <span class="fa-regular fa-newspaper"></span>
            <strong>Article</strong>
            <p>
              <b>20</b><span>views</span>
            </p>
            
            <p class="header-bloc-group-actions">
            <span class="fa-regular fa-eye viewListArticle" title="Liste article"></span>
            <span class="fa-solid fa-circle-plus addArticleBlog" title="ajouter article"></span>
            </p>
          </div>
          <!-- Fin -->
          <!-- header-bloc-group-2 -->
          <div class="header-bloc-group header-bloc-group-2">
          <span class="fa-solid fa-layer-group"></span>
            <strong>Categories</strong>
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
              <b>30</b><span> comments</span>
            </p>
            <p class="header-bloc-group-actions">
            <span class="fa-regular fa-eye"></span>
            <span class="fa-solid fa-circle-plus"></span>
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
        <h2>Liste d'articles</h2>
        <!-- <div class="afficher--message"></div> -->
        <table class="list-group-table">
        <thead>
            <tr>
              <th class="list-group-table-check">&nbsp;</th>
              <th class="list-group-table-img">&nbsp</th>
              <th>ID</th>
              <th>Titre</th>
              <th>Tags</th>
              <th>Categorie</th>
              <th>Publi&eacute</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td class="list-group-table-check"><input type="checkbox" name="article[]"></td>
            <td class="list-group-table-img">&nbsp;</td>
            <td>01</td>
            <td>Hotel berkshire</td>
            <td>Quebec</td>
            <td>Categorie</td>
            <td>Publie</td>
          </tr>
        </tbody>
        </table>
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
      <img src="../public/images/load.gif" alt="loading">
    </p>
  </main>  
   <!-- Ajouter Article -->
  <div id="article">
    <div class="article-popup">
    <form action="#" class="ajouter" method="POST" id="form-ajouter-article">
      <legend>Ajouter un article</legend>
      <div class="ajouter-article-message"></div>
      <div class="ajouter-article-input-control">
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre">
      </div>
      <div class="ajouter-article-input-control">
        <label for="idCategorieArticle">Cat&eacute;gorie</label>
        <select name="idCategorieArticle" id="idCategorieArticle">
          <?php foreach($allCategories as $categorie) : ?>
          <option value="<?= $categorie['idCategorie'] ?>">
            <?= $categorie['nomCategorie'] ?>
          </option>
          <?php endforeach; ?>
        </select>
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
  <!-- Fin Ajouter Categorie -->
  <div id="categorie">
    <div class="categorie-popup">
    <form action="#" class="ajouter" method="POST" id="form-ajouter-categorie" enctype="multipart/form-data">
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
  <!-- Fin -->
  <div class="form-updatecategorie">
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>



