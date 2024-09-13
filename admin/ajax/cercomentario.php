<?php
require_once("../class/class.php");
$com=new Comentarios;
$res=$com->get_comentariosbycomentarioid($_POST['comentario_id']);
/*$res=$com->get_comentariosbycomentarioid(40);*/
$reg=json_encode($res);
echo $reg;
?>