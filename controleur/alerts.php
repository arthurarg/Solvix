<?php


if(isset($_GET['da']) && isset($_GET['page']) && $_GET['page']=="alerts"){
    if($_GET['da']>0 && is_numeric($_GET['da'])){
            Alert::erase($_GET['da'], $current_user->id);
        }
        $alerts=Alert::get($current_user->id);
        $vue='vue/alerts/print.php';
        require_once $vue;
}
else {
    $alerts=Alert::get($current_user->id);
    
    if(sizeof($alerts)>0)
        $image_alert="images/alert.png";
    else
        $image_alert="images/no_alert.png";
}

?>
