<?php
require_once("../class/class.php");
$usu=new Usuarios;
if(empty($_POST['usuario_id']) || empty($_POST['novela_id']) || empty($_POST['volumen_id']) || empty($_POST['tiempo']) || empty($_POST['duracion']))
{

}
else
{
    $usu->guardarvideo($_POST['novela_id'],$_POST['volumen_id'],$_POST['usuario_id'],$_POST['indice'],$_POST['tiempo'],$_POST['duracion']);
}

?>