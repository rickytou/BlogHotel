<h2>Liste de cat&eacute;gories</h2>
      <table class="list-group-table">
       <thead>
          <tr>
            <th class="list-group-table-check">&nbsp;</th>
            <th>Identifiant</th>
            <th>Categorie</th>
            <th>Description</th>
          </tr>
       </thead>
       <tbody>
        <?php foreach($listCategories as $lscat) : ?>
        <tr>
          <td class="list-group-table-check"><input type="checkbox" name="Categorie[]"></td>
          <td><?= $lscat['idCategorie'] ?></td>
          <td><?= $lscat['nomCategorie'] ?></td>
          <td><?= $lscat['descriptionCategorie'] ?></td>
        </tr>
        <?php endforeach; ?>
       </tbody>
      </table>