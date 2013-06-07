<?php
include_once '../helper/saisies.php';

if(Saisies::isIban("20041010050500013M02606"))
        echo("oui");
else
    echo("non");

$string="fr1420041010050500013m02616";
$other_string = substr($string,4) . substr($string,0,4);
echo($other_string. "<br/>");
$chars=str_split($other_string);
$new_string='';
foreach($chars as $char) {
    if (!is_numeric($char))
      $new_string= $new_string . (ord($char)-87);
    else
      $new_string= $new_string . $char;  
}
echo($new_string. "<br/>");
while (strlen($new_string) > 2) {
    $new_string = (int)(substr($new_string,0,8))%97 . substr($new_string,8);
    echo($new_string . "<br/>");
}
$new_string = $new_string%97; // (cas ou ça vaut 98)
echo("coucou" . $new_string);    
?>
