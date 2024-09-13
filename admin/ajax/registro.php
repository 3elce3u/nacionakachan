<?php
require_once("../class/class.php");
$usuario=new Usuarios;
$res=$usuario->registro($_POST['nombre'],$_POST['email'],$_POST['email2'],$_POST['fecha'],$_POST['password'],$_POST['password2']);
if($res['estado']=="ok")
{
    $respuesta=json_encode($res);
    echo $respuesta;
}
else
{
    $respuesta=json_encode($res);
    echo $respuesta;
}
?>