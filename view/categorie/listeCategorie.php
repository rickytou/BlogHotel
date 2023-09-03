<h2>Liste de cat&eacute;gories</h2>
<div class="afficher--message"></div>
<?php if(isset($message) && !empty($message) && count($listCategories) > 0){ echo $message; } ?>
<?php if(isset($message) && !empty($message) && count($listCategories) == 0){ 
  echo '<p class="message--succes">Cat&eacute;gorie supprim&eacute;e avec succ&egrave;s, liste vide actuellement</p>';
 }else{ ?>
      <table class="list-group-table">
       <thead>
          <tr>
            <th class="list-group-table-check">&nbsp;</th>
            <th>Identifiant</th>
            <th>Categorie</th>
            <th>Description</th>
            <th>Statut</th>
            <th></th>
          </tr>
       </thead>
       <tbody>
        <?php foreach($listCategories as $lscat) : ?>
        <tr>
          <td class="list-group-table-check"><input type="checkbox" name="Categorie[]"></td>
          <td class="list-group-table-actions"><?= $lscat['idCategorie'] ?></td>
          <td><?= $lscat['nomCategorie'] ?></td>
          <td><?= $lscat['descriptionCategorie'] ?></td>
          <td class="list-group-table-check"><?= ($lscat['actif'] == 1) ? 'Activ&eacute;' : 'd&eacute;sactiv&eacute;' ?></td>
          <td class="list-group-table-actions">
            <!-- Actions -->
            <p class="actions">
              <a href='../index.php?controller=categorie&action=viewCategorie&idCategorie=<?= $lscat["idCategorie"] ?>' class="fa-solid fa-pencil viewCategorie" title="modifier"></a> 
              <a href='../index.php?controller=categorie&action=deleteCategorie&idCategorie=<?= $lscat["idCategorie"] ?>' class="fa-regular fa-trash-can deleteCategorie" title="supprim&eacute;"></a>
              <a href='../index.php?controller=categorie&action=viewCategorie&idCategorie=<?= $lscat["idCategorie"] ?>' title="d&eacute;sactiv&eacute;" class="fa-solid fa-toggle-off"></a>
            </p>
          </td>
        </tr>
        <?php endforeach; ?>
       </tbody>
       <tfoot class="list-group-table-foot">
        <tr>
          <td colspan="5">
            <p>
                <input type="checkbox" name="categories[]" id="allChecked">
                <label for="allChecked">Tout cocher</label>            
            </p>
            <p>
            <a href="#" class="fa-regular fa-trash-can"></a>
            <a href="../index.php?controller=categorie&action=deleteCategorie" class="deleteAllCategories">Tout supprimer</a>
            </p>
          </td>
        </tr>
       </tfoot>
      </table>
      <?php } ?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="../../public/js/scriptVues.js"></script>