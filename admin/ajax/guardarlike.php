<?php
session_start();
require_once('../class/class.php');
$com=new Comentarios;
$com->guardarlike($_POST['comentario_id'],$_SESSION['usuario_id']);
?>