<?php
require_once("../class/class.php");
$novela=new Novela;

	$nov=$novela->sumardescargaporvolumenid($_POST['volumen_id'],$_POST['novela_id']);

	?>