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
        <fieldset><legend> Se connecter </legend>
        <input type="email" placeholder='Adresse e-mail...' name="email" id="email" required="true"/>
        <input type="password" placeholder='Mot de passe...' name="password" id="password" required="true" />
        <input type="submit" value="Se connecter">
    </fieldset></form>

    <form class='formulaire_inscription' action="index.php?page=registration&action=new" method="post" onsubmit='return valider_inscription()'>
        <fieldset><legend> S'inscrire </legend>
        <input type="text" placeholder='Prenom...' name="prenom" id="prenom" required="true"/>
        <input type="text" placeholder='Nom...' name="nom" id="nom" required="true" />
        <input type="email" placeholder='E-mail...' name="mail" id="mail" required="true"/>
        <input type="password" placeholder='Mot de passe...' name="password" id="password" required="true"/>
        <input type="password" placeholder='Confirmation...' name="confirmation" id="confirmation" required="true"/>
        <input type="submit" value="S'inscrire">
    </fieldset></form>
</div>

<?php } 
    else { // cas utilisateur connecte
?>

    <div class="dernieres_operations">
        <p> Mes dernières opérations </p>
        <?php Affichage::afficher_operations($taboperations);?>
        
        <button class='button_home' type='button' onclick="location.replace('index.php?page=operations&action=index')">
            Voir toutes mes opérations
        </button>
    </div>

    

    <div class="quelques_amis">
        <p> Mes amis </p>
        <?php Affichage::afficher_users($tabamis);?>
        
        <button class='button_home' type='button' onclick="location.replace('index.php?page=users&action=index')">
          Voir tous mes amis
        </button>
    </div> 



<?php
  }
?>