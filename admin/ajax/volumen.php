<?php
require_once("../class/class.php");
$novel= new Novela();
$ras=$novel->getvolumenesbyids($_GET['novela_id'],$_GET['volumen_id']);
$ras['novela_id'];
$ras['escritor_id'];
$ras['editorial_id'];
$ras['fansub_id'];
$ras['novela_nombre'];
$ras['novela_nombre_original'];
$ras['novela_generos'];
$ras['novela_sinopsis'];
$ras['novela_caratula'];
$ras['novela_miniatura'];
$ras['novela_keywords'];
$ras['novela_fecha_publicacion'];
$ras['volumen_id'];
$ras['volumen'];
$ras['volumen_caratula'];
$ras['volumen_miniatura'];
$ras['volumen_fecha_publicacion'];
$ras['volumen_fecha_original'];
$ras['volumen_enlace_pdf'];
$ras['volumen_enlace_video'];
$ras['escritor_id'];
$ras['escritor_nombre'];
$ras['ilustrador_id'];
$ras['ilustrador_nombre'];
$ras['editorial_id'];
$ras['editorial_nombre'];
$ras['editorial_enlace'];
$ras['fansub_id'];
$ras['fansub_nombre'];
$ras['fansub_enlace'];

$respuesta=json_encode($ras);
echo $respuesta;
?>