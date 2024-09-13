<?php
require_once('../class/class.php');
$com=new Comentarios;
$comen=$com->get_comentarios($_POST['obra_id'],$_POST['video_id']);
$come=json_encode($comen);
echo $come;
/*$come=$com->get_comentarios(1,1);
for($h=0;$h<sizeof($come); $h++)
{
   echo "comentario id ".$come[$h]['comentario_id']."<br>";
   echo "usuario id ".$come[$h]['usuario_id']."<br>";
   echo "novela id ".$come[$h]['novela_id']."<br>";
   echo "volumen id ".$come[$h]['volumen_id']."<br>";
   echo "comentario ".$come[$h]['comentario']."<br>";
   echo "respuesta comentario id ".$come[$h]['respuesta_comentario_id']."<br>";
   echo "comentario fecha ".$come[$h]['comentario_fecha']."<br>";
   echo "usuario nick ".$come[$h]['usuario_nick']."<br>";
   echo "usuario avatar ".$come[$h]['usuario_avatar']."<br>";
   echo "likes ".$come[$h]['likes']."<br>";
   echo "margen ".$come[$h]['margen']."<br>";
   echo "<br><br>";
   
}*/
?>                          