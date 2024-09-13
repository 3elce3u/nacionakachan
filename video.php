<?php
session_start();
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    session_regenerate_id();
    $_SESSION['authenticated'] = true;
}
?>
<!DOCTYPE html>
<html class="no-js" lang="es-ES">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VIDEO</title>
    <!-- style and script resources -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/ajax.js"></script>
    <!--favicon-->
    <link rel="icon" href="recursos/iconos/favicon.png" sizes="32x32" />
</head>

<body id="body" onload="video(<?php echo $_GET['obra_id'] . ',`' . $_GET['video_id'] . '`'; ?>),comentarios(<?php echo $_GET['obra_id'] . ',`' . $_GET['video_id'] . '`'; ?>)">
    <!-- PANEL DE ALERTA 1 -->
    <div class="alert-bien" id="bien">
        <div class="close" onclick="$('#bien').toggle('none');"> x </div>
        <div class="title" id="bien-title"></div>
        <div class="info" id="bien-info"></div>
        <button class="cerrar" onclick="$('#bien').toggle('none');">cerrar</button>
    </div>
    <!-- PANEL DE ALERTA 2 -->
    <div class="alert-mal" id="mal">
        <div class="close" onclick="$('#mal').toggle('none');"> x </div>
        <div class="title" id="mal-title"></div>
        <div class="info" id="mal-info"></div>
        <button class="cerrar" onclick="$('#mal').toggle('none');">cerrar</button>
    </div>
    <div class="contenedor" id="contenedor">
        <div class="margi" id="margi"></div>
        <div class="nav" id="nav"></div>
        <div class="headerr" id="headerr"></div>
        <div class="main_nav" id="main_nav">
            <form method="post" action="index.php" id="form1"></form>
            <form method="post" action="novelas.php" id="form2"></form>
            <div class="menuno" id="menuno">
                <ul>
                    <li class="main__boton1" onclick="$('#form1').submit();">INICIO</li>
                    <li class="main__boton1" onclick="$('#form2').submit();">OBRAS</li>
                </ul>
            </div>
            <div class="mendos" id="mendos">
                <ul class="icones" <?php if (isset($_SESSION['usuario_id'])) { ?>
                        onmouseenter="$('#pan_per').css('display','flex');"
                        onmouseleave="$('#pan_per').css('display','none');" <?php } else { ?> onclick="loginn();" <?php } ?>>
                    <li class="jur">
                        <div class="icolog">
                            <div class="unoo">
                            </div>
                            <div class="doss">
                            </div>
                        </div>
                        <ul class="pan_per" id="pan_per" onmouseenter="$('#pan_per').css('display','flex');"
                            onmouseout="$('#pan_per').css('display','none');">
                            <li class="un" onclick="location.href='perfil.php'"
                                onmouseenter="$('#pan_per').css('display','flex');"
                                onmouseout="$('#pan_per').css('display','none');">PERFIL</li>
                            <li class="un" onclick="location.href='ajax/log_out.php'"
                                onmouseenter="$('#pan_per').css('display','flex');"
                                onmouseout="$('#pan_per').css('display','none');">LOGOUT</li>
                        </ul>
                    </li>
                    <li class="nn">
                        <?php if (isset($_SESSION['usuario_id'])) {
                            echo $_SESSION['nombre'];
                        } ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="asidea" id="asidea">
            <h2>NOTICIAS</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='recursos/iconos/menu.webp' height="25" width="25" onClick="$('#noticias').toggle();"
                    alt="menu" />
            </div>
            <div class="noticias" id="noticias">

            </div>
            <h2>DONACIONES</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='recursos/iconos/menu.webp' height="25" width="25" onClick="$('#dona').toggle();" alt="menu" />
            </div>
            <div class="dona" id="dona">
                <img src="recursos/iconos/DONAR2.webp" alt="Donar" onMouseOver="src='recursos/iconos/DONAR.webp'"
                    onMouseOut="src='recursos/iconos/DONAR2.webp'"
                    style="height:auto; width: 100%; margin:50px 0px; cursor:pointer; display: block;" />
            </div>
        </div>
        <div class="main" id="main">
            <h2>VIDEO</h2>
            <div class="volumen" id="volumen">

            </div>
            <h2 style="margin-top:20px;">COMENTARIOS</h2>
            <div class="mainComent" id="mainComent">
                <div class="comentAvatar" id="comentAvatar" style="width:150px !important;">
                    &nbsp;
                </div>
                <div class="comentar" id="comentar">
                    <form id="newcomentario">
                        <input type="hidden" id="obraId" name="obra_id" value="<?php echo $_GET['obra_id']; ?>">
                        <input type="hidden" id="obraNombre" name="obra_nombre" value="<?php echo $_GET['obra_nombre']; ?>">
                        <input type="hidden" id="videoId" name="video_id" value="<?php echo $_GET['video_id']; ?>">
                        <input type="hidden" id="usuarioId" name="usuario_id" value="<?php if (isset($_SESSION['usuario_id'])) {echo $_SESSION['usuario_id'];} ?>">
                        <div class="comentCaja">
                            <textarea name="comentario" id="comentario" placeholder="ESCRIBE AQUÍ TU COMENTARIO..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="bbc">
                    <div class="bt1">
                        <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                            <img onclick="negrita();" height="25" width="25" id="Bold" title="Bold" alt="Bold"
                                src="recursos/iconos/bold.png">
                        </button>
                    </div>
                    <div class="bt2">
                        <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                            <img onclick="italica();" height="25" width="25" id="Italic" title="Italic" alt="Italic"
                                src="recursos/iconos/italic.png">
                        </button>
                    </div>
                    <div class="bt3">
                        <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                            <img onclick="subrayado();" height="25" width="25" id="Underline" title="Underline"
                                alt="Underline" src="recursos/iconos/underline.png">
                        </button>
                    </div>
                    <div class="bt4">
                        <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                            <img onclick="tachado();" height="25" width="25" id="Strikethrough" title="Strikethrough"
                                alt="Strikethrough" src="recursos/iconos/strikethrough.png">
                        </button>
                    </div>
                    <div class="bt5">
                        <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                            <img onclick="enlace();" height="25" width="25" id="Link" title="Link" alt="Link"
                                src="recursos/iconos/link-alt.png">
                        </button>
                    </div>
                    <div class="bt6">
                        <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                            <img onclick="spoiler();" height="25" width="25" id="Spoiler" title="Spoiler" alt="Spoiler"
                                src="recursos/iconos/crossed-eye.png">
                        </button>
                    </div>
                    <div class="bt7">
                        <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                            <img onclick="cita();" height="25" width="25" id="Quotes" title="Quotes" alt="Quotes"
                                src="recursos/iconos/quote-right.png">
                        </button>
                    </div>
                    <div class="bt8">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="XD();" id="XD" style="margin:0; padding:0; border-radius:100%;" title="XD"
                                alt="CD" height="25" width="25" src="recursos/iconos/XD.webp">
                        </button>
                    </div>
                    <div class="bt9">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="XP();" id="XP" style="margin:0; padding:0; border-radius:100%;" title="XP"
                                alt="XP" height="25" width="25" src="recursos/iconos/XP.webp">
                        </button>
                    </div>
                    <div class="bt10">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="feliz();" id="feliz" style="margin:0; padding:0; border-radius:100%;"
                                title="feliz" alt="feliz" height="25" width="25" src="recursos/iconos/feliz.webp">
                        </button>
                    </div>
                    <div class="bt11">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="guino();" id="guino" style="margin:0; padding:0; border-radius:100%;"
                                title="guino" alt="guino" height="25" width="25" src="recursos/iconos/guino.webp">
                        </button>
                    </div>
                    <div class="bt12">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="mareo();" id="mareo" style="margin:0; padding:0; border-radius:100%;"
                                title="mareo" alt="mareo" height="25" width="25" src="recursos/iconos/mareo.webp">
                        </button>
                    </div>
                    <div class="bt13">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="triste();" id="triste" style="margin:0; padding:0; border-radius:100%;"
                                title="triste" alt="triste" height="25" width="25" src="recursos/iconos/triste.webp">
                        </button>
                    </div>
                    <div class="bt14">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="llorar();" id="llorar" style="margin:0; padding:0; border-radius:100%;"
                                title="llorar" alt="llorar" height="25" width="25" src="recursos/iconos/llorar.webp">
                        </button>
                    </div>
                    <div class="bt15">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="insulto();" id="insulto" style="margin:0; padding:0; border-radius:100%;"
                                title="insulto" alt="insulto" height="25" width="25" src="recursos/iconos/insulto.webp">
                        </button>
                    </div>
                    <div class="bt16">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="corazon();" id="corazon" style="margin:0; padding:0; border-radius:100%;"
                                title="corazon" alt="corazon" height="25" width="25" src="recursos/iconos/corazon.webp">
                        </button>
                    </div>
                    <div class="bt17">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="contento();" id="contento" style="margin:0; padding:0; border-radius:100%;"
                                title="contento" alt="contento" height="25" width="25"
                                src="recursos/iconos/contento.webp">
                        </button>
                    </div>
                    <div class="bt18">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="durmiendo();" id="durmiendo" style="margin:0; padding:0; border-radius:100%;"
                                title="durmiendo" alt="durmiendo" height="25" width="25"
                                src="recursos/iconos/durmiendo.webp">
                        </button>
                    </div>
                    <div class="bt19">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="frustracion();" id="frustracion"
                                style="margin:0; padding:0; border-radius:100%;" title="frustracion" alt="frustracion"
                                height="25" width="25" src="recursos/iconos/frustracion.webp">
                        </button>
                    </div>
                    <div class="bt20">
                        <button
                            style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                            <img onclick="desaprobacion();" id="desaprobacion"
                                style="margin:0; padding:0; border-radius:100%;" title="desaprobacion"
                                alt="desaprobacion" height="25" width="25" src="recursos/iconos/desaprobacion.webp">
                        </button>
                    </div>
                    <div class="btComent">
                        <button class="boton" id="newComent">COMENTAR</button>
                    </div>
                </div>
            </div>
            <div class="pre-view" id="pre-view">
                <div class="dat-usu" id="dat-usu">
                    <div class="pre-avatar" id="pre-avatar">
                        <?php if (isset($_SESSION['usuario_id'])) {echo '<img src="' . $_SESSION['avatar'] . '" style="height:155px; width:155px;">';} ?>
                    </div>
                    <div class="pre-nick" id="pre-nick">
                        <?php if (isset($_SESSION['usuario_id'])) { echo $_SESSION['nombre'];} ?>
                    </div>
                </div>
                <div class="pre-coment" id="pre-coment">

                </div>
            </div>
            <div class="comentarios" id="comentarios">

            </div>
            <div class="comentarfixed" id="comentarfixed">
                <div class="botoncito" onclick="cerrarrespuesta();">
                    CERRAR
                </div>
                <div class="mainComent" id="mainComent">
                    <div class="comentAvatar" id="comentAvatar" style="width:150px !important;">
                        
                    </div>

                    <div class="comentar" id="comentar">
                        <form id="newcomentario2">
                            <input type="hidden" id="obraId2" name="obra_id" value="">
                            <input type="hidden" id="videoId2" name="video_id" value="">
                            <input type="hidden" id="comentarioId2" name="comentario_id" value="">
                            <input type="hidden" id="usuarioId2" name="usuario_id" value="<?php if (isset($_SESSION['usuario_id'])) {
                                echo $_SESSION['usuario_id'];
                            } ?>">
                            <div class="comentCaja">
                                <textarea name="comentario" id="comentario2"
                                    placeholder="ESCRIBE AQUÍ TU COMENTARIO..."></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="bbc">
                        
                        <div class="bt1">
                            <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                                <img onclick="negrita2();" height="25" width="25" id="Bold2" title="Bold" alt="Bold"
                                    src="recursos/iconos/bold.png">
                            </button>
                        </div>
                        <div class="bt2">
                            <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                                <img onclick="italica2();" height="25" width="25" id="Italic2" title="Italic"
                                    alt="Italic" src="recursos/iconos/italic.png">
                            </button>
                        </div>
                        <div class="bt3">
                            <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                                <img onclick="subrayado2();" height="25" width="25" id="Underline2" title="Underline"
                                    alt="Underline" src="recursos/iconos/underline.png">
                            </button>
                        </div>
                        <div class="bt4">
                            <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                                <img onclick="tachado2();" height="25" width="25" id="Strikethrough2"
                                    title="Strikethrough" alt="Strikethrough" src="recursos/iconos/strikethrough.png">
                            </button>
                        </div>
                        <div class="bt5">
                            <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                                <img onclick="enlace2();" height="25" width="25" id="Link2" title="Link" alt="Link"
                                    src="recursos/iconos/link-alt.png">
                            </button>
                        </div>
                        <div class="bt6">
                            <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                                <img onclick="spoiler2();" height="25" width="25" id="Spoiler2" title="Spoiler"
                                    alt="Spoiler" src="recursos/iconos/crossed-eye.png">
                            </button>
                        </div>
                        <div class="bt7">
                            <button style="cursor:pointer; height:29px; width:29px; padding:0;">
                                <img onclick="cita2();" height="25" width="25" id="Quotes2" title="Quotes" alt="Quotes"
                                    src="recursos/iconos/quote-right.png">
                            </button>
                        </div>
                        <div class="bt8">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="XD2();" id="XD2" style="margin:0; padding:0; border-radius:100%;"
                                    title="XD" alt="CD" height="25" width="25" src="recursos/iconos/XD.webp">
                            </button>
                        </div>
                        <div class="bt9">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="XP2();" id="XP2" style="margin:0; padding:0; border-radius:100%;"
                                    title="XP" alt="XP" height="25" width="25" src="recursos/iconos/XP.webp">
                            </button>
                        </div>
                        <div class="bt10">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="feliz2();" id="feliz2" style="margin:0; padding:0; border-radius:100%;"
                                    title="feliz" alt="feliz" height="25" width="25" src="recursos/iconos/feliz.webp">
                            </button>
                        </div>
                        <div class="bt11">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="guino2();" id="guino2" style="margin:0; padding:0; border-radius:100%;"
                                    title="guino" alt="guino" height="25" width="25" src="recursos/iconos/guino.webp">
                            </button>
                        </div>
                        <div class="bt12">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="mareo2();" id="mareo2" style="margin:0; padding:0; border-radius:100%;"
                                    title="mareo" alt="mareo" height="25" width="25" src="recursos/iconos/mareo.webp">
                            </button>
                        </div>
                        <div class="bt13">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="triste2();" id="triste2" style="margin:0; padding:0; border-radius:100%;"
                                    title="triste" alt="triste" height="25" width="25"
                                    src="recursos/iconos/triste.webp">
                            </button>
                        </div>
                        <div class="bt14">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="llorar2();" id="llorar2" style="margin:0; padding:0; border-radius:100%;"
                                    title="llorar" alt="llorar" height="25" width="25"
                                    src="recursos/iconos/llorar.webp">
                            </button>
                        </div>
                        <div class="bt15">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="insulto2();" id="insulto2"
                                    style="margin:0; padding:0; border-radius:100%;" title="insulto" alt="insulto"
                                    height="25" width="25" src="recursos/iconos/insulto.webp">
                            </button>
                        </div>
                        <div class="bt16">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="corazon2();" id="corazon2"
                                    style="margin:0; padding:0; border-radius:100%;" title="corazon" alt="corazon"
                                    height="25" width="25" src="recursos/iconos/corazon.webp">
                            </button>
                        </div>
                        <div class="bt17">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="contento2();" id="contento2"
                                    style="margin:0; padding:0; border-radius:100%;" title="contento" alt="contento"
                                    height="25" width="25" src="recursos/iconos/contento.webp">
                            </button>
                        </div>
                        <div class="bt18">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="durmiendo2();" id="durmiendo2"
                                    style="margin:0; padding:0; border-radius:100%;" title="durmiendo" alt="durmiendo"
                                    height="25" width="25" src="recursos/iconos/durmiendo.webp">
                            </button>
                        </div>
                        <div class="bt19">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="frustracion2();" id="frustracion2"
                                    style="margin:0; padding:0; border-radius:100%;" title="frustracion"
                                    alt="frustracion" height="25" width="25" src="recursos/iconos/frustracion.webp">
                            </button>
                        </div>
                        <div class="bt20">
                            <button
                                style="cursor:pointer; height:29px; width:29px; padding:0; border-radius:100%; border:none;">
                                <img onclick="desaprobacion2();" id="desaprobacion2"
                                    style="margin:0; padding:0; border-radius:100%;" title="desaprobacion"
                                    alt="desaprobacion" height="25" width="25" src="recursos/iconos/desaprobacion.webp">
                            </button>
                        </div>
                        <div class="btComent">
                            <input type="hidden" id="control" name="control" value="">
                            <button class="boton" style="display:none;" id="newComent2"
                                style="margin-top:-3px; margin-right:3px; box-sizing: border-box;">COMENTAR</button>
                            <button class="boton" style="display:none;" id="newEdit"
                                style="margin-top:-3px; margin-right:3px; box-sizing: border-box;">EDITAR</button>
                            <script>
                                if ($('#control').val() === 'ok') {
                                    $('#newEdit').css('display', 'block');
                                    $('#newComent2').css('display', 'none');
                                }
                                else {
                                    $('#newEdit').css('display', 'none');
                                    $('#newComent2').css('display', 'block');
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <div class="pre-view2" id="pre-view2">
                    <div class="dat-usu2" id="dat-usu2">
                        <div class="pre-avatar2" id="pre-avatar2">
                            <?php if (isset($_SESSION['usuario_id'])) {
                                echo '<img src="' . $_SESSION['avatar'] . '" style="height:155px; width:155px;">';
                            } ?>
                        </div>
                        <div class="pre-nick2" id="pre-nick2">
                            <?php if (isset($_SESSION['usuario_id'])) {
                                echo $_SESSION['nombre'];
                            } ?>
                        </div>
                    </div>
                    <div class="pre-coment2" id="pre-coment2">

                    </div>
                </div>
            </div>
        </div>
    <div class="asideb" id="asideb">
    <h2>ÚLTIMOS CAPÍTULOS</h2>
        <div class="ico_ocul" id="ico_ocul">
            <img src='recursos/iconos/menu.webp' height="25" width="25" onClick="$('#nue_vol').toggle();" alt="menu" />
        </div>
        <div class="nue_vol" id="nue_vol">

        </div>
        <h2>REDES SOCIALES</h2>
        <div class="ico_ocul" id="ico_ocul">
            <img src='recursos/iconos/menu.webp' height="25" width="25" onClick="$('#nue_nov').toggle();" alt="menu" />
        </div>
        <div class="nue_nov" id="nue_nov">

        </div>
        <h2>PATROCINAR OBRA</h2>
        <div class="ico_ocul" id="ico_ocul">
            <img src='recursos/iconos/menu.webp' height="25" width="25" onClick="$('#top_des').toggle();" alt="menu" />
        </div>
        <div class="top_des" id="top_des">
        <?php 
                if(!empty($_SESSION['nombre']))
                {
            ?>
                <table>
                    <tr>
                        <td style="height:30px;">
                            <b>USUARIO</b>
                        </td>
                        <td>
                            <?php 
                                if(!empty($_SESSION['nombre'])){echo $_SESSION['nombre'];}else{echo "";} 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:30px;">
                            <b>TUS PUNTOS</b>
                        </td>
                        <td>
                            <?php 
                                if(!empty($_SESSION['puntos'])){echo "<div id='tuspuntos'>".$_SESSION['puntos']."<div>";}else{echo "0";}
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:30px;">
                            <b>COSTE</b>
                        </td>
                        <td>
                            <?php 
                               echo "50000 Puntos";
                            ?>
                        </td>
                    </tr>
                    <?php
                    if(!empty($_SESSION['puntos']))
                    {

                    
                        if($_SESSION['puntos']>=50000)
                        {
                    ?>
                    <tr>
                        <td>
                            <b>TIPO</b>
                        </td>
                        <td>
                            <form method='post'  id='patrocinio'>
                            <input type='hidden' name='usuario_id' id="usua_ide" value="<?php if(!empty($_SESSION['usuario_id'])){ echo $_SESSION['usuario_id'];} ?>">
                            <input type='hidden' name='puntos' id="puntos" value="<?php if(!empty($_SESSION['puntos'])){ echo $_SESSION['puntos'];} ?>">
                            <input type='hidden' name='coste' id="coste" value="-50000">
                            <input type='hidden' name='causa' id="causa"  value="Patrocinio">
                            <select name='tipo' id="pat_tipo" style="height:30px;">
                                <option value=''></option>
                                <option value='1'>Manga</option>
                                <option value='2'>Manhwa</option>
                                <option value='3'>Manhua</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <b>OBRA</b> 
                        </td>
                        <td>
                            <input type='text' name='obra' id="nombreobra" placeholder="Nombre de la obra" style="height:30px; width:98%; margin:0px; padding:0px;">
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' style="height:30px;">
                            <b>DETALLES DE LA OBRA</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <textarea name='nota' id="nota" placeholder="Ejemplo fansub, web, número de capítulos, etc" style="height:200px; width:99%; resize:none; margin:0px; padding:0px;" ></textarea>
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <input type='button' id="patroc" value="PATROCINAR OBRA" style="height:30px; width:99%; resize:none; margin:0px; padding:0px; cursor:pointer;" ></input>
                            </form>
                        </td>
                    </tr>
                </table>
                    <?php
                        }
                        else
                        {
                            ?>
                    <tr>
                        <td colspan='2'>
                            <?php echo "PUNTOS INSUFICIENTES";?>
                        </td>
                    </tr>
                </table>
                <?php
                        }
                        
                    }
                }
                ?>
        </div>
    </div>
    <div class="footer" id="footer"></div>
    <div class="margd" id="margd"></div>
    </div>
</body>

</html>