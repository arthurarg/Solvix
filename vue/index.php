<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($vue)){
    require_once 'vue/layout/header.php';
    require_once $vue;
    require_once 'vue/layout/footer.php';
}
else{
    header("Location: ../index.php");
}
?>
