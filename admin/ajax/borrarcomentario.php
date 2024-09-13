<?php
session_start();
require_once('../class/class.php');
$com=new Comentarios;
$borr=$com->delete_comentarios($_SESSION['usuario_id'],$_POST['comentario_id']);
/*$borr=$com->delete_comentarios($_SESSION['usuario_id'],105);*/
$bo=json_encode($borr);
echo $bo;
?>