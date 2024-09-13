<?php
require_once('../class/class.php');
$com=new Comentarios;
$com->update_comentarios($_POST['usuario_id'],$_POST['comentario_id'],$_POST['comentario']);
?>