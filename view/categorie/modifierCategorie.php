<form action="#" id="updateModifierCategorie">
  <legend>Modifier votre categorie</legend>
  <div class="updateModifierCategorie"></div>
          <div class="ajouter-article-input-control">
            <label for="updatenomCategorie">Nom categorie</label>
            <input type="text" id="updatenomCategorie" value="<?= $viewCategorie[0]['nomCategorie']; ?>">
          </div>
          <div class="ajouter-article-input-control">
            <label for="updatedescriptionCategorie">Description</label>
            <input type="text" id="updatedescriptionCategorie" value="<?= trim($viewCategorie[0]['descriptionCategorie']); ?>">
          </div>
          <div class="ajouter-article-input-control">
            <label for="actif">Statut</label>
           <select name="actif" id="actif">
             <option value="0" <?php if($viewCategorie[0]['actif'] == 0) { echo 'selected=selected'; } ?>>D&eacute;sactiv&eacute;</option>
             <option value="1" <?php if($viewCategorie[0]['actif'] == 1) { echo 'selected=selected'; } ?>>Activ&eacute;</option>
           </select>
          </div>
          <input type="hidden" name="updateidCategorie" id="updateidCategorie" value="<?= $viewCategorie[0]['idCategorie']; ?>">
          <input type="submit" value="Modifier">
          <span class="fa-solid fa-close closeModifierCategorie"></span>
        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="../../public/js/scriptVues.js"></script>