<?php
    $rep=$bdd->query('SELECT id FROM users');
    while(($ami = $rep->fetch()) != null) {
        $users[$ami['id']]=new User($ami['id']);
    }

    if ($users == null) {
        echo("Aucun utilisateur à afficher");
        return;
    }

    foreach ($users as $user) {
        echo("<div class='user-box'>
            <span class='user-name'>". $user->prenom . " " . $user->nom . "</span></td>");
        if (!$user->locked)
            echo("<span id=".$user->id." class='admin-lock'value='1'>Verrouiller</span>");
        else
            echo("<span id=".$user->id." class='admin-lock' value='0'>Déverrouiller</span>");
        echo("</div>");
    }
?>
