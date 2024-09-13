<?php
require_once("../class/class.php");
$usuario=new Usuarios;
$res=$usuario->recpas($_POST['email'],$_POST['email2']);
    $respuesta=json_encode($res);
    echo $respuesta;
?>
