<p class="infos_personnelles">
    <?php 
        echo($current_user->prenom . ' ' . $current_user->nom . '<br/>');
        echo($current_user->email. "<button class='modifier_email' type='button'> Modifier email </button> <br/><br/>");
        if (!empty($current_user->iban))
            echo('IBAN :' . $current_user->iban);
        else
            echo('Aucun iban rattaché à ce compte');
        echo("<button class='modifier_iban' type='button'> Modifier iban </button> <br/><br/>");
        echo("<button class='modifier_password' type='button'> Modifier mot de passe </button> <br/>");
    ?>
    
</p>


<form class='formulaire_edition' action="index.php?page=users&action=update" method="post">
        <p class="password">Mot de passe : <input type="password" id="password" name="password" value="" /></p>
        <p class="new_password">Nouveau mot de passe : <input type="password" id="new_password" name="new_password" /></p>
        <p class="new_confirmation">Confirmation nouveau mot de passe : <input type="password" id="new_confirmation" name="new_confirmation" /></p>
        <p class="email">Email : <input type="email" id="email" name="email" /></p>
        <p class="iban">IBAN : <input type="text" id="iban" name="iban" /></p>
        <p><input type="submit" id='submit' value="Mettre à jour"></p>
        <p><a href="index.php?page=sessions&action=destroy">Déconnection</a></p>
</form>
