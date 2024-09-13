<?php
require_once('../class/class.php');
$usu=new Usuarios;
$res=$usu->nickunico($_POST['nombr']);
$reg=json_encode($res);
echo $reg;
?>