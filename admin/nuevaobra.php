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
    <?php
require_once("class/class.php");
$novel=new Obra();
$usu=new Usuarios();
$user=$usu->get_usuarios();
$cuen=sizeof($user);
$gen=$novel->getgeneros();
?>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>NUEVA OBRA</title>
        <!-- style and script resources -->
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/jquery-3.6.3.min.js"></script>
        <script src="js/javascript.js"></script>
        <script src="js/ajax.js"></script>
        <script>
            $(document).ready(function(){
               
            });
        </script>
        <script language="JavaScript">
            var era;
            function uncheckRadio(rbutton)
            {
                if(rbutton.checked==true && era==true){rbutton.checked=false;}
                era=rbutton.checked;
            }
            function filePreview(input) {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#uploadForm + img').remove();
                        $('#uploadForm').after('<img src="' + e.target.result + '" width="220" height="320"/>');
                    }                                                           
                    reader.readAsDataURL(input.files[0]);
                }
            }       
        </script>
        <!--favicon-->
        <link rel="icon" href="../recursos/iconos/favicon.png" sizes="32x32" />
    </head>
    <body>
        <div class="contenedor" id="contenedor">
            <div class="margi" id="margi"></div>
            <div class="nav" id="nav"></div>
            <div class="headerr" id="headerr"></div>
            <div class="main_nav" id="main_nav">
                <form method="post" action="obras.php" id="form1"></form>
                <form method="post" action="nuevaobra.php" id="form2"></form>
                <div class="menuno" id="menuno">
                    <ul>
                        <li class="main__boton1" onclick="$('#form1').submit();">OBRAS</li>
                        <li class="main__boton1" onclick="$('#form2').submit();">NUEVA</li>
                    </ul>
                </div>
                <div class="criterio" id="criterio" onclick="cazargenero(0,'',0);" style="visibility:hidden">
				</div>
				<div class="filt" id="filt">

					<div class="search" id="search">
						<form id="bush" method="POST">
							<input type="text" class="buscador" name="buscador" id="buscador" spellcheck="false" placeholder="Introduce tu busqueda..." style="visibility:hidden">
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
           
        <div class="asidea" id="asidea">
            
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
                <h2>NUEVA OBRA</h2>
                <div class="novelas">
                    <form method="post" enctype="multipart/form-data" id="nuevanovela" action="procesado_nueva_obra.php">
                        <table align="center" style="margin:3px;  margin-top: 17px; width:99%; ">
                            <tr>
                                <td rowspan="9" style="width:33%;">
                                <div id="uploadForm">
                                    
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-weight: bold; width: 13%">Nombre</td>
                                <td>
                                <input type="text" style="border: solid 1px #CCC; width:100%; height:30px;" name="obra_nombre">
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-weight: bold;">Tipo</td>
                                <td>
                                    <select name="tipo_id" style="border: solid 1px #CCC; height:30px;">
                                        <option value=""></option>
                                        <option value="1">Manga</option>
                                        <option value="2">Manhwa</option>
                                        <option value="3">Manhua</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-weight: bold;">Estado</td>
                                <td>
                                    <select name="obra_estado" style="border: solid 1px #CCC; height:30px;">
                                        <option value=""></option>
                                        <option value="1">Publicándose</option>
                                        <option value="2">Suspendida</option>
                                        <option value="3">Pausada</option>
                                        <option value="4">Dropeada</option>
                                        <option value="5">Finalizada</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-weight: bold;">Patrocinado</td>
                                <td>
                                    <select name="obra_patrocinada" style="border: solid 1px #CCC; height:30px;">
                                        <option value=""></option>
                                        <option value="0">no</option>
                                        <option value="1">si</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-weight: bold;">Patrocinador</td>
                                <td>
                                <select style="border: solid 1px #CCC; height:30px;" name="patrocinador_id">
                                    <option value=""></option>
                                    <?php
                                        for($i=0;$i<$cuen;$i++)
                                        {
                                            echo "<option value='".$user[$i]['usuario_id']."'>".$user[$i]['usuario_nombre']."</option>";
                                        }
                                    ?>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td style=" font-weight: bold;">Publicado cada</td>
                                <td>
                                    <select name="obra_periodo" style="border: solid 1px #CCC; height:30px;">
                                        <option value=""></option>
                                        <option value="1">7</option>
                                        <option value="2">14</option>
                                        <option value="3">21</option>
                                        <option value="4">28</option>
                                        <option value="5">0</option>
                                    </select>
                                días
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </br>
                                </br></br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </br>
                                </br></br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                </br>
                                </br>
                                <b>Caratula</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                <input type="file" name="obra_caratula" id="imgInp" onchange="filePreview(this)" >
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                </br>
                                </br>
                                <b>Generos</b>
                                </td>
                            </tr>
                                
                            <tr>
                                <td colspan="5">
                                <table align="center" style="width: 100%;">
                                    <tr>
                                    <?php
                                        $z=0;
                                    $contador=sizeof($gen);
                                    for($i=0;$i<$contador;$i++)
                                    {
                                        if($z==5)
                                        {
                                        ?>
                                        </tr>
                                        <tr>
                                        <?php 
                                        $z=0;	 
                                        }
                                        $z=$z+1;
                                        ?>
                                        <td style="margin: 3px;">
                                            <input type="radio" onclick="uncheckRadio(this)" name="<?php echo 'obra_genero'.$i;?>" value="<?php echo $gen[$i]['genero_id']; ?>"> 
                                        </td>
                                        <td style="margin: 3px;"><?php echo $gen[$i]['genero']; ?>
                                        </td> 
                                    <?php
                                    }
                                    ?>
                                    </tr>
                                </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                </br>
                                </br>
                                <b>Sinopsis</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                <textarea name="obra_sinopsis" style="width:100%; height:125px; resize:vertical; margin-top:11px; border:solid 1px #CCC;" ></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                </br>
                                </br>
                                <b>keywords</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                <textarea name="obra_keywords" style="width:100%; height:125px; resize:vertical; margin-top:11px; border:solid 1px #CCC;" ></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </br>
                                <input type="submit" value="Nueva Obra" style="background-color:white; padding: 7px 11px; border:double 3px green; border-radius: 7px; cursor: pointer; font-weight:bold;" onClick="$('#nuevanovela').submit();"
                                onMouseOver="style='background-color:rgba(0,0,0,0.3); color:yellow; padding:7px 11px; border:double 3px green; border-radius:7px; cursor: pointer; font-weight:bold;'" 
                                onMouseOut="style='background-color:white; padding: 7px 11px; border:double 3px green; border-radius: 7px; cursor: pointer; font-weight:bold;'">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="asideb" id="asideb">
                <h2>CAPITULOS RECIENTES</h2>
                <div class="ico_ocul" id="ico_ocul">
                    <img src='../recursos/iconos/menu.webp' height="25"  width="25" onClick="$('#nue_vol').toggle();" alt="menu"/>
                </div>
                <div class="nue_vol" id="nue_vol">
                    
                </div>
                <h2>REDES SOCIALES</h2>
                <div class="ico_ocul" id="ico_ocul">
                    <img src='../recursos/iconos/menu.webp' height="25"  width="25" onClick="$('#nue_nov').toggle();" alt="menu"/>
                </div>
                <div class="nue_nov" id="nue_nov">
                    
                </div>
                <h2>PATROCINAR OBRA</h2>
                <div class="ico_ocul" id="ico_ocul">
                    <img src='../recursos/iconos/menu.webp' height="25"  width="25" onClick="$('#top_des').toggle();" alt="menu"/>
                </div>
                <div class="top_des" id="top_des">
                   
                </div>
            </div>
            <div class="footer" id="footer"></div>
            <div class="margd" id="margd"></div>
        </div>
        
    </body>
</html>