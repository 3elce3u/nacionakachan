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
$usu=new Usuarios();
$user=$usu->get_usuarios();
$cuen=sizeof($user);
$gen=$novel->getgeneros();
	if(!empty($_GET['obra_id']))
	{
		$edi=$novel->getobrabyid($_GET['obra_id']);
		$tipoo=$novel->get_tipos_by_id($edi[0]['tipo_id']);
		$tipo=$tipoo["tipo"];
		$estadoo=$novel->get_estados_by_id($edi[0]['obra_estado']);
		$estado=$estadoo["estado"];
		$periodoo=$novel->get_periodos_by_id($edi[0]['obra_periodo']);
		$periodo=$periodoo["periodo"];
		if($edi[0]['obra_patrocinada']==0)
		{
			$patrocinada="No";
		}
		if($edi[0]['obra_patrocinada']==1)
		{
			$patrocinada="Si";
		}
		$vpe=$novel->getvideosbyobraid($_GET['obra_id']);
		if(empty($vpe))
		{
			$vpe="";
		}
		$obra_id=$_GET['obra_id'];
	}
	else
	{
		$edi=$novel->getobrabyid($_POST['obra_id']);
		$tipoo=$novel->get_tipos_by_id($edi[0]['tipo_id']);
		$tipo=$tipoo["tipo"];
		$estadoo=$novel->get_estados_by_id($edi[0]['obra_estado']);
		$estado=$estadoo["estado"];
		$periodoo=$novel->get_periodos_by_id($edi[0]['obra_periodo']);
		$periodo=$periodoo["periodo"];
		$vpe=$novel->getvideosbyobraid($_POST['obra_id']);
		if($edi[0]['obra_patrocinada']==0)
		{
			$patrocinada="No";
		}
		if($edi[0]['obra_patrocinada']==1)
		{
			$patrocinada="Si";
		}
		if(empty($vpe))
		{
			$vpe="";
		}
		$obra_id=$_POST['obra_id'];
	}
	if(!empty($_POST['filtro']))
	{
	   $filtro=$_POST['filtro']; 
	}
	else
	{
	    $filtro="";
	}
    if(!empty($_POST['typo']))
	{
	   $typo=$_POST['typo']; 
	}
	else
	{
	    $typo="";
	}
	if(!empty($_POST['pagina']))
	{
	   $pagina=$_POST['pagina']; 
	}
	else
	{
	    $pagina="";
	}
