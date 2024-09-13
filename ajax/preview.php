<?php
    require_once('../class/class.php');
    $com=new Comentarios;
    $txt=filter_var($_POST['texto'], FILTER_SANITIZE_STRING);
    $text=$com->BBCodepre($txt);
    echo $text;
?>

