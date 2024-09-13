<?php
require_once("../class/class.php");
$usuario=new Usuarios;
$res=$usuario->nuecon($_POST['password'],$_POST['password2'],$_POST['token']);
if($res['estado']!="ok")
{
    $respuesta=json_encode($res);
    echo $respuesta;
    /*
   ?>
    <script language="JavaScript">
        window.onload = function() 
        {
            document.getElementById("uno").submit();
        };
    </script>
    <form method="POST" action="index.php" id="uno">
        <input type="hidden" name="token" value="<?php echo $res['token']; ?>">
        <input type="hidden" name="estado" value="<?php echo $res['estado']; ?>">
        <input type="hidden" name="titulo" value="<?php echo $res['titulo']; ?>">
        <input type="hidden" name="info" value="<?php echo $res['info']; ?>">
    </form>
    <?php 
    echo $res['fecha']."<br>";
    echo $res['fecha1']."<br>";
    echo $res['token']."<br>";
    echo $res['usuario_id']."<br>";
    echo $res['estado']."<br>";
    echo $res['password']."<br>";
    if($res['fecha']>$res['fecha1'])
    {
        echo "la de la bbdd es mayor";
    }
    else
    {
        echo "la otra es mayor";
    }*/
}
else
{
    $respuesta=json_encode($res);
    echo $respuesta;
    /*
    $enlace="<a href='http://localhost/index.php=token=".$res['token']."'>enlace</a>";
    $to = $res['email'];
    $subject = "NUEVA CONTRASEÑA";
    $message = "
    <html>
    <head>
    <title>NUEVA CONTRASEÑA</title>
    </head>
    <body>
    <h1>NUEVA CONTRASEÑA</h1>
    <p>Este email se genero automaticamente tras recibir una solicitud de restauración \r
    de contraseña en nuestro sitio web para continuar presione el siguiente ".$enlace." \r </p>
    </body>
    </html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: NOREPLY@tiendaonline.com" . "\r\n";
    mail($to, $subject, $message, $headers);
    echo $res['fecha']."<br>";
    echo $res['fecha1']."<br>";
    echo $res['token']."<br>";
    echo $res['usuario_id']."<br>";
    echo $res['estado']."<br>";
    echo $res['password']."<br>";
    if($recpas_fecha>=$refecha)
    {
        echo "la de la bbdd es mayor";
    }
    else
    {
        echo "la otra es mayor";
    }
     ?>
    <script language="JavaScript">
        window.onload = function() 
        {
            document.getElementById("uno").submit();
        };
    </script>
    <form method="POST" action="index.php" id="uno">
        <input type="hidden" name="estado" value="<?php echo $res['estado']; ?>">
        <input type="hidden" name="titulo" value="<?php echo $res['titulo']; ?>">
        <input type="hidden" name="info" value="<?php echo $res['info']; ?>">
    </form>
    <?php 
    */
}
?>