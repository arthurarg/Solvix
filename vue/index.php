<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'layout/header.php';
if(isset($vue)){
    require_once $vue;
}
else{
    header("Location: index.php");
}
require_once 'layout/footer.php';
?>
