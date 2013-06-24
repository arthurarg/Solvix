<?php
    session_start();

    include_once 'modele/Operation.php';
    include_once 'modele/User.php';
    include_once 'modele/Relationship.php';
    include_once 'modele/Registration.php';
    include_once 'modele/Alert.php';
    
    include_once 'helper/saisies.php';
    include_once 'helper/affichage.php';
    
    
//Connection à la  bdd
    $bdd=new PDO('mysql:host=localhost;dbname=modal', 'root','');
    
    //Charge l'utilisateur
    if(isset($_SESSION['id'])){
        $current_user=new User($_SESSION['id']);        
    }
    
    if(isset($_SESSION['id']) && (!isset($_GET['page']) || $_GET['page']!="alerts"))
        require_once 'controleur/alerts.php';
    
//Caractères spéciaux échappés pour des raisons de securite
    foreach ($_GET as $i => $value)
        $_GET[$i] = strtolower(htmlspecialchars($_GET[$i]));
    
    foreach ($_POST as $i => $value)
        $_POST[$i] = strtolower(htmlspecialchars($_POST[$i]));
 
 

//Traitement des pages (tableau xml)
    if (isset($_GET['page']))
        $page_demandee = $_GET['page'];
    else {
        require_once 'controleur/staticpages.php';
        return;
    }
        
    
    
//Cas utilisateur non connecté => seul home, la page de connection le formulaire d'inscription sont accessibles
    if (!isset($_SESSION['id'])) {
        if ($page_demandee == 'users' && isset($_GET['action']) && $_GET['action'] == "create")
            require_once 'controleur/users.php' ;
        else if ($page_demandee == 'sessions' && isset($_GET['action']) && $_GET['action'] == "create")
            require_once 'controleur/sessions.php' ;
        else if ($page_demandee == 'registration' && isset($_GET['action']) && ($_GET['action'] == "new" || $_GET['action'] == "save"))
            require_once 'controleur/registration.php' ;
        else
            header('Location: index.php');
        
            
         
         return;
    }
    
//Cas utilisateur connecte
    else {


         $xml = simplexml_load_file("pages.xml");
         $tabpages = $xml->page;
         foreach ($tabpages as $page_existante) {

             if ($page_demandee == $page_existante->name) {
                 require_once ($page_existante->loc);
                 return;
             }
         }

         //Si la page demandee n'existe pas, go erreur
         require_once 'vue/staticpages/erreur.php';
    }

 
?>
