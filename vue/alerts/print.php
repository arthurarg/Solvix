<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($vue))
    header("Location: index.php");

foreach($alerts as $alert){
    ?>
    <div class="alert">
    <div class="title"><p class="txt"><?php echo $alert['title'] ?></p><p class="close" id="<?php echo $alert['id'] ?>">X</p></div>
    
    <div class="content"><p><?php echo $alert['content'] ?></p></div>
    
</div>
<?php
}

?>
