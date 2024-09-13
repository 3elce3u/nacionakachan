<?php
require_once('../class/class.php');
$novel=new Obra();
$genfil=$novel->getgeneros();
for($u=0;$u<sizeof($genfil);$u++)
{
    $res[$u]['genero_id']=$genfil[$u]['genero_id'];
    $res[$u]['genero']=$genfil[$u]['genero'];
}
$response=json_encode($res);
echo $response;
?>