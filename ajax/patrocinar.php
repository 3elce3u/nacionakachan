<?php
session_start();
require_once("../class/class.php");
$usuario=new Obra;
$res=$usuario->guardar_patro($_POST['usuario_id'],$_POST['coste'],$_POST['causa'],$_POST['tipo'],$_POST['obra'],$_POST['nota']);
if($res['estado']=="ok")
{
    $_SESSION['puntos']=$res['puntos'];
}

$respuesta=json_encode($res);
echo $respuesta;
?>