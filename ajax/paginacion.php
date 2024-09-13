<?php
require_once('../class/class.php');
$novel=new Obra();
if(isset($_POST['typo']))
{
$typo=$_POST['typo'];
}
else
{
$typo="";
}
if(isset($_POST['filtro']))
{
$filtro=$_POST['filtro'];
}
else
{
$filtro="";
}
if(isset($_POST['pagina']))
{
$pagina=$_POST['pagina'];
}
else
{
$pagina="";
}
$paginacio=$novel->paginacion($typo,$filtro,$pagina);
if(!empty($paginacio))
{
    echo $paginacio;
}

?>