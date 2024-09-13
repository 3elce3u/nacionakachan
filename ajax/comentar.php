<?php  
session_start();
$usuario_id=$_SESSION['usuario_id'];
require_once('../class/class.php');
$com=new Comentarios;
if(empty($_POST['respuesta']))
{
    $respuesta=0;
}
else
{
    $respuesta=$_POST['respuesta'];
}
$res=$com->insert_comentarios($usuario_id,$_POST['obra_id'],$_POST['video_id'],$_POST['comentario'],$respuesta);
/*echo $_POST['usuario_id'],$_POST['novela_id'],$_POST['volumen_id'],$_POST['comentario'],$respuesta;*/
?>