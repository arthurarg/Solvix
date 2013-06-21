<?php
session_start();
$bdd=new PDO('mysql:host=localhost;dbname=modal', 'root','');
include_once '../modele/User.php';


if (isset($_SESSION['admin']) && $_SESSION['admin']) {
    
    if (isset($_POST['id'])) {
        $req=$bdd->prepare('DELETE FROM operations WHERE id=?');
        $req->execute(array(htmlspecialchars($_POST['id'])));
    }
    
    if (isset($_POST['id1'])&&isset($_POST['id2']) && isset($_POST['montant'])) {
        $user1=new User((htmlspecialchars($_POST['id1'])));
        $solde1 = $user1->getSolde() + $_POST['montant'];
        echo($user1->prenom . ' ' . $user1->nom . ': ' . $solde1 . "€ \n");
        
        if ($_POST['id2']!=-1) {
        $user2=new User((htmlspecialchars($_POST['id2'])));
        $solde2 = $user2->getSolde() - $_POST['montant'];
        echo($user2->prenom . ' ' . $user2->nom . ': ' . $solde2 . ' € \n');
        }
    }
}
?>