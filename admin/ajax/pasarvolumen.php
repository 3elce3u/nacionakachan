<?php
require_once("../class/class.php");
$novel=new Novela;
$tras="";
$ras=$novel->pasarvolumen($_POST['novela_id']);
$tras.="<table><tr>";
for($i=0;$i<sizeof($ras);$i++)
{
    if($_POST['volumen_id']-1==$ras[$i]['volumen_id'])
    {
        $tras.= "<td><form method='GET' action='volumen.php' id='prevolumen'>
            <input type='hidden' name='volumen_id' id='volumen_id' value='".$ras[$i]['volumen_id']."'>
            <input type='hidden' name='novela_id' id='novela_id' value='".$_POST['novela_id']."'>
            <input type='hidden' name='novela_nombre' id='novela_nombre' value='".$_POST['novela_nombre']."'>
            <div class='boton2' onclick='$(`#prevolumen`).submit()'; >".$ras[$i]['volumen']."</div>
        </form></td>";
    }
    else{}
    if($ras[$i]['volumen_id']==$_POST['volumen_id'])
    {
        $tras.= "<td><b> Volumen ".$ras[$i]['volumen']."</b></td>";
    }
    if($_POST['volumen_id']+1==$ras[$i]['volumen_id'])
    {
        $tras.= "<td><form method='GET' action='volumen.php' id='posvolumen'>
            <input type='hidden' name='volumen_id' id='volumen_id' value='".$ras[$i]['volumen_id']."'>
            <input type='hidden' name='novela_id' id='novela_id' value='".$_POST['novela_id']."'>
            <input type='hidden' name='novela_nombre' id='novela_nombre' value='".$_POST['novela_nombre']."'>
            <div class='boton2' onclick='$(`#posvolumen`).submit()'; >".$ras[$i]['volumen']."</div>
        </form></td>";
    }
    else{}
}
$tras.="</tr></table>";
echo $tras;
?>