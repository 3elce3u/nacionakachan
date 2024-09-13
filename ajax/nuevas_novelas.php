<?php
require_once('../class/class.php');
$novel= new Novela();
$nuevanovela=$novel->getultimasnovelas2();
$contador=sizeof($nuevanovela);
    for($j=0;$j<$contador;$j++)
    {
        $res[$j]['generos']="";
        $gener=explode(',',$nuevanovela[$j]['novela_generos']);
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
        $res[$j]['novela_id']=$nuevanovela[$j]['novela_id'];
        $res[$j]['novela_nombre']=$nuevanovela[$j]['novela_nombre'];
        $res[$j]['novela_miniatura']=$nuevanovela[$j]['novela_miniatura'];
        $res[$j]['alt']="Novela Ligera ".$nuevanovela[$j]['novela_nombre'];
        $fecha=$nuevanovela[$j]['novela_fecha_publicacion'];
        $joder=$novel->formatearf($fecha);
	    $res[$j]['fecha']=$joder;
        $res[$j]['novela_nombre']=$nuevanovela[$j]['novela_nombre'];
    }
    $response=json_encode($res);
    echo $response;
?>