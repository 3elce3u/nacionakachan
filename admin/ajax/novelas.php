<?php
require_once('../class/class.php');
$novel=new obra();
if(!empty($_POST['filtro']))
{
	$filtro=$_POST['filtro'];
}
else
{
	$filtro="";
}
if(!empty($_POST['typo']))
{
	$typo=$_POST['typo'];
}
else
{
	$typo="";
}
if(!empty($_POST['pagina']))
{
	$pagina=$_POST['pagina'];
}
else
{
	$pagina="";
}
$nov=$novel->getobras($filtro,$typo,$pagina);
$cou=sizeof($nov);
for($i=0;$i<$cou;$i++)
{
    $tip=$novel->get_tipos_by_id($nov[$i]['tipo_id']);
    $res[$i]['cou']=$cou;
    $res[$i]['obra_generos']="";
	$res[$i]['obra_id']= $nov[$i]['obra_id'];
	$res[$i]['obra_nombre']=$nov[$i]['obra_nombre'];
	$res[$i]['obra_caratula']="../".$nov[$i]['obra_caratula'];  
    $res[$i]['alt']="obra ".$nov[$i]['obra_nombre'];
        $primero=substr($nov[$i]['obra_nombre'], 0, 1);
        $resto=substr($nov[$i]['obra_nombre'], 1);
	$res[$i]['tipo']=$tip['tipo']; 
    if($nov[$i]['tipo_id']==1)
    {
        $res[$i]["color"]="rgba(0, 191, 255, 0.5)";
    }
    if($nov[$i]['tipo_id']==2)
    {
        $res[$i]["color"]="rgba(0, 250, 154, 0.5)";
    }
    if($nov[$i]['tipo_id']==3)
    {
        $res[$i]["color"]="rgba(139, 69, 19, 0.5)";
    }
        $sepa="_";
        $generost="";
        $gener=explode(',',$nov[$i]['obra_generos']);
        $cont=sizeof($gener);
        $x=0;
	for($y=0;$y<$cont-1;$y++)
	{
		$gen=$novel->getgenerosbyid($gener[$y]);
        if($y == $cont-2)
        {
            $res[$i]['obra_generos'].="<div name='genn".$gen[0]['genero_id']."' class='cuadgenn'>".$gen[0]['genero']."</div>";
        }
        else
        {
            $res[$i]['obra_generos'].="<div name='genn".$gen[0]['genero_id']."' class='cuadgenn'>".$gen[0]['genero']."</div>";
        }
    }
    if(strlen($nov[$i]['obra_sinopsis'])>499)
    {
        $gyu=$novel->sacarUltimaPalabra($nov[$i]['obra_sinopsis']);
        $res[$i]['obra_sinopsis']=$gyu."...</p>";
    }
    else
    {
        $res[$i]['obra_sinopsis']=$nov[$i]['obra_sinopsis'];
    }
    
}
$response=json_encode($res);
echo $response;
?>