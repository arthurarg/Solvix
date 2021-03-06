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
        <title> SolviX : réglez vos dettes !</title>
        
        <?php if (isset($current_user)) {
            echo('<link rel="stylesheet" href="CSS/structure.css" type="text/css" />');
        } else {
            echo('<link rel="stylesheet" href="CSS/structure_without_nav.css" type="text/css" />');
        } ?>
        
        <link rel="stylesheet" href="CSS/nav.css" type="text/css" />
        <link rel="stylesheet" href="CSS/content.css" type="text/css" />
        <link rel="stylesheet" href="CSS/tableau.css" type="text/css" />
        <link rel="stylesheet" href="CSS/alerts.css" type="text/css" />
        <link rel="stylesheet" href="CSS/formulaires.css" type="text/css" />
        
        <script type="text/javascript" src="javascript/jquery-1.10.1.js"> </script>
        <script type="text/javascript" src="javascript/general.js"> </script>        
        <script type="text/javascript" src="javascript/search.js"> </script>       
        <script type="text/javascript" src="javascript/alerts.js"> </script>
        <script type="text/javascript" src="javascript/formulaires.js"> </script>
        </head>
    <body>
        <header>
            <div id='logo'>
                <img src='images/logo.png' alt:logo>
                <p> Solvix</p>
            </div>
            
            <?php if (isset($current_user)) { ?>              
                <div id="barreheader">
                <ul id="barregauche">
                    <li> <a href='index.php'> Accueil</a> </li>
                    <li> <a href='index.php?page=users&action=index'>Amis</a> </li>
                    <li> <a href='index.php?page=operations&action=index'>Opérations</a> </li>
                </ul>
                <ul id="barredroite">
                    <li>
                        <form action='index.php?page=users&action=search' method='POST' id="form_search">
                            <input id="barre_recherche" type="search" placeholder="Recherche..." name="recherche" />
                        </form>
                    </li>
                    <li>
                        <a id="menu_alerts"><img id="image_alert" src="<?php echo $image_alert ?>" alt="Alertes"/></a>
                         
                    </li>
                    <li>
                        <a href='index.php?page=users&action=edit'> <img src="images/settings.png" alt="Réglages"/> </a>
                    </li>
                </ul>
                </div>
            <?php } ?>
        </header>
        
        <div id="alerts">
            <ul id="alerts_list"><?php  require_once 'vue/alerts/print.php' ?></ul>
        </div>
        <div id="content">
        <?php if (isset($flash) && $flash!=null) {
                echo("<div id = \"flash\"><p>" . $flash . "</p><p id=\"masquer\" >x</p></div>");
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
