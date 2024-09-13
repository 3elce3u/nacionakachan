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
    <meta name="description" content="En esta web podras leer o escuchar novelas ligeras japonesas totalmente gratis.">
    <title>NOVELAS</title>
    <!-- style and script resources -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/ajax.js"></script>
    <!--favicon-->
    <link rel="icon" href="../recursos/iconos/favicon.png" sizes="32x32" />
</head>

<body id="body">
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
            <form method="post" action="novelas.php" id="form1"></form>
            <form method="post" action="nuevanovela.php" id="form2"></form>
            <div class="menuno" id="menuno">
                <ul>
                    <li class="main__boton1" onclick="$('#form1').submit();">NOVELAS</li>
                    <li class="main__boton1" onclick="$('#form2').submit();">NUEVA</li>
                </ul>
            </div>
            <div class="criterio" id="criterio" onclick="cazargenero(0,'',0);">
            </div>
            <div class="filt" id="filt">

                <div class="search" id="search">
                    <form id="bush" method="POST">
                        <input type="text" class="buscador" name="buscador" id="buscador" spellcheck="false" placeholder="Introduce tu busqueda...">
                    </form>
                </div>
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
        <div class="filtros" id="filtros">
            <h2 class="filtcab">FILTROS</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='../recursos/iconos/menu.webp' height="25" width="25" onClick="$('#filtro').toggle();"
                    alt="menu" />
            </div>
            <div class="filtro" id="filtro">

            </div>
        </div>
        <div class="asidea" id="asidea">
            <h2 class="filtcab">FILTROS</h2>
            <div class="ico_oculf" id="ico_ocul">
                <img src='../recursos/iconos/menu.webp' height="25" width="25" onClick="$('#filtroo').toggle();"
                    alt="menu" />
            </div>
            <div class="filtroo" id="filtroo">

            </div>
            <h2>NOTICIAS</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='../recursos/iconos/menu.webp' height="25" width="25" onClick="$('#noticias').toggle();"
                    alt="menu" />
            </div>
            <div class="noticias" id="noticias">

            </div>
            <h2>DONACIONES</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='../recursos/iconos/menu.webp' height="25" width="25" onClick="$('#dona').toggle();" alt="menu" />
            </div>
            <div class="dona" id="dona">
                <img src="../recursos/iconos/DONAR2.webp" alt="Donar" onMouseOver="src='../recursos/iconos/DONAR.webp'"
                    onMouseOut="src='../recursos/iconos/DONAR2.webp'"
                    style="height:auto; width: 100%; margin:50px 0px; cursor: pointer; display: block;" />
            </div>
        </div>

        <div class="main" id="main">
            <h2>NOVELAS LIGERAS</h2>
            <div class="novelas" id="novelas">

            </div>
        </div>
        <div class="asideb" id="asideb">
            <h2>VOLUMENES RECIENTES</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='../recursos/iconos/menu.webp' height="25" width="25" onClick="$('#nue_vol').toggle();"
                    alt="menu" />
            </div>
            <div class="nue_vol" id="nue_vol">

            </div>
            <h2>NUEVAS NOVELAS</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='../recursos/iconos/menu.webp' height="25" width="25" onClick="$('#nue_nov').toggle();"
                    alt="menu" />
            </div>
            <div class="nue_nov" id="nue_nov">

            </div>
            <h2>TOP DESCARGAS</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='../recursos/iconos/menu.webp' height="25" width="25" onClick="$('#top_des').toggle();"
                    alt="menu" />
            </div>
            <div class="top_des" id="top_des">

            </div>
        </div>
        <div class="footer" id="footer"></div>
        <div class="margd" id="margd"></div>
    </div>

</body>

</html>
