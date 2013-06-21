<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($vue))
    header("Location: index.php");
foreach($alerts as $alert){
    if($alert['hide']==1){
    
    ?>
    <li class="alerts_item_close" id="<?php echo $alert['id'] ?>">
        <?php
    }
    else{
        ?>
        <li class="alerts_item" id="<?php echo $alert['id'] ?>">
        <?php
    }
    ?>
    <a class="close">X</a><p class="title"><?php echo $alert['title'] ?></p>
    
    <p class="content"><?php echo $alert['content'] ?></p>
    
</li>
<?php
}

?>
