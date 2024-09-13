<?php
require_once("class/class.php");
$novela=new Obra;
if($_FILES['video_caratula']['name'] == null)
{
	$video_caratula=$_POST['video_caratula_original'];
 	$video_miniatura=$_POST['video_miniatura_original'];
}
else
{
	$temp = $_FILES['video_caratula']['tmp_name'];
	if(!empty($temp))
	{
		$temp = $_FILES['video_caratula']['tmp_name'];
		$nombre = basename($_FILES['video_caratula']['name']);
		$tamano = $_FILES['video_caratula']['size'];
		$typo = $_FILES['video_caratula']['type'];
		$name=$novela->getobrabyid($_POST['obra_id']);
		$name="Obra_".$name[0]['obra_nombre']."_capitulos_".$_POST['inicio']." al ".$_POST['fin'];
		$nombre=$novela->eliminar_simbolos($name);
		$nombre=str_replace(" ","_",$nombre);
		$nuevonombre=$nombre.'.'."webp";
		$ruti='recursos/img/';
		$ruta='../recursos/img/';
		$ruto='recursos/mini/';
		$rute='../recursos/mini/';
		$rutacompleta=$ruti.$nuevonombre;
		$rutacompoletamini=$ruto.$nuevonombre;
		chmod($ruta, 0777);
		chmod($rute, 0777); 
		if($_FILES['video_caratula']['type']=='image/jpeg'||'image/jpg'){
		$original = imageCreateFromJpeg($temp);
		}
		if($_FILES['video_caratula']['type']=='image/png'){
		$original = imageCreateFromPng($temp);
		}
		if($_FILES['video_caratula']['type']=='image/gif'){
		$original = imageCreateFromGif($temp);
		}
		if($_FILES['video_caratula']['type']=='image/webp'){
		$original = imageCreateFromWebp($temp);
		}
		$ancho_final=320;
		$alto_final=220;
		$ancho_mini=233;
		$alto_mini=160;
		list($ancho,$alto)=getimagesize($temp);
		$lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
		imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
		if($_FILES['video_caratula']['type']=='image/jpeg'||'image/jpg'){
		imagewebp($lienzo,$ruta."/".$nuevonombre,100);
		imagedestroy($lienzo);
		}
		if($_FILES['video_caratula']['type']=='image/png'){
		imagewebp($lienzo,$ruta."/".$nuevonombre,100);
		imagedestroy($lienzo);
		}
		if($_FILES['video_caratula']['type']=='image/gif'){
		imagewebp($lienzo,$ruta."/".$nuevonombre,100);
		imagedestroy($lienzo);
		}
		if($_FILES['video_caratula']['type']=='image/webp'){
		imagewebp($lienzo,$ruta."/".$nuevonombre,100);
		imagedestroy($lienzo);
		}
		$lienzo=imagecreatetruecolor($ancho_mini,$alto_mini); 
		imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_mini,$alto_mini,$ancho,$alto);
		if($_FILES['video_caratula']['type']=='image/jpeg'||'image/jpg'){
		imagewebp($lienzo,$rute."/".$nuevonombre,100);
		imagedestroy($lienzo);
		}
		if($_FILES['video_caratula']['type']=='image/png'){
		imagewebp($lienzo,$rute."/".$nuevonombre,100);
		imagedestroy($lienzo);
		}
		if($_FILES['video_caratula']['type']=='image/gif'){
		imagewebp($lienzo,$rute."/".$nuevonombre,100);
		imagedestroy($lienzo);
		}
		if($_FILES['video_caratula']['type']=='image/Webp'){
		imagewebp($lienzo,$rute."/".$nuevonombre,100);
		imagedestroy($lienzo);
		}
		$video_caratula=$rutacompleta;
		$video_miniatura=$rutacompoletamini;
	}
}	
$nov=$novela->editarvideos($_POST['video_id'],
							$_POST['obra_id'],
							$_POST['video_titulo'],
							$video_caratula,
							$video_miniatura,
							$_POST['fansub'],
							$_POST['fansub_enlace'],
							$_POST['web'],
							$_POST['video_enlace'],
							$_POST['inicio'],
							$_POST['fin'],
							$_POST['publicacion']);
	header("Location: editarobra.php?obra_id=".$_POST['obra_id']."");
?>