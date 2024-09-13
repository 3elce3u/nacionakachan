<?php
session_start();
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    session_regenerate_id();
    $_SESSION['authenticated'] = true;
}
?>
<!DOCTYPE html>
<html class="no-js" lang="es-ES">
<?php
require_once("class/class.php");
$novel=new Obra();
$edi=$novel->getobrabyid($_GET['obra_id'],$_GET['obra_nombre']);
if (!empty($edi)) 
{
    $vol=$novel->getvideosbyobraid($_GET['obra_id']);
    if(!empty($vol))
    {
        $numerodevolumenes = (sizeof($vol));
    }
} 
else 
{
    header("Location: obras.php");
}

$ogurl = "http://localhost/obra.php?obra_id=" . $_GET['obra_id'] . "&obra_nombre=" . $_GET['obra_nombre'] . "";
$ogimage = "http://localhost/" . $edi[0]['obra_caratula'] . "";
$ogdescript ="".$edi[0]['tipo']." ".$edi[0]['obra_nombre']." narrado en español ";
$ogtitle = $_GET['obra_nombre'];
$ogauthor = "";
$ogtype = "".$edi[0]['tipo']."";
$ogsite_name = "";
$fbapp_id = "";
/*echo $_GET['obra_id']."<br>";
echo $_GET['obra_nombre']."<br>";
echo $edi[0]['obra_nombre']."<br>";*/
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--ETIQUETAS BUSCADOR-->
    <meta charset="utf-8">
    <meta name="Description" content=" <?php echo $edi[0]['tipo'].` `.$edi[0]['obra_nombre'] . ` narrado en español`; ?> ">
    <meta name="Keywords" content=" <?php echo $edi[0]['tipo'].` `.$edi[0]['obra_nombre'] . ` narrado en español`; ?> ">
    <!--CONFIGURACION VIEWPORT-->
    <meta name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=-5.0">
    <!--ETIQUETAS TWITTER-->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $ogtitle; ?>">
    <meta name="twitter:description" content="<?php echo $ogdescript; ?>">
    <meta name="twitter:site" content="@USUARIO DE TWITTER">
    <meta name="twitter:creator" content="@USUARIO DE TWITTER">
    <meta name="twitter:image:src" content="<?php echo $ogimage; ?>">
    <!--ETIQUETAS FACEBOOK-->
    <meta name="og:url" content="<?php echo $ogurl; ?>">
    <meta name="og:image" content="<?php echo $ogimage; ?>">
    <meta name="og:image:width" content="220">
    <meta name="og:image:height" content="320">
    <meta name="og:title" content="<?php echo $ogtitle; ?>">
    <meta name="og:type" content="<?php echo $ogtype; ?>">
    <meta name="og:book:author" content="<?php echo $ogauthor; ?>">
    <meta name="og:description" content="<?php echo $ogdescript; ?>">
    <meta name="og:site_name" content="<?php echo $ogsite_name; ?>">
    <meta name="og:locale" content="es_ES">
    <meta name="fb:app_id" content="<?php echo $fbapp_id; ?>">
    <!--ETIQUETAS GOOGLE obsoleto desde 20 04 2019 -->
    <meta itemprop="name" content="<?php echo $ogtitle; ?>">
    <meta itemprop="description" content="<?php echo $ogdescript; ?>">
    <meta itemprop="image" content="<?php echo $ogimage; ?>">
    <!--ENLACES CSS-->
    <title>OBRA</title>
    <!-- style and script resources -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/ajax.js"></script>
    <!--favicon-->
    <link rel="icon" href="recursos/iconos/favicon.ico" sizes="32x32" />
</head>

<body id="body" onload="obra(<?php echo '`'.$_GET['obra_id'] . '`,`' . $_GET['obra_nombre'] . '`'; ?>),patro()">
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
            <form method="post" action="obras.php" id="form2"></form>
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
                    style="height:auto; width: 100%; margin:50px 0px; cursor: pointer; display: block;" />
            </div>
        </div>
        <div class="main" id="main">
            <h2>OBRA</h2>
            <div class="novela" id="novela">

            </div>
        </div>
        <div class="asideb" id="asideb">
        <h2>ÚLTIMOS CAPÍTULOS</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='recursos/iconos/menu.webp' height="25" width="25" onClick="$('#nue_vol').toggle();"
                    alt="menu" />
            </div>
            <div class="nue_vol" id="nue_vol">

            </div>
            <h2>REDES SOCIALES</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='recursos/iconos/menu.webp' height="25" width="25" onClick="$('#nue_nov').toggle();"
                    alt="menu" />
            </div>
            <div class="nue_nov" id="nue_nov">

            </div>
            <h2>PATROCINAR OBRA</h2>
            <div class="ico_ocul" id="ico_ocul">
                <img src='recursos/iconos/menu.webp' height="25" width="25" onClick="$('#top_des').toggle();"
                    alt="menu" />
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