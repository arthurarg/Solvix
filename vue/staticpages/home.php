<?php require_once 'vue/layout/header.php'; ?>

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
        <p>Confirmation : <input type="password" name="password" /></p>
        <p><input type="submit" value="S'inscrire"></p>
    </form>
</div>

<?php } ?>

<?php require_once 'vue/layout/footer.php'; ?>
