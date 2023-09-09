<?php use Blog\Controller\Article\ArticleController; ?>
<h2>Liste d'articles</h2>
<div class="afficher--message">
  <?= (isset($update) && !empty($update)) ? $update : '' ?>
</div>
<?php if(isset($message) && !empty($message) && count($listArticles) > 0){ echo $message; } ?>
<?php if(isset($message) && !empty($message) && count($listArticles) == 0){ 
  echo '<p class="message--succes">Article supprim&eacute; avec succ&egrave;s, liste vide actuellement</p>';
 }else{ ?>
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
            <a href='../index.php?controller=article&action=viewArticle&idArticle=<?= $article["idArticle"] ?>' class="fa-solid fa-pencil viewArticle" title="modifier"></a> 

            <a href='../index.php?controller=article&action=deleteArticle&idArticle=<?= $article["idArticle"] ?>' class="fa-regular fa-trash-can deleteArticle" title="supprim&eacute;"></a>
            <a href='../index.php?controller=article&action=<?= ($article['actif'] == 1) ? 'desactivatedArticle' : 'activatedArticle' ?>&idArticle=<?= $article["idArticle"] ?>&actif=<?= $article["actif"] ?>' title="<?= ($article['actif'] == 1) ? 'd&eacute;sactiv&eacute;' : 'activ&eacute;' ?>" class="fa-solid <?= ($article['actif'] == 1) ? 'fa-toggle-off' : 'fa-toggle-on' ?> <?= ($article['actif'] == 1) ? 'desactivatedArticle' : 'activatedArticle' ?>"></a>
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
            <a href="../index.php?controller=article&action=deleteArticle" class="deleteAllArticles">Tout supprimer</a>
            </p>
          </td>
        </tr>
       </tfoot>
        </table>
        <?php } ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="../../public/js/scriptVues.js"></script>