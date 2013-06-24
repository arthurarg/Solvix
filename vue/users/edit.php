<p class="infos_personnelles">
    <?php 
        echo("Prenom : " .$current_user->prenom . '<br/>');
        echo("Nom : ". $current_user->nom . '<br/>');
        echo("Dernière connexion : " . $current_user->last_connect . '<br/>');
        echo("<button class='modifier_password' type='button'> Modifier mot de passe </button> <br/><br/>");
        echo("Email : " .$current_user->email. "<br/><button class='modifier_email' type='button'> Modifier </button><br/>");
        if (!empty($current_user->iban))
            echo('IBAN :' . $current_user->iban);
        else
            echo('Aucun iban rattaché à ce compte ');
        echo("<br/><button class='modifier_iban' type='button'>Modifier</button> <br/><br/>");
    ?>
    
</p>


<form class='formulaire_edition' action="index.php?page=users&action=update" method="post" onsubmit='return valider_edit()'>
    <fieldset class='intitule'><legend> Mise à jour</legend>
        <span class="password"> <input type="password" placeholder='Mot de passe...' id="password" name="password" value="" /></span>
        <span class="new_password"><input type="password" placeholder='Nouveau mot de passe...' id="new_password" name="new_password" /></span>
        <span class="new_confirmation"> <input type="password" placeholder='Confirmation nouveau...' id="new_confirmation" name="new_confirmation" /></span>
        <span class="email"><input type="email" placeholder='E-mail...'id="email" name="email" /></span>
        <span class="iban"><input type="text" placeholder='IBAN...'id="iban" name="iban" /></span>
        <span><input type="submit" id='submit' value="Mettre à jour"></span>
        </fieldset>
</form>

<span><a href="index.php?page=sessions&action=destroy">Déconnexion</a></span>

