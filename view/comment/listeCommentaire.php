<h2>Liste de commentaires</h2>
<div class="afficher--message">
  <?= (isset($update) && !empty($update)) ? $update : '' ?>
</div>
<?php if(isset($message) && !empty($message) && count($listeCommentaires) > 0){ echo $message; } ?>
<?php if(isset($message) && !empty($message) && count($listeCommentaires) == 0){ 
  echo '<p class="message--succes">Cat&eacute;gorie supprim&eacute;e avec succ&egrave;s, liste vide actuellement</p>';
 }else{ ?>
      <table class="list-group-table">
       <thead>
          <tr>
            <th class="list-group-table-check">&nbsp;</th>
            <th>Identifiant</th>
            <th>Description</th>
            <th>Statut</th>
            <th></th>
          </tr>
       </thead>
       <tbody>
        <?php foreach($listeCommentaires as $lscomment) : ?>
        <tr>
          <td class="list-group-table-check"><input type="checkbox" name="Commentaire[]"></td>
          <td class="list-group-table-actions"><?= $lscomment['idCommentaire'] ?></td>
          <td><?= $lscomment['descriptionCommentaire'] ?></td>
          <td class="list-group-table-check"><?= ($lscomment['statut'] == 1) ? 'Activ&eacute;' : 'd&eacute;sactiv&eacute;' ?></td>
          <td class="list-group-table-actions">
            <!-- Actions -->
            <p class="actions">
              <a href='./index.php?controller=comment&action=deleteComment&idCommentaire=<?= $lscomment["idCommentaire"] ?>' class="fa-regular fa-trash-can deleteComment" title="supprim&eacute;"></a>
              <a href='./index.php?controller=comment&action=<?= ($lscomment['statut'] == 1) ? 'desactivatedComment' : 'activatedComment' ?>&idCommentaire=<?= $lscomment["idCommentaire"] ?>&actif=<?= $lscomment["statut"] ?>' title="<?= ($lscomment['statut'] == 1) ? 'd&eacute;sactiv&eacute;' : 'activ&eacute;' ?>" class="fa-solid <?= ($lscomment['statut'] == 1) ? 'fa-toggle-off' : 'fa-toggle-on' ?> <?= ($lscomment['statut'] == 1) ? 'desactivatedComment' : 'activatedComment' ?>"></a>
            </p>
          </td>
        </tr>
        <?php endforeach; ?>
       </tbody>
       <tfoot class="list-group-table-foot">
        <tr>
          <td colspan="5">
            <p>
                <input type="checkbox" name="commentaires[]" id="allChecked">
                <label for="allChecked">Tout cocher</label>            
            </p>
            <p>
            <a href="#" class="fa-regular fa-trash-can"></a>
            <a href="./index.php?controller=comment&action=deleteComment" class="deleteAllComments">Tout supprimer</a>
            </p>
          </td>
        </tr>
       </tfoot>
      </table>
      <?php } ?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="./public/js/scriptVues.js"></script>