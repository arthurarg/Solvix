<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!isset($_GET['id']) || !isset($_GET['code']) || (int)$_GET['id']==0){
    header("Location: index.php");
}
echo '<a href="http://localhost/modal/index.php?page=registration&action=save&code='.$_GET['code'].'&id='.$_GET['id'].'">Cliquez ici pour finaliser votre inscription !</a>';
?>
