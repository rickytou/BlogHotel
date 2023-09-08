<?php declare(strict_types=1);
if(isset($_SESSION["nomutilisateur"])){
  header('Location:./index.php?controller=user&action=connectEstablished');
} 
require_once('./includes/headcustom.php');
?>
<section id="connexion">
  <div class="connexion-bloc">
    <div class="connexion-bloc-app">
      <h2>Application de blog hotel</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae aspernatur minus quis molestiae accusantium libero fugit officia nobis quia culpa, dolores dolorum dicta iure aliquid nemo expedita doloribus a et ratione sint repellendus! Ipsam accusamus quidem eos nemo adipisci nesciunt incidunt accusantium magni? Earum dignissimos quis porro quam ipsa aliquid!</p>
    </div>
    <form action="./index.php?controller=user&action=connect" method="POST" class="form-connexion">
    <div class="connexion-input-control connexion-message"></div>
      <div class="connexion-input-control">
        <input type="text" placeholder="nom utilisateur" id="nomutilisateur" name="nomutilisateur">
      </div>
      <div class="connexion-input-control">
        <input type="password" placeholder="mot de passe" id="motdepasse" name="motdepasse">
      </div>
      <div class="connexion-input-control">
        <input type="submit" value="Ouvrir une session">
      </div>
      <legend>Connectez-vous</legend>
    </form>
  </div>
</section>
<?php require_once('./includes/footer.php'); ?>