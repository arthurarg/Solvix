<?php
if(!isset($vue)){
    header("Location: ../index.php");
    return;
}
?>

<?php //Cas utilisateur non connecte
if (!isset($_SESSION['id'])) { ?>
    
<div class ='formulaire_home'>
    <form class='formulaire_connection' action="index.php?page=sessions&action=create" method="post" onsubmit='return valider_login()'>
        <p><label for="email">E-mail</label> : <input type="email" name="email" id="email" required="true"/></p>
        <p><label for="password">Mot de passe</label> : <input type="password" name="password" id="password" required="true" /></p>
        <p><input type="submit" value="Se connecter"></p>
    </form>

    <form class='formulaire_inscription' action="index.php?page=registration&action=new" method="post" onsubmit='return valider_inscription()'>
        <p><label for="prenom">Prénom</label> : <input type="text" name="prenom" id="prenom" required="true"/></p>
        <p><label for="nom">Nom</label> : <input type="text" name="nom" id="nom" required="true" /></p>
        <p><label for="mail">E-mail</label> : <input type="email" name="mail" id="mail" required="true"/></p>
        <p><label for="password">Mot de passe</label> : <input type="password" name="password" id="password" required="true"/></p>
        <p><label for="confirmation">Confirmation</label> : <input type="password" name="confirmation" id="confirmation" required="true"/></p>
        <p><input type="submit" value="S'inscrire"></p>
    </form>
</div>

<?php } 
    else { // cas utilisateur connecte
?>

    <div class="dernieres_operations">
        <p> Mes dernières opérations </p>
        <?php Affichage::afficher_operations($taboperations);?>
        <button class='button_home' type='button'>
        <a href='index.php?page=operations&action=index'> Voir toutes mes opérations </a>
        </button>
    </div>

    

    <div class="quelques_amis">
        <p> Mes amis </p>
        <?php Affichage::afficher_users($tabamis);?>
        
        <button class='button_home' type='button'>
        <a href='index.php?page=users&action=index'> Voir tous mes amis </a>
        </button>
    </div> 



<?php
  }
?>