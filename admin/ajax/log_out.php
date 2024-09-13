<?php
    session_start();
    session_destroy();
    /*setcookie(session_name(), '', time() - 86400, '/', 'example.com', true, true);*/
    unset($_SESSION['id']);
    unset($_SESSION['usuario_id']) ;
    unset($_SESSION['nombre']) ;
    unset($_SESSION['apellidos']) ;
    unset($_SESSION['fecha']);
    unset($_SESSION['email']);
    unset($_SESSION['estado']);
    $_SESSION = array();
    
    if(isset($_COOKIE[session_name()])) 
    { 
        setcookie(session_name(), '', time() -259200, '/'); 
    }
    /*session_destroy();
    unset($_COOKIE["PHPSESSID"]);
    setcookie("usuario_id",$res[0]['usuario_id'],time()-259200);
    setcookie("nombre",$res[0]['nombre'],time()-259200);
    setcookie("apellidos",$res[0]['apellidos'],time()-259200);
    setcookie("fecha",$res[0]['fecha'],time()-259200);
    setcookie("email",$res[0]['email'],time()-259200);*/
    header("location: ../index.php");
?>