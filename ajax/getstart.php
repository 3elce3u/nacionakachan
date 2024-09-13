<?php
require_once("../class/class.php");
$usu=new Usuarios;
if(empty($_POST['usuario_id']))
{

}
else
{
    $res=$usu->getstart($_POST['volumen_id'],$_POST['usuario_id'],$_POST['indice']);
    if(!empty($res))
    {
        $ras=json_encode($res);
        echo $ras;
    }
}

?>