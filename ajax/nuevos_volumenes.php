<?php
require_once('../class/class.php');
$novel=new obra();
$nuevovideo=$novel->getultimosvideos();
$contador=sizeof($nuevovideo);
    for($j=0;$j<$contador;$j++)
    {
        $res[$j]['generos']="";
        $gener=explode(',',$nuevovideo[$j]['obra_generos']);
        $cont=sizeof($gener);
        
        for($y=0;$y<$cont-1;$y++)
        {
            $gen=$novel->getgenerosbyid($gener[$y]);
            if($y == $cont-2)
            {
                $res[$j]['generos'].="<div class='cuadgen'>".$gen[0]['genero']."</div>";
            }
            else
            {
                $res[$j]['generos'].="<div class='cuadgen'>".$gen[0]['genero']."</div>";
            }
        }
        $res[$j]['obra_id']=$nuevovideo[$j]['obra_id'];
        $res[$j]['obra_nombre']=$nuevovideo[$j]['obra_nombre'];
        $res[$j]['video_caratula']=$nuevovideo[$j]['video_caratula'];
        $res[$j]['alt']=$nuevovideo[$j]['tipo']." ".$nuevovideo[$j]['obra_nombre']." video del cap ".$nuevovideo[$j]['video_capitulo_inicio']." al cap ".$nuevovideo[$j]['video_capitulo_fin'];
        $res[$j]['video']="video del cap ".$nuevovideo[$j]['video_capitulo_inicio']." al cap ".$nuevovideo[$j]['video_capitulo_fin'];
        $fecha=$nuevovideo[$j]['video_fecha'];
        $joder=$novel->formatearf($fecha);
	    $res[$j]['fecha']=$joder;
        $res[$j]['video_nombre']=$nuevovideo[$j]['obra_nombre'];
        $res[$j]['video_id']=$nuevovideo[$j]['video_id'];
    }
    $response=json_encode($res);
    echo $response;
?>
