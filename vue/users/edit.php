<form class='formulaire_edition' action="index.php?page=users&action=update" method="post">
        <p>Mot de passe : <input type="password" name="password" /></p>
        <p>Nouveau mot de passe : <input type="password" name="new_password" /></p>
        <p>Confirmation nouveau mot de passe : <input type="password" name="new_confirmation" /></p>
        <p>IBAN : <input type="text" name="iban" /></p>
        <p><input type="submit" id='submit' value="Mettre à jour"></p>
        <p><a href="index.php?page=sessions&action=destroy">Déconnection</a></p>
</form>
