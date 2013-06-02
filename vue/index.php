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
        <link rel="stylesheet" href="CSS/nav.css" type="text/css" />
        <link rel="stylesheet" href="CSS/content.css" type="text/css" />
        <link rel="stylesheet" href="CSS/tableau.css" type="text/css" />
        </head>
    <body>
        <header>
            <ul id="barregauche">
                <li> <a href='index.php'> Accueil</a> </li>
                <li> <a href='index.php?page=users&action=index'>Amis</a> </li>
                <li> <a href='index.php?page=operations&action=index'>Opérations</a> </li>
            </ul>
            <ul id="barredroite">
                <li>
                    <form action='index.php?page=users&action=search' method='POST'>
                        <input id="barre_recherche" type="text" name="recherche" />
                        <input id="button" type="submit" value="go"/>
                    </form>
                </li>
                <li>
                    <a href='index.php?page=users&action=edit'> <img src="images/settings.png" alt="Réglages"/> </a>
                </li>
            </ul>
        </header>
        

       
        
        <div class="content">
            
            <?php if (isset($flash) && $flash!=null) {
                echo("<div class = flash>" . $flash . "</div>");
                $flash = null;
            }  ?>
            
            <?php
            
            if(isset($_SESSION['id'])){
            
            ?>
        <nav>
            
            <?php require_once 'vue/layout/nav.php'; ?>
            
        </nav>
            
             <?php
            }
            else{
                $vue='vue/staticpages/home.php';
            }
            ?>
            
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
