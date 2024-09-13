<?php
require_once("../class/class.php");
$usu=new Usuarios;
if(empty($_POST['usuario_id']))
{

}
else
{
    $res=$usu->getvisualizaciones($_POST['novela_id'],$_POST['volumen_id'],$_POST['indice'],$_POST['usuario_id']);
    if(!empty($res))
    {
        $ras=json_encode($res);
        echo $ras;
    }
}

?>