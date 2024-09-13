<?php
require_once('../class/class.php');
$novel= new Novela();
$maspopu=$novel->contartotaldescargasnovela2();
$contador=sizeof($maspopu);
    for($j=0;$j<$contador;$j++)
    {
        $res[$j]['generos']="";
        $gener=explode(',',$maspopu[$j]['novela_generos']);
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
        $res[$j]['novela_id']=$maspopu[$j]['novela_id'];
        $res[$j]['novela_nombre']=$maspopu[$j]['novela_nombre'];
        $res[$j]['novela_miniatura']="../".$maspopu[$j]['novela_miniatura'];
        $res[$j]['alt']="Novela Ligera ".$maspopu[$j]['novela_nombre'];
        $res[$j]['descargas']=$maspopu[$j]['dt_numero']." -Descargas";
        $res[$j]['novela_nombre']=$maspopu[$j]['novela_nombre'];
    }
    $response=json_encode($res);
    echo $response;
?>