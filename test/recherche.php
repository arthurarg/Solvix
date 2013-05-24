<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'modele/User.php';

if(isset($_POST['recherche'])){
    
    $bdd=new PDO('mysql:host=localhost;dbname=modal', 'root','');
    
    echo 'Résultats de la recherche :<br/>';
    
    $res=  User::rechercher($_POST['recherche']);
    
    if($res!=0){
        foreach($res as $user)
            $user->affichage();
    }
    else echo 'aucun résultat<br/>';
    
    echo '<br/><a href="recherche.php">retour</a>';
}
else{
    ?>

<form action='recherche.php' method='POST'>
    <input type="text" name="recherche" />
    <input type="submit" value="go">
</form>

<?php
}
?>
