<?php
require_once('../class/class.php');
$novel=new Novela();
$nuevovolumen=$novel->getultimosvolumenes2();
$contador=sizeof($nuevovolumen);
    for($j=0;$j<$contador;$j++)
    {
        $res[$j]['generos']="";
        $gener=explode(',',$nuevovolumen[$j]['novela_generos']);
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
        $res[$j]['novela_id']=$nuevovolumen[$j]['novela_id'];
        $res[$j]['novela_nombre']=$nuevovolumen[$j]['novela_nombre'];
        $res[$j]['volumen_miniatura']="../".$nuevovolumen[$j]['volumen_miniatura'];
        $res[$j]['alt']="Novela Ligera ".$nuevovolumen[$j]['novela_nombre']." Volumen ".$nuevovolumen[$j]['volumen'];
        $res[$j]['volumen']="Volumen ".$nuevovolumen[$j]['volumen'];
        $fecha=$nuevovolumen[$j]['novela_fecha_publicacion'];
        $joder=$novel->formatearf($fecha);
	    $res[$j]['fecha']=$joder;
        $res[$j]['volumen_nombre']=$nuevovolumen[$j]['novela_nombre'];
        $res[$j]['volumen_id']=$nuevovolumen[$j]['volumen_id'];
    }
    $response=json_encode($res);
    echo $response;
?>