$nov=$novel->getobras($filtro,$typo,$pagina);
$pat=$usu->get_usuarios_by_id($edi[0]['patrocinador_id']);
/*$nuevaobra=$novel->getultimasobras2();
$nuevovolumen=$novel->getultimosvideos2();*/
?>	
	<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="En esta web podras leer o escuchar obras ligeras japonesas totalmente gratis.">
    <title>EDITAR OBRAS</title>
    <!-- style and script resources -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/ajax.js"></script>
    <!--favicon-->
    <link rel="icon" href="../recursos/iconos/favicon.png" sizes="32x32" />
    <script>
        $(document).ready(function(){
                        
        });
    </script>
    <script language="JavaScript">
        var era;
        function uncheckRadio(rbutton)
        {
            if(rbutton.checked==true && era==true)
			{
				rbutton.checked=false;
			}
			era=rbutton.checked;
        }
        function filePreview(input) 
		{
			if (input.files && input.files[0]) 
			{
				var reader = new FileReader();
				reader.onload = function (e) 
				{
					$('#uploadForm + img').remove();
					$('#uploadForm').after('<img src="' + e.target.result + '" width="220" height="320"/>');
				}                                                           
    			reader.readAsDataURL(input.files[0]);
   			}
		}  
		function filePrevieew(input) 
		{
			if (input.files && input.files[0]) 
			{
				var reader = new FileReader();
				reader.onload = function (e) 
				{
					$('#uploadFormm + img').remove();
					$('#uploadFormm').after('<img src="' + e.target.result + '" width="320" height="220"/>');
				}                                                           
    			reader.readAsDataURL(input.files[0]);
   			}
		}            
    </script>
	</head>
	<body id="body">
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
				<div class="obras">
					<h2>EDITAR OBRA </h2>
					<form method="post" enctype="multipart/form-data" id="edi_nov" action="procesado_edicion_obra.php">
					<input type="hidden" name="obra_caratula_original" value="<?php echo $edi[0]['obra_caratula'];?>">
					<input type="hidden" name="obra_miniatura_original" value="<?php echo $edi[0]['obra_miniatura'];?>">
					<input type="hidden" name="obra_fecha_inicio" value="<?php echo $edi[0]['obra_fecha_inicio'];?>">	
					<input type="hidden" name="obra_id" value="<?php echo $edi[0]['obra_id'];?>">
					<table align="center" style="margin: 3px;  margin-top: 17px;">
						<tr>
							<td rowspan="9" style="width:20%;">
								<div id="uploadForm">
								
								</div>
								<img height="320" width="220" src="<?php echo "../".$edi[0]['obra_caratula'];?>" style="margin-right:5px;" >
							</td>
						</tr>
						<tr>
							<td style=" font-weight: bold; width: 13%">Nombre</td>
							<td>
							<input type="text" style="border: solid 1px #CCC; width:100%; height:30px;" name="obra_nombre" value="<?php echo $edi[0]['obra_nombre'];?>">
							</td>
						</tr>
						<tr>
                            <td style=" font-weight: bold;">Tipo</td>
                            <td>
                                <select name="tipo_id" style="height:30px;">
									<option value="<?php echo $edi[0]['tipo_id'];?>"><?php echo $tipo ?></option>
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
                                <select name="obra_estado" style="height:30px;">
								  	<option value="<?php echo $edi[0]['obra_estado'];?>"><?php echo $estado; ?></option>
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
                                <select name="obra_patrocinada" style="height:30px;">
                                    <option value="<?php echo $edi[0]['obra_patrocinada'];?>"><?php echo $patrocinada; ?></option>
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
									<?php
                                            echo "<option value='".$pat['usuario_id']."'>".$pat['usuario_nombre']."</option>";
                                    ?>
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
                                <select name="obra_periodo" style="height:30px;">
									<option value="<?php echo $edi[0]['obra_periodo'];?>"><?php echo $periodo; ?></option>
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
						<tr>
                            <td colspan="5">
                                <input type="file" name="obra_caratula" id="imgInp" onchange="filePreview(this)" >
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
							<table align="center" style="width: 100%;">
								<tr>
								<?php
									$z=0;
								$contador=sizeof($gen);
								$gener=explode(',',$edi[0]['obra_generos']);
								$tota=sizeof($gener);
								for($i=0;$i<$contador;$i++)
								{

									If($z==5){?></tr><tr>
									<?php $z=0;}
									$z=$z+1;
									?>
									<td style="margin: 3px;"><input type="radio" onclick="uncheckRadio(this)" name="<?php echo 'obra_genero'.$i;?>"<?php 
									for($y=0;$y<$tota;$y++)
									{
										if($gen[$i]['genero_id']==$gener[$y])
										{
										?>
										checked 
										<?php 
										}
									}
										?> 
										value="<?php echo $gen[$i]['genero_id']; ?>"> </td><td style="margin: 3px;"><?php echo $gen[$i]['genero']; ?></td> 
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
							<textarea name="obra_sinopsis" style="width:100%; height:125px; resize:vertical; margin-top:11px; border:solid 1px #CCC;" ><?php echo $edi[0]['obra_sinopsis'];?></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="5">
							</br>
							</br>
							<b>key words</b>
							</td>
						</tr>
						<tr>
							<td colspan="5">
							<textarea name="obra_keywords" style="width:100%; height:125px; resize:vertical; margin-top:11px; border:solid 1px #CCC;" ><?php echo $edi[0]['obra_keywords'];?></textarea>
							</td>
						</tr>
						<tr>
							<td>
						</br>
							<input type="submit" value="Editar obra" style="background-color:white; padding: 7px 11px; border:double 3px green; border-radius: 7px; cursor: pointer; font-weight:bold;" onClick="$('#edi_nov').submit();"
							onMouseOver="style='background-color:rgba(0,0,0,0.3); color:yellow; padding:7px 11px; border:double 3px green; border-radius:7px; cursor: pointer; font-weight:bold;'" 
							onMouseOut="style='background-color:white; padding: 7px 11px; border:double 3px green; border-radius: 7px; cursor: pointer; font-weight:bold;'">
							</td>
						</tr>
					</table>
					</form>
						</br>
						</br>
						</br>
						<?php
						if(empty($vpe))
						{
							$conta=0;
						}
						else
						{
							$conta=sizeof($vpe);
						}
						
						for($b=0;$b<$conta;$b++)
						{
						?>
						<br>
						<br>
						<br>
						<form method="post" action="procesadoedicionvolumen.php" enctype="multipart/form-data" id="video<?php echo $b; ?>">
						<input type="hidden" name="obra_id" value="<?php echo $vpe[$b]['obra_id'];?>">
						<input type="hidden" name="video_id" value="<?php echo $vpe[$b]['video_id'];?>">
						<input type="hidden" name="video_caratula_original" value="<?php echo $vpe[$b]['video_caratula'];?>">
						<input type="hidden" name="video_miniatura_original" value="<?php echo $vpe[$b]['video_miniatura'];?>">
						<input type="hidden" name="video_fecha" value="<?php echo $vpe[$b]['video_fecha'];?>">
						<input type="hidden" name="fansub_id" value="<?php echo $vpe[$b]['fansub_id'];?>">
						<input type="hidden" name="web_id" value="<?php echo $vpe[$b]['web_id'];?>">
						<table style="width:100%;">
							<tr>
								<td>
									Caratula
								</td>
								<td style="width: 20%;">
									Título video
								</td>
								<td colspan="2" style="width:46%;">
									<input type="text" name="video_titulo" style="border:solid 1px #CCC; width:100%; height:30px;" value="<?php echo $vpe[$b]['video_titulo']; ?>">
								</td>
							</tr>
							<tr>
								<td rowspan="8" style="width:33%;">
								<img src="<?php  echo "../".$vpe[$b]['video_caratula']; ?>" style="height:auto; width:auto;">
								</td>
								<td>
									Fansub
								</td>
								<td>
									<input type="text" name="fansub" value="<?php echo $vpe[$b]['fansub_nombre']; ?>" style="border:solid 1px #CCC; width:100%; height:30px;">
								</td>
							</tr>
							<tr>
								<td>
									Fansub enlace
								</td>
								<td>
									<input type="text" name="fansub_enlace" value="<?php echo $vpe[$b]['fansub_enlace']; ?>" style="border:solid 1px #CCC; width:100%; height:30px;">
								</td>
							</tr>
							<tr>
								<td>
									Web
								</td>
								<td>
									<input type="text" name="web" value="<?php echo $vpe[$b]['web']; ?>" style="border:solid 1px #CCC; width:100%; height:30px;">
								</td>
							</tr>
							<tr>
								<td>
									Video enlace
								</td>
								<td>
									<input type="text" name="video_enlace" value="<?php echo $vpe[$b]['video_enlace']; ?>" style="border:solid 1px #CCC; width:100%; height:30px;">
								</td>
							</tr>
							<tr>
								<td>
									Capitulo inicio
								</td>
								<td>
									<input type="text" name="inicio" value="<?php echo $vpe[$b]['video_capitulo_inicio']; ?>" style="border:solid 1px #CCC; width:10%; height:30px;">
								</td>
							<tr>
							</tr>
								<td>
									Capitulo fin
								</td>
								<td>
									<input type="text" name="fin" value="<?php echo $vpe[$b]['video_capitulo_fin']; ?>" style="border:solid 1px #CCC; width:10%; height:30px;">
								</td>
							</tr>
							</tr>
								<td>
									Estado publicación
								</td>
								<td>
									<?php
										if($vpe[$b]['video_publicacion']==0)
										{
											$vis="Privado";
										}
										if($vpe[$b]['video_publicacion']==1)
										{
											$vis="Publico";
										}
									?>
									<select name="publicacion" style="border:solid 1px #CCC; height:30px;">
										<option value="<?php echo $vpe[$b]['video_publicacion']; ?>"><?php echo $vis; ?></option>
										<option value=""></option>
										<option value="1">Publico</option>
										<option value="0">Privado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="file" name="video_caratula">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="submit" value="Editar Volumen" style="background-color:white;padding:7px 11px;border:double 3px green;border-radius:7px;cursor:pointer;font-weight:bold;"
									onClick="$('#volumen<?php echo $b; ?>').submit();"
									onMouseOver="style='background-color:rgba(0,0,0,0.3); color:yellow; padding:7px 11px; border:double 3px green; border-radius:7px; cursor: pointer; font-weight:bold;'" 
									onMouseOut="style='background-color:white; padding: 7px 11px; border:double 3px green; border-radius: 7px; cursor: pointer; font-weight:bold;'">
								</td>
							</tr>
						</table>
						</form>
						<?php
						}
						?>
						</br>
						</br>
						</br>
						NUEVO VIDEO
						<br>
						<br>
						<br>
						<form method="post" action="procesadonuevovolumen.php" enctype="multipart/form-data" id="volumennuevo">
						<input type="hidden" name="obra_id" value="<?php echo $edi[0]['obra_id'];?>">
						<table style="width:100%;">
							<tr>
								<td>
									Caratula
								</td>
								<td style="width: 20%;">
									Título video
								</td>
								<td colspan="2" style="width:46%;">
									<input type="text" name="video_titulo" style="border:solid 1px #CCC; width:100%; height:30px;">
								</td>
							</tr>
							<tr>
								<td rowspan="8" style="width: 33%;">
									<div id="uploadFormm"  style="height:auto; width:auto;">
								
									</div>
								</td>
								<td>
									Fansub
								</td>
								<td>
									<input type="text" name="fansub" style="border:solid 1px #CCC; width:100%; height:30px;">
								</td>
							</tr>
							<tr>
								<td>
									Fansub enlace
								</td>
								<td>
									<input type="text" name="fansub_enlace"  style="border:solid 1px #CCC; width:100%; height:30px;">
								</td>
							</tr>
							<tr>
								<td>
									Web
								</td>
								<td>
									<input type="text" name="web"  style="border:solid 1px #CCC; width:100%; height:30px;">
								</td>
							</tr>
							<tr>
								<td>
									Video enlace
								</td>
								<td>
									<input type="text" name="video_enlace" style="border:solid 1px #CCC; width:100%; height:30px;">
								</td>
							</tr>
							<tr>
								<td>
									Ccapitulo inicio
								</td>
								<td>
									<input type="text" name="inicio" style="border:solid 1px #CCC; width:10%; height:30px;">
								</td>
							<tr>
							</tr>
								<td>
									Capitulo fin
								</td>
								<td>
									<input type="text" name="fin" style="border:solid 1px #CCC; width:10%; height:30px;">
								</td>
							</tr>
							</tr>
								<td>
									Estado publicación
								</td>
								<td>
									<select name="publicacion" style="border:solid 1px #CCC; height:30px;">
										<option value=""></option>
										<option value="1">Publico</option>
										<option value="0">Privado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="file" name="video_caratula" onchange="filePrevieew(this)">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="submit" value="Nuevo video" style="background-color:white;padding:7px 11px;border:double 3px green;border-radius:7px;cursor:pointer;font-weight:bold;"
									onClick="$('#volumennuevo').submit();"
									onMouseOver="style='background-color:rgba(0,0,0,0.3); color:yellow; padding:7px 11px; border:double 3px green; border-radius:7px; cursor: pointer; font-weight:bold;'" 
									onMouseOut="style='background-color:white; padding: 7px 11px; border:double 3px green; border-radius: 7px; cursor: pointer; font-weight:bold;'">
								</td>
								</td>
							</tr>
						</table>
						</form>
						</td>
					</tr>
				</table>
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