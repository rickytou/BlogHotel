<?php use Blog\Controller\Article\ArticleController; ?>
<form action="#" id="updateModifierArticle">
  <legend>Modifier votre article</legend>
  <div class="updateModifierArticle"></div>
    <div class="ajouter-article-input-control">
      <label for="updatenomArticle">Titre de l'article</label>
      <input type="text" id="updatenomArticle" value="<?= $viewArticle[0]['titreArticle']; ?>">
    </div>
    <div class="ajouter-article-input-control">
      <label for="updatedescriptionArticle">Description</label>
      <textarea id="updatedescriptionArticle"><?= trim($viewArticle[0]['descriptionArticle']); ?></textarea>
    </div>
    <div class="ajouter-article-input-control">
        <label for="idCategorieArticle">Cat&eacute;gorie</label>
        <select name="idCategorieArticle" class="idCategorieArticle">
          <?php foreach($allCategories as $categories) : ?>
            <option value="<?= $categories['idCategorie'] ?>"
            <?php if((int) $viewArticle[0]['idCategories'] == (int) $categories["idCategorie"]) { echo "selected='selected'"; } ?>
            >
              <?= $categories["nomCategorie"] ?> 
            </option>
            <?php endforeach; ?>
        </select>
      </div>
    <div class="ajouter-article-input-control">
      <label for="uploadimage">Image</label>
      <input type="file" id="uploadimage" name="uploadimage">
    </div>
    <div class="ajouter-article-input-control">
      <label for="actif">Statut</label>
      <select name="actif" id="actif">
        <option value="0" <?php if ($viewArticle[0]['actif'] == 0) {
          echo 'selected=selected';
        } ?>>D&eacute;sactiv&eacute;
        </option>
        <option value="1" <?php if ($viewArticle[0]['actif'] == 1) {
          echo 'selected=selected';
        } ?>>Activ&eacute;</option>
      </select>
    </div>
    <input type="hidden" name="updateidArticle" id="updateidArticle" value="<?= $viewArticle[0]['idArticle']; ?>">
    <input type="submit" value="Modifier">
    <span class="fa-solid fa-close closeModifierArticle"></span>

</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
  integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../../public/js/scriptVues.js"></script>