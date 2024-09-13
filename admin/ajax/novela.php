<?php
require_once('../class/class.php');
$novel=new Novela();
$edi=$novel->getnovelabyid($_POST['novela_id'],$_POST['novela_nombre']);
$vol=$novel->getvolumenesbynovelaid($_POST['novela_id']);
    $res['caratula']='<img height="320" width="220" src="'.$edi[0]['novela_caratula'].'" alt="Novela Ligera '.$edi[0]['novela_nombre'].'">';
    $res['novela_nombre']="<strong>".$edi[0]['novela_nombre']."</strong>";
    $res['nombre_original']= $edi[0]['novela_nombre_original'];
    $gener=explode(',',$edi[0]['novela_generos']);
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
    $res['nombre']="<div style='width:100%;'><div style='border:solid 1px #ccc; border-radius:5px; width:80px; float:left; background-color: rgba(208, 91, 255, 0.3); padding:5px;'>Escritor </div>&nbsp; <strong>".$edi[0]['escritor_nombre']."</strong></div>";
    $res['ilustrador']="<div style='width:100%;'><div style='border:solid 1px #ccc; border-radius:5px; width:80px; float:left; background-color: rgba(208, 91, 255, 0.3); padding:5px;'>Ilustrador </div>&nbsp; <strong>".$edi[0]['ilustrador_nombre']."</strong></div>";
    $res['editorial']="<div style='width:100%;'><div style='border:solid 1px #ccc; border-radius:5px; width:80px; float:left; background-color: rgba(208, 91, 255, 0.3); padding:5px;'>Editorial </div>&nbsp; <a target='_blank' href=".$edi[0]['editorial_enlace']."><strong>".$edi[0]['editorial_nombre']."</strong></a></div>";
    $res['fansub']="<div style='width:100%;'><div style='border:solid 1px #ccc; border-radius:5px; width:80px; float:left; background-color: rgba(208, 91, 255, 0.3); padding:5px;'>Fansub </div>&nbsp; <a target='_blank' href='".$edi[0]['fansub_enlace']."'><strong>". $edi[0]['fansub_nombre']."</strong></a></div>";
    $res['sinopsis']="<blockquote>".$edi[0]['novela_sinopsis']."</blockquote>";
    $cuenta=sizeof($vol);
    $bre=0;
    $res['volumenes']="";
    $marca="volumen".$x;
    for($x=0;$x<$cuenta;$x++)
    {
        $marca="volmen".$x;
        $res['volumenes'].='
                            <form method="get" action="volumen.php" id="'.$marca.'">
                                <input type="hidden" name="volumen_id" value="'.$vol[$x]['volumen_id'].'">
                                <input type="hidden" name="novela_id" value="'.$vol[$x]['novela_id'].'">
                                <input type="hidden" name="novela_nombre" value="'.$edi[0]['novela_nombre'].'">
                            </form>
            <div class="volumu">
                <a onClick="$(`#'.$marca.'`).submit();" title="Volumen '.$vol[$x]['volumen'].'">
                    <img class="volumi" src="'.$vol[$x]['volumen_miniatura'].'" alt="Novela Ligera '.$edi[0]['novela_nombre'].' Volumen '.$vol[$x]['volumen'].'">
                </a>
                VOLUMEN '.$vol[$x]['volumen'].'</div>';
    }
    $resultado=json_encode($res);
    echo $resultado;
?>