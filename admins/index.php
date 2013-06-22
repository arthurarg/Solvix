<?php 
    session_start();
    include_once '../modele/Operation.php';
    include_once '../modele/User.php';
    include_once '../modele/Relationship.php';
    include_once '../modele/Registration.php';
    include_once '../modele/Alert.php';
        
    $bdd=new PDO('mysql:host=localhost;dbname=modal', 'root','');
    

    if (isset($_POST['login']) && isset($_POST['mdp'])) {
        $req=$bdd->prepare("SELECT id FROM admins WHERE login=? AND password=?");
        $req->execute(array(htmlspecialchars($_POST['login']),  sha1(htmlspecialchars($_POST['mdp']))));
        $donnees = $req->fetch();
        if ($donnees['id']!= null) {
            $_SESSION['admin'] = true;
            header('Location: index.php');
        }   
    }
    
    if (isset($_GET['action']) && htmlspecialchars($_GET['action']==='disconnect')) {
        session_destroy();
        header('Location: index.php');
    }
?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> SolviX : réglez vos dettes ! </title>
  
        <link rel="stylesheet" href="../CSS/structure_without_nav.css" type="text/css" />
        <?php if(isset($_SESSION['admin']) && $_SESSION['admin']) { ?>
        <style type="text/css">
            article {
              margin-left: 10px;
              width: 90%;
            }
        </style>
        <?php } ?>


        <link rel="stylesheet" href="../CSS/nav.css" type="text/css" />
        <link rel="stylesheet" href="../CSS/content.css" type="text/css" />
        <link rel="stylesheet" href="../CSS/tableau.css" type="text/css" />
        <link rel="stylesheet" href="../CSS/alerts.css" type="text/css" />
        <link rel="stylesheet" href="../CSS/formulaires.css" type="text/css" />
        
        <script type="text/javascript" src="../javascript/jquery-1.10.1.js"> </script>
        <script type="text/javascript" src="../javascript/general.js"> </script>        
        <script type="text/javascript" src="../javascript/search.js"> </script>       
        <script type="text/javascript" src="../javascript/alerts.js"> </script>
        <script type="text/javascript" src="../javascript/formulaires.js"> </script>
        <script type="text/javascript" src="suppressions.js"> </script>
        </head>
    <body>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']) { ?>
        <header>
                <div id='logo'>
                    <img src='../images/logo.png' alt:logo>
                    <p> Solvix</p>
                </div>
                <div id="barreheader">
                <ul>
                    <li> <a href='index.php?action=index_users'>Utilisateurs</a> </li>
                    <li> <a href='index.php?action=index_operations'>Opérations</a> </li>
                </ul>
                <ul>
                    <li> <a href='index.php?action=disconnect'>Se déconnecter</a> </li>
                </ul>
                </div>
        </header>
        
        <div id="content">
            
            
            <?php if (isset($flash) && $flash!=null) {
                echo("<div class = flash>" . $flash . "<span id=\"masquer\" >x</span></div>");
                $flash = null;
            }  ?>
            
            
        <article>
            <?php if (isset($_GET['action']) && htmlspecialchars($_GET['action'])==='index_users')
                    require_once 'users.php';
                  else if (isset($_GET['action']) && htmlspecialchars($_GET['action'])==='index_operations')
                    require_once 'operations.php'; 
                  else
                      echo("Choisissez un onglet");
                  ?>
            
        </article>
              
        </div>
        <?php }
           else { ?>
        <header>            
            <div id='logo'>
                <img src='../images/logo.png' alt:logo>
                <p> Solvix</p>
            </div>
        </header>
        <div id="content">
            <article>
                <form class='formulaire_connection' method="post">
                    <fieldset><legend> Se connecter </legend>
                    <input type="text" placeholder='Login...' name="login" id="login" required="true"/>
                    <input type="password" placeholder='Mot de passe...' name="mdp" id="mdp" required="true" />
                    <input type="submit" value="Se connecter">
                </fieldset></form>
            </article>
        </div>
            
        <?php } ?>
        <footer>
            <p>Modal web 2013 : Jean-Maxime Pasquet et Arthur Argenson</p>
        </footer>
    </body>
</html>
