<?php
require_once('../class/class.php');
$usu=new Usuarios;
echo $like=$usu->getAvatarByUsuarioId($_POST['usuario_id']);

?>