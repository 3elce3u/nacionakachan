<?php
require_once('class/class.php');
$novel= new Obra();
$ras=$novel->getvideosbyids("12","1");
echo    "obra id ".       $ras[0]['obra_id']."<br>";	
echo    "tipo id ".      $ras[0]['tipo_id']."<br>";
echo	"obra nombre ".		$ras[0]['obra_nombre']."<br>";
echo	"obra generos ".	$ras[0]['obra_generos']."<br>";
echo	"obra sinipsis ".		$ras[0]['obra_sinopsis']."<br>";
echo	"obra estado ".		$ras[0]['obra_estado']."<br>";
echo	"obra periodo ". 		$ras[0]['obra_periodo']."<br>";
echo	"obra patrocinada ". 		$ras[0]['obra_patrocinada']."<br>";
echo	"patrocinador id ". 		$ras[0]['patrocinador_id']."<br>";
echo	"obra fecha inicip ". 		$ras[0]['obra_fecha_inicio']."<br>";
echo	"obra caratula ". 		$ras[0]['obra_caratula']."<br>";
echo	"obra miniatura ". 		$ras[0]['obra_miniatura']."<br>";
echo	"obra keywords ". 		$ras[0]['obra_keywords']."<br>";
echo	"estado id ". 		$ras[0]['estado_id']."<br>";
echo	"estado ". 		$ras[0]['estado']."<br>";
echo	"tipo id ". 		$ras[0]['tipo_id']."<br>";
echo	"tipo ". 		$ras[0]['tipo']."<br>";
echo	"periodo id ". 		$ras[0]['periodo_id']."<br>";
echo	"periodo id ". 		$ras[0]['periodo']."<br>";
echo	"video id ". 		$ras[0]['video_id']."<br>";
echo	"obra id ". 		$ras[0]['obra_id']."<br>";
echo	"fansub id ". 		$ras[0]['fansub_id']."<br>";
echo	"fansub nombre ". 		$ras[0]['fansub_nombre']."<br>";
echo	"fansub enlace ". 		$ras[0]['fansub_enlace']."<br>";
echo	"web id ". 		$ras[0]['web_id']."<br>";
echo	"web ". 		$ras[0]['web']."<br>";
echo	"video capitulo inicio ". 		$ras[0]['video_capitulo_inicio']."<br>";
echo	"video capitulo fin ". 		$ras[0]['video_capitulo_fin']."<br>";
echo	"video titulo ". 		$ras[0]['video_titulo']."<br>";
echo	"video caratula ". 		$ras[0]['video_caratula']."<br>";
echo	"video miniatura ". 		$ras[0]['video_miniatura']."<br>";
echo	"video publicacion ". 		$ras[0]['video_publicacion']."<br>";
echo	"video fecha ". 		$ras[0]['video_fecha']."<br>";
echo	"video enlace ". 		$ras[0]['video_enlace']."<br>";

$respuesta=json_encode($ras);
echo $respuesta;
?>