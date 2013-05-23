<?php //Cas utilisateur non connecte
if (!isset($_SESSION['id'])) { ?>
    
<div class ='formulaire_home'>
    <form class='formulaire_connection' action="index.php?page=sessions&action=create" method="post">
        <p>E-mail : <input type="text" name="email" /></p>
        <p>Mot de passe : <input type="password" name="password" /></p>
        <p><input type="submit" value="Se connecter"></p>
    </form>

    <form class='formulaire_inscription' action="action.php" method="post">
        <p>Prénom : <input type="text" name="prenom" /></p>
        <p>Nom : <input type="text" name="nom" /></p>
        <p>E-mail : <input type="text" name="email" /></p>
        <p>Mot de passe : <input type="password" name="password" /></p>
        <p>Confirmation : <input type="password" name="confirmation" /></p>
        <p><input type="submit" value="S'inscrire"></p>
    </form>
</div>

<?php } 
    else { // cas utilisateur connecte
?>

    <div class ='info_profil'>
        <p> <?php echo($_SESSION['prenom'] . ' ' . $_SESSION['nom']); ?> </p>
        <p> <?php echo($_SESSION['email']); ?> </p>
        <p> <?php echo($solde); ?> </p>
    </div>

    <div class ='dernieres_operations'>
        <?php 

        while($op = $taboperations->fetch()) {
            echo ('<p>' . $op['libelle'] . ' '. $op['montant'] . '</p>' );
        } 
        ?>
    </div>

    <div class='formulaire_ami'
    </div>

    <div class='faire_operation'>
        <a href='index.php?page=operations&action=newz'> Recharger de l'argent </a>
        <a href='index.php?page=operations&action=new'> Retirer de l'argent </a>
        <form class='formulaire_deal' action="index.php?page=operations&action=create" method="post">
            <p>Bénéficiaire : 
                <select name="receveur">
                    <?php foreach ($tabamis as $ami) { echo('<option value=' . $ami->id . '> ' . $ami->prenom . ' '. $ami->nom); } ?>
                </select>
            </p>
            <p>Montant : <input type="text" name="montant" /></p>
            <p>Libellé : <input type="libelle" name="libelle" /></p>
            <p><input type="submit" value="Verser l'argent"></p>
        </form>
    </div>


<?php
  }
?>