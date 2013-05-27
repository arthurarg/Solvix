<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($vue)){
    
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="CSS/structure.css" type="text/css" />
        </head>
    <body>
        <header>
            <ul id="barregauche">
                <li> <a href='index.php'> Accueil</a> </li>
                <li> <a href='index.php?page=users&action=show'>Amis</a> </li>
                <li> <a href='index.php?page=operation&action=new'>Opérations</a> </li>
            </ul>
            <ul id="barredroite">
                <form action='recherche.php' method='POST'>
                    <input id="barre_recherche" type="text" name="recherche" />
                    <input id="button" type="submit" value="go"/>
                </form>
                <li> <a href='index.php?page=sessions&action=destroy'>Rég</a></li>
            </ul>
        </header>
        
        <div class="content">
            
        <nav>
            
            <?php require_once 'vue/layout/nav.php'; ?>
            
        </nav>
            
        <article>
            <?php require_once $vue; ?>
        </article>
            
        </div>
            
        <footer>
            <p>Modal web 2013 : Jean-Maxime Pasquet et Arthur Argenson</p>
        </footer>
    </body>
</html>
    

    
    <?php
}
else{
    header("Location: ../index.php");
}
?>
