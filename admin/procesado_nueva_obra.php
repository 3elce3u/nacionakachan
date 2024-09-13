<?php
require_once("class/class.php");
$obra=new Obra;
	$temp = $_FILES['obra_caratula']['tmp_name'];
	$nombre = basename($_FILES['obra_caratula']['name']);
	$tamano = $_FILES['obra_caratula']['size'];
	$typo = $_FILES['obra_caratula']['type'];
	$name="Obra ".$_POST['obra_nombre'];
	$nombre=$obra->eliminar_simbolos($name);
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
	if($_FILES['obra_caratula']['type']=='image/jpeg'||'image/jpg'){
	$original = imageCreateFromJpeg($temp);
	}
	if($_FILES['obra_caratula']['type']=='image/png'){
	$original = imageCreateFromPng($temp);
	}
	if($_FILES['obra_caratula']['type']=='image/gif'){
	$original = imageCreateFromGif($temp);
	}
	if($_FILES['obra_caratula']['type']=='image/webp'){
	$original = imageCreateFromWebp($temp);
	}
	$ancho_final=220;
	$alto_final=320;
	$ancho_mini=160;
	$alto_mini=233;
	list($ancho,$alto)=getimagesize($temp);
	$lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
	imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final,$alto_final,$ancho,$alto);
	if($_FILES['obra_caratula']['type']=='image/jpeg'||'image/jpg'){
	imagewebp($lienzo,$ruta."/".$nuevonombre,100);
	imagedestroy($lienzo);
	}
	if($_FILES['obra_caratula']['type']=='image/png'){
	imagewebp($lienzo,$ruta."/".$nuevonombre,100);
	imagedestroy($lienzo);
	}
	if($_FILES['obra_caratula']['type']=='image/gif'){
	imagewebp($lienzo,$ruta."/".$nuevonombre,100);
	imagedestroy($lienzo);
	}
	if($_FILES['obra_caratula']['type']=='image/webp'){
	imagewebp($lienzo,$ruta."/".$nuevonombre,100);
	imagedestroy($lienzo);
	}
	$lienzo=imagecreatetruecolor($ancho_mini,$alto_mini); 
	imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_mini,$alto_mini,$ancho,$alto);
	if($_FILES['obra_caratula']['type']=='image/jpeg'||'image/jpg'){
	imagewebp($lienzo,$rute."/".$nuevonombre,100);
	imagedestroy($lienzo);
	}
	if($_FILES['obra_caratula']['type']=='image/png'){
	imagewebp($lienzo,$rute."/".$nuevonombre,100);
	imagedestroy($lienzo);
	}
	if($_FILES['obra_caratula']['type']=='image/gif'){
	imagewebp($lienzo,$rute."/".$nuevonombre,100);
	imagedestroy($lienzo);
	}
	if($_FILES['obra_caratula']['type']=='image/Webp'){
	imagewebp($lienzo,$rute."/".$nuevonombre,100);
	imagedestroy($lienzo);
	}
	

	$obra_caratula=$rutacompleta;
	$obra_miniatura=$rutacompoletamini;
	$obra_generos="";
	for($i=0;$i<45;$i++)
	{
		if(!empty($_POST['obra_genero'.$i]))
		{
		$obra_generos.=$_POST['obra_genero'.$i].",";
		}
	}
$nov=$obra->guardarobra($_POST['tipo_id'],$_POST['obra_nombre'],$obra_generos,$_POST['obra_sinopsis'],$_POST['obra_estado'],$_POST['obra_periodo'],
						$_POST['obra_patrocinada'],$_POST['patrocinador_id'],$obra_caratula,$obra_miniatura,$_POST['obra_keywords']);


$novid=$obra->getobrabynombre($_POST['obra_nombre']);
$obra_id=$novid[0]['obra_id'];
/*echo $nov;*/
header("Location: editarobra.php?obra_id=".$obra_id."");
?>