<?php
session_start();
$bdd=new PDO('mysql:host=localhost;dbname=modal', 'root','');

if (isset($_SESSION['admin']) && $_SESSION['admin']) {
    $req=$bdd->prepare("UPDATE users SET locked=? WHERE id=?");
    $req->execute(array($_POST['bol'],$_POST['id']));
}
?>
