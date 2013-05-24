<?php
if(!isset($vue)){
    header("Location: ../index.php");
    return;
}
?>

<?php //Cas utilisateur non connecte
if (!isset($_SESSION['id'])) { ?>
    
<div class ='formulaire_home'>
    <form class='formulaire_connection' action="index.php?page=sessions&action=create" method="post">
        <p>E-mail : <input type="text" name="email" /></p>
        <p>Mot de passe : <input type="password" name="password" /></p>
        <p><input type="submit" value="Se connecter"></p>
    </form>

    <form class='formulaire_inscription' action="index.php?page=users&action=create" method="post">
        <p>Prénom : <input type="text" name="prenom" /></p>
        <p>Nom : <input type="text" name="nom" /></p>
        <p>E-mail : <input type="text" name="mail" /></p>
        <p>Mot de passe : <input type="password" name="password" /></p>
        <p>Confirmation : <input type="password" name="confirmation" /></p>
        <p><input type="submit" value="S'inscrire"></p>
    </form>
</div>

<?php } 
    else { // cas utilisateur connecte
?>

    <div class ='info_profil'>
        <p> <?php echo($current_user->prenom . ' ' . $current_user->nom); ?> </p>
        <p> <?php echo($current_user->email); ?> </p>
        <p> <?php echo($solde); ?> </p>
    </div>

    <div class="dernieres_operations">
        <?php Affichage::afficher_tableau($taboperations);?>
    </div>

<?php
  }
?>