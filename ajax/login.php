<?php
require_once("../class/class.php");
$usuario=new Usuarios;
$res=$usuario->login($_POST['email'],$_POST['password']);
if($res['estado']!="ok")
{
    $respuesta=json_encode($res);
    echo $respuesta;
}
else
{
    session_start();
    session_regenerate_id();
    $_SESSION['authenticated'] = true;
    $_SESSION['id']=session_id();
    $_SESSION['usuario_id']=$res['usuario_id'];
    $_SESSION['nombre']=$res['nombre'];
    $_SESSION['avatar']=$res['avatar'];
    $_SESSION['fecha']=$res['fecha'];
    $_SESSION['email']=$res['email'];
    $_SESSION['estado']=$res['estado'];
    $_SESSION['puntos']=$res['puntos'];
    $respuesta=json_encode($res);
    echo $respuesta;
    /*session_set_cookie_params([
        'lifetime' => 86400,
        'path' => '/',
        'domain' => 'example.com',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);*/
}
?>