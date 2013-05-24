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
            <ul>
                <li> <a href='index.php'> Accueil</a> </li>
                <li> <a href='index.php?page=users&action=show'>Amis</a> </li>
                <li> <a href='index.php?page=operation&action=new'>Opérations</a> </li>
                <li> <a href='index.php?page=sessions&action=destroy'>Réglages</a></li>
                <li> <a href='index.php?page=sessions&action=destroy'>Virement</a></li>
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
