<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$racine="";
if(!isset($vue)){
    session_start();
    include_once '../modele/Alert.php';
    include_once '../modele/User.php';
    $racine="../";
    
    $bdd=new PDO('mysql:host=localhost;dbname=modal', 'root','');
    $current_user=new User($_SESSION['id']);
}

if (!isset($_GET['action'])) {
    $alerts=Alert::get($current_user->id);
        $vue=$racine.'vue/alerts/print.php';
        require_once $vue;
        return;
}

switch ($_GET['action']) {
    
    case 'print':
        if(isset($_GET['id']) && $_GET['id']>0 && is_numeric($_GET['id'])){
            Alert::erase($_GET['id'], $current_user->id);
        }
        
        $alerts=Alert::get($current_user->id);
        $vue=$racine.'vue/alerts/print.php';
        require_once $vue;
        break;
    
}
?>
