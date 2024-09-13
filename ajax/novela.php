<?php
require_once('../class/class.php');
$novel=new Obra();
$edi=$novel->getobrabyid($_POST['obra_id'],$_POST['obra_nombre']);
$vol=$novel->getvideosbyobraid($edi[0]['obra_id']);
$fecha=$novel->formatearf($edi[0]['obra_fecha_inicio']);
$gener=explode(',',$edi[0]['obra_generos']);
$cont=sizeof($gener);
    $x=0;
    $res['generos']="";
    for($y=0;$y<$cont-1;$y++)
    {
        $genr=$novel->getgenerosbyid($gener[$y]);
        if($y == $cont-2)
        {
            $res['generos'].='<div class="cuadgen" id="cuadgen'.$x.'">'.$genr[0]['genero'].'</div>';
            $x=$x+1;
        }
        else
        {
            $res['generos'].='<div class="cuadgen" id="cuadgen'.$x.'">'.$genr[0]['genero'].'</div>';
            $x=$x+1;
        }
    }
    $res['caratula']='<img height="320" width="220" src="'.$edi[0]['obra_caratula'].'" alt="Obra '.$edi[0]['obra_nombre'].'">';
    $res['obra_nombre']="<div style='width:100%;'><div style='border:solid 1px #ccc; border-radius:5px; width:90px; float:left; background-color: rgba(208, 91, 255, 0.3); padding:3px;'>Obra </div>&nbsp; <strong>".$edi[0]['obra_nombre']."</strong></div>";
    $res['tipo']="<div style='width:100%;'><div style='border:solid 1px #ccc; border-radius:5px; width:90px; float:left; background-color: rgba(208, 91, 255, 0.3); padding:3px;'>Tipo </div>&nbsp; <strong>".$edi[0]['tipo']."</strong></div>";
    $res['estado']="<div style='width:100%;'><div style='border:solid 1px #ccc; border-radius:5px; width:90px; float:left; background-color: rgba(208, 91, 255, 0.3); padding:3px;'>Estado </div>&nbsp; <strong>".$edi[0]['estado']."</strong></div>";
    $res['periodo']="<div style='width:100%;'><div style='border:solid 1px #ccc; border-radius:5px; width:90px; float:left; background-color: rgba(208, 91, 255, 0.3); padding:3px;'>Periodo </div>&nbsp; <strong>". $edi[0]['periodo']." días </strong></div>";
    if($edi[0]['obra_patrocinada']==1)
    {
        $res['patrocinador']="<div style='width:100%;'><div style='border:solid 1px #ccc; border-radius:5px; width:90px; float:left; background-color: rgba(208, 91, 255, 0.3); padding:3px;'>Patrocinador </div>&nbsp; <strong>". $edi[0]['usuario_nombre']."</strong></div>";
    }
    else
    {
        $res['patrocinador']="";
    }
    $res['fecha']="<div style='width:100%;'><div style='border:solid 1px #ccc; border-radius:5px; width:90px; float:left; background-color: rgba(208, 91, 255, 0.3); padding:3px;'>Inicio </div>&nbsp; <strong>". $fecha."</strong></div>";
    $res['sinopsis']="<blockquote>".$edi[0]['obra_sinopsis']."</blockquote>";
    if(!empty($vol))
    {
        $cuenta=sizeof($vol);
        $bre=0;
        $res['videos']="";
        $marca="video".$x;
        for($x=0;$x<$cuenta;$x++)
        {
            $marca="video".$x;
            $res['videos'].='
                                <form method="get" action="video.php" id="'.$marca.'">
                                    <input type="hidden" name="video_id" value="'.$vol[$x]['video_id'].'">
                                    <input type="hidden" name="obra_id" value="'.$vol[$x]['obra_id'].'">
                                    <input type="hidden" name="obra_nombre" value="'.$edi[0]['obra_nombre'].'">
                                </form>
                <div class="volumu">
                    <a onClick="$(`#'.$marca.'`).submit();" title="Video '.$vol[$x]['video_titulo'].'">
                        <img class="volumi" src="'.$vol[$x]['video_miniatura'].'" alt="Obra '.$edi[0]['obra_nombre'].' Video '.$vol[$x]['video_titulo'].'">
                    </a>
                    Del cap '.$vol[$x]['video_capitulo_inicio'].' a el '.$vol[$x]['video_capitulo_fin'].'</div>';
        }
    }
    else
    {
        $res['videos']="";
    }
    if($edi[0]['tipo']=="Manga")
    {
        $res['color']='rgba(0, 191, 255, 0.2)';
    }
    if($edi[0]['tipo']=="Manhwa")
    {
        $res['color']='rgba(0, 250, 154, 0.2)';
    }
    if($edi[0]['tipo']=="Manhua")
    {
        $res['color']='rgba(139, 69, 19, 0.2)';
    }
    $resultado=json_encode($res);
    echo $resultado;
    /*
    echo  $res['caratula']."<br>";
    echo  $res['obra_nombre']."<br>";
    echo  $res['tipo']."<br>";
    echo  $res['estado']."<br>";
    echo  $res['periodo']."<br>";
    echo  $res['patrocinador']."<br>";
    echo  $res['fecha']."<br>";
    echo  $res['generos']."<br>";
    echo  $res['sinopsis']."<br>";
    echo  $res['videos']."<br>";



    echo        "obra id ". $edi[0]['obra_id']."<br>";	
	echo		"tipo id ".$edi[0]['tipo_id']."<br>";
	echo		"obra nombre ".$edi[0]['obra_nombre']."<br>";
	echo		"obra generos ".$edi[0]['obra_generos']."<br>";
	echo		"obra sinopsis ".$edi[0]['obra_sinopsis']."<br>";
	echo		"obra estado ".$edi[0]['obra_estado']."<br>";
	echo		"obra periodo ".$edi[0]['obra_periodo']."<br>";
	echo		"obra patrocinada ".$edi[0]['obra_patrocinada']."<br>";
	echo		"patrocinador id ".$edi[0]['patrocinador_id']."<br>";
	echo		"obra fecha inicio ".$edi[0]['obra_fecha_inicio']."<br>";
	echo		"obra caratula ".$edi[0]['obra_caratula']."<br>";
	echo		"obra miniatura ".$edi[0]['obra_miniatura']."<br>";
	echo		"obra keywords ".$edi[0]['obra_keywords']."<br>";
	echo		"estado id ".$edi[0]['estado_id']."<br>";
	echo		"estado ".$edi[0]['estado']."<br>";
	echo		"tipo id ".$edi[0]['tipo_id']."<br>";
	echo		"tipo ".$edi[0]['tipo']."<br>";
	echo		"periodo id ".$edi[0]['periodo_id']."<br>";
	echo		"periodo ".$edi[0]['periodo']." días <br>";
	echo		"usuario id ".$edi[0]['usuario_id']."<br>";
	echo		"usuario nombre ".$edi[0]['usuario_nombre']."<br>";
	echo		"usuario avatar ".$edi[0]['usuario_avatar']."<br>";
	echo		"usuario fecha nacimiento ".$edi[0]['usuario_fecha_nacimiento']."<br>";
	echo		"usuario email ".$edi[0]['usuario_email']."<br>";
	echo		"usuario password ".$edi[0]['usuario_password']."<br>";
	echo		"usuario publicidad ".$edi[0]['usuario_publicidad']."<br>";
    */
?>