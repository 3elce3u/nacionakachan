<?php
require_once("../class/class.php");
$novel=new Obra;
$tras="";
$ras=$novel->pasarvideo($_POST['obra_id']);
$tras.="<table><tr>";
for($i=0;$i<sizeof($ras);$i++)
{
    if($_POST['video_id']-1==$ras[$i]['video_id'])
    {
        $tras.= "<td><form method='GET' action='video.php' id='prevideo'>
            <input type='hidden' name='video_id' id='video_id' value='".$ras[$i]['video_id']."'>
            <input type='hidden' name='obra_id' id='obra_id' value='".$_POST['obra_id']."'>
            <input type='hidden' name='obra_nombre' id='obra_nombre' value='".$_POST['obra_nombre']."'>
            <div class='boton2' onclick='$(`#prevideo`).submit()'; > << </div>
        </form></td>";
    }
    else{}
    if($ras[$i]['video_id']==$_POST['video_id'])
    {
        $tras.= "<td><b> Del cap ".$ras[$i]['video_capitulo_inicio']." al cap ".$ras[$i]['video_capitulo_fin'].  "</b></td>";
    }
    if($_POST['video_id']+1==$ras[$i]['video_id'])
    {
        $tras.= "<td><form method='GET' action='video.php' id='posvideo'>
            <input type='hidden' name='video_id' id='video_id' value='".$ras[$i]['video_id']."'>
            <input type='hidden' name='obra_id' id='obra_id' value='".$_POST['obra_id']."'>
            <input type='hidden' name='obra_nombre' id='obra_nombre' value='".$_POST['obra_nombre']."'>
            <div class='boton2' onclick='$(`#posvideo`).submit()'; > >> </div>
        </form></td>";
    }
    else{}
}
$tras.="</tr></table>";
echo $tras;
?>