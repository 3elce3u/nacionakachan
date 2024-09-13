<?php
if(isset($_POST['tok']) and isset($_POST['ema']))
{
    $cadena="";
    $cade=$_POST['tok'];
    $num=strlen($cade);
    for($i=0;$i<$num;$i++)
    {
        $cadena.=$cade[$i];
    }
    $enlace="<table style='border:solid 2px black; box-sizing:border-box;'><tr><th style='padding:5px; font-size:20px; background-color:#ccc;letter-spacing: 7px;'>".$cadena."</th></tr></table>";
    $to = $_POST['ema'];
    $subject = "NUEVA CONTRASEÑA";
    $message = "
    <html>
    <head>
    <title>NUEVA CONTRASEÑA</title>
    </head>
    <body>
    <h1>NUEVA CONTRASEÑA</h1>
    <p>Este email se genero automaticamente tras recibir una solicitud de restauración
    de contraseña en nuestro sitio web."."<br>"."código de verificación"."<br>".$enlace."<br>"."</p>
    </body>
    </html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: NOREPLY@tiendaonline.com" . "\r\n";
    mail($to, $subject, $message, $headers);
    echo "email ".$_POST['ema']. " token ".$_POST['tok'];
}
else
{
    echo "email ".$_POST['ema']. " token ".$_POST['tok'];
} 
?>