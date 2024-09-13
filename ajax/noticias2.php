<?php
require_once('../class/class.php');
$novel=new Obra();
$noti=$novel->feed("https://somoskudasai.com/feed/");
echo $noti;
?>