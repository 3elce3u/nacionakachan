<?php
// The base class for all db classes


// Class for MySQL, which extends base class
class bbdd {
	function conect(){
		$servidor ="localhost";
		$usuario ="root";
		$pass ="putif3ria";
		$bd ="nacionakachan";
		// creación de la conexión a la base de datos con mysql_connect()
		$conexion =mysqli_connect( $servidor, $usuario, $pass, $bd ) or die ("No se ha podido conectar al servidor de Base de datos");
		// Selección del a base de datos a utilizar
		return $conexion;
	}
}

class Novela{
    function getgeneros(){
        $con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT * from generos order by genero asc";
		$ok=mysqli_prepare($conexion,$consulta);
		$ok1=mysqli_stmt_execute($ok);
		$ok2=mysqli_stmt_bind_result($ok,$genero_id,$genero);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['genero_id']=$genero_id;
			$ras[$f]['genero']=$genero;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
    }
	function getnovelaz(){
        $con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT novela_id,
						  escritor_id,
						  ilustrador_id,
						  editorial_id,
						  fansub_id,
						  novela_nombre,
						  novela_nombre_original,
						  novela_generos,
						  SUBSTRING(novela_sinopsis,1,500),
						  novela_caratula,
						  novela_miniatura,
						  novela_keywords,
						  novela_fecha_publicacion from novelas order by novela_nombre asc";
        $ok=mysqli_prepare($conexion,$consulta);
		$ok1=mysqli_stmt_execute($ok);
		$ok2=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['novela_nombre']=$novela_nombre;
			$ras[$f]['novela_nombre_original']=$novela_nombre_original;
			$ras[$f]['novela_generos']=$novela_generos;
			$ras[$f]['novela_sinopsis']=$novela_sinopsis;
			$ras[$f]['novela_caratula']=$novela_caratula;
			$ras[$f]['novela_miniatura']=$novela_miniatura;
			$ras[$f]['novela_keywords']=$novela_keywords;
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
    }
	
	
	function getnovelas($filtro,$typo,$pagina){
        $con= new bbdd;
        $conexion=$con->conect();
		$items_pp=20;
		if(empty($filtro))
		{
			if(!empty($pagina))
			{
				if($pagina==1)
				{
					$limite="0,20";
					$pagina=0;
				}
				else
				{
					$pagina=$pagina - 1;
					$limit=$pagina*$items_pp;
					$limite=$limit.",".$items_pp;
				}
			}
			else
			{
				$limite="0,20";
			}
			$pre="SELECT novela_id,
								  escritor_id,
								  ilustrador_id,
								  editorial_id,
								  fansub_id,
								  novela_nombre,
								  novela_nombre_original,
								  novela_generos,
								  SUBSTRING(novela_sinopsis,1,500) AS novela_sinopsis,
								  novela_caratula,
								  novela_miniatura,
								  novela_keywords,
								  novela_fecha_publicacion  from novelas order by novelas.novela_nombre asc limit ".$limite."";
			$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos primera");
		}
		else
		{
			if($typo=="busqueda")
			{
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$limite="0,20";
						$pagina=0;
					}
					else
					{
						$pagina=$pagina - 1;
						$limit=$pagina*$items_pp;
						$limite=$limit.",".$items_pp;
					}
				}
				else
				{
					$limite="0,20";
				}
				$pre="SELECT novela_id,
								  escritor_id,
								  ilustrador_id,
								  editorial_id,
								  fansub_id,
								  novela_nombre,
								  novela_nombre_original,
								  novela_generos,
								  SUBSTRING(novela_sinopsis,1,500) AS novela_sinopsis,
								  novela_caratula,
								  novela_miniatura,
								  novela_keywords,
								  novela_fecha_publicacion  from novelas where Match(novela_keywords) AGAINST (?) order by novelas.novela_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos segunda");
        		$ok=mysqli_stmt_bind_param($res,"s",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
			if($typo=="genero")
			{
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$limite="0,20";
						$pagina=0;
					}
					else
					{
						$pagina=$pagina - 1;
						$limit=$pagina*$items_pp;
						$limite=$limit.",".$items_pp;
					}
				}
				else
				{
					$limite="0,20";
				}
				$items_pp=20;
				$consulta="SELECT novela_id,
								  escritor_id,
								  ilustrador_id,
								  editorial_id,
								  fansub_id,
								  novela_nombre,
								  novela_nombre_original,
								  novela_generos,
								  SUBSTRING(novela_sinopsis,1,500) AS novela_sinopsis,
								  novela_caratula,
								  novela_miniatura,
								  novela_keywords,
								  novela_fecha_publicacion from novelas where novelas.novela_generos LIKE '%".$filtro."%' order by novelas.novela_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos tercera");
				$ok1=mysqli_stmt_execute($res);
				$ok2=mysqli_stmt_bind_result($res,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion);
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$z=0;
					}
					else
					{
						$z=$pagina-1;
						$z=$z*$items_pp;
					}
				}	
				else
				{
					$z=0;
				}
				$y=0;
				$v=0;
				while(mysqli_stmt_fetch($res))
				{
					$generos=explode(",",$novela_generos);
					$cou=sizeof($generos);
					for($x=0;$x<$cou;$x++)
					{
						if($generos[$x]==$filtro)
						{
							if($y>=$z)
							{
								$ras[$v]['novela_id']=$novela_id;
								$ras[$v]['escritor_id']=$escritor_id;
								$ras[$v]['ilustrador_id']=$ilustrador_id;
								$ras[$v]['editorial_id']=$editorial_id;
								$ras[$v]['fansub_id']=$fansub_id;
								$ras[$v]['novela_nombre']=$novela_nombre;
								$ras[$v]['novela_nombre_original']=$novela_nombre_original;
								$ras[$v]['novela_generos']=$novela_generos;
								$ras[$v]['novela_sinopsis']=$novela_sinopsis;
								$ras[$v]['novela_caratula']=$novela_caratula;
								$ras[$v]['novela_miniatura']=$novela_miniatura;
								$ras[$v]['novela_keywords']=$novela_keywords;
								$ras[$v]['novela_fecha_publicacion']=$novela_fecha_publicacion;
								$y=$y+1;
								$v=$v+1;
								if($v==20)
								{
									return $ras;
								}
							}
							else
							{
								$y=$y+1;
							}
						}
					}
				}
			return $ras;
			}	
			if($typo=="escritor")
			{
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$limite="0,20";
						$pagina=0;
					}
					else
					{
						$pagina=$pagina - 1;
						$limit=$pagina*$items_pp;
						$limite=$limit.",".$items_pp;
					}
				}
				else
				{
					$limite="0,20";
				}
				$pre="SELECT novela_id,
								  escritor_id,
								  ilustrador_id,
								  editorial_id,
								  fansub_id,
								  novela_nombre,
								  novela_nombre_original,
								  novela_generos,
								  SUBSTRING(novela_sinopsis,1,500) AS novela_sinopsis,
								  novela_caratula,
								  novela_miniatura,
								  novela_keywords,
								  novela_fecha_publicacion  from novelas where novelas.escritor_id=? order by novelas.novela_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
			if($typo=="ilustrador")
			{
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$limite="0,20";
						$pagina=0;
					}
					else
					{
						$pagina=$pagina - 1;
						$limit=$pagina*$items_pp;
						$limite=$limit.",".$items_pp;
					}
				}
				else
				{
					$limite="0,20";
				}
				$pre="SELECT novela_id,
								  escritor_id,
								  ilustrador_id,
								  editorial_id,
								  fansub_id,
								  novela_nombre,
								  novela_nombre_original,
								  novela_generos,
								  SUBSTRING(novela_sinopsis,1,500) AS novela_sinopsis,
								  novela_caratula,
								  novela_miniatura,
								  novela_keywords,
								  novela_fecha_publicacion  from novelas where novelas.ilustrador_id=? order by novelas.novela_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
			if($typo=="editorial")
			{
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$limite="0,20";
						$pagina=0;
					}
					else
					{
						$pagina=$pagina - 1;
						$limit=$pagina*$items_pp;
						$limite=$limit.",".$items_pp;
					}
				}
				else
				{
					$limite="0,20";
				}
				$pre="SELECT novela_id,
								  escritor_id,
								  ilustrador_id,
								  editorial_id,
								  fansub_id,
								  novela_nombre,
								  novela_nombre_original,
								  novela_generos,
								  SUBSTRING(novela_sinopsis,1,500) AS novela_sinopsis,
								  novela_caratula,
								  novela_miniatura,
								  novela_keywords,
								  novela_fecha_publicacion  from novelas where novelas.editorial_id=? order by novelas.novela_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
			if($typo=="fansub")
			{
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$limite="0,20";
						$pagina=0;
					}
					else
					{
						$pagina=$pagina - 1;
						$limit=$pagina*$items_pp;
						$limite=$limit.",".$items_pp;
					}
				}
				else
				{
					$limite="0,20";
				}
				$pre="SELECT novela_id,
						     escritor_id,
							 ilustrador_id,
							 editorial_id,
							 fansub_id,
							 novela_nombre,
							 novela_nombre_original,
							 novela_generos,
							 SUBSTRING(novela_sinopsis,1,500) AS novela_sinopsis,
							 novela_caratula,
							 novela_miniatura,
							 novela_keywords,
							 novela_fecha_publicacion from novelas where novelas.fansub_id=? order by novelas.novela_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
		}
		if(!empty($res))
		{
			$ok1=mysqli_stmt_execute($res);
			$ok2=mysqli_stmt_bind_result($res,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
										$novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion);
			$v=0;
			while(mysqli_stmt_fetch($res))
			{
				$ras[$v]['novela_id']=$novela_id;
				$ras[$v]['escritor_id']=$escritor_id;
				$ras[$v]['ilustrador_id']=$ilustrador_id;
				$ras[$v]['editorial_id']=$editorial_id;
				$ras[$v]['fansub_id']=$fansub_id;
				$ras[$v]['novela_nombre']=$novela_nombre;
				$ras[$v]['novela_nombre_original']=$novela_nombre_original;
				$ras[$v]['novela_generos']=$novela_generos;
				$ras[$v]['novela_sinopsis']=$novela_sinopsis;
				$ras[$v]['novela_caratula']=$novela_caratula;
				$ras[$v]['novela_miniatura']=$novela_miniatura;
				$ras[$v]['novela_keywords']=$novela_keywords;
				$ras[$v]['novela_fecha_publicacion']=$novela_fecha_publicacion;
				$v=$v+1;
			}
		@mysqli_stmt_close($res);
		}
    return $ras;
	}

	function get_escritores()
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$pre="SELECT * from escritores order by escritor_nombre asc";
		$ok=mysqli_prepare($conexion,$pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$ok1=mysqli_stmt_execute($ok);
		$ok2=mysqli_stmt_bind_result($ok,$escritor_id,$escritor_nombre);
		$f=0;
        while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['escritor_nombre']=$escritor_nombre;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
	
	function get_escritoresbyid($filtro)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$pre="SELECT * from escritores where escritores.escritor_id=?";
		$ok=mysqli_prepare($conexion,$pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$param=mysqli_stmt_bind_param($ok,"i",$filtro);
		$result=mysqli_stmt_bind_result($ok,$escritor_id,$escritor_nombre);
		$exe=mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['escritor_id']=$escritor_id;
			$ras['escritor_nombre']=$escritor_nombre;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	function sacarUltimaPalabra($cadena){

		//explodeamos por los espacios
		$Ecadena=explode(' ',$cadena);

		//contamos cuantas palabras hay
		$Ccadena=count($Ecadena);


		//le restamos 1 ya que el array empieza de 0
		$CRcadena=$Ccadena-1;

		//contamos los caracteres de la ultima palabra
		$Cletras=strlen($Ecadena[$CRcadena]);

		//contamos cuantos caracteres tiene la cadena completa
		$Cletras2=strlen($cadena);

		//restamos
		$CTotal=$Cletras2-$Cletras;

		//seteamos lo que queremos mostrar
		$cadena=substr($cadena,0,$CTotal);

	return trim($cadena);
	}
	
	function get_ilustradores()
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$pre="SELECT * from ilustradores order by ilustrador_nombre asc";
		$ok=mysqli_prepare($conexion,$pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$ok1=mysqli_stmt_execute($ok);
		$ok2=mysqli_stmt_bind_result($ok,$ilustrador_id,$ilustrador_nombre);
		$f=0;
        while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['ilustrador_nombre']=$ilustrador_nombre;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
	function get_ilustradorbyid($filtro)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$pre="SELECT * from ilustradores where ilustradores.ilustrador_id=?";
		$ok=mysqli_prepare($conexion,$pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$param=mysqli_stmt_bind_param($ok,"i",$filtro);
		$result=mysqli_stmt_bind_result($ok,$ilustrador_id,$ilustrador_nombre);
		$exe=mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['ilustrador_id']=$ilustrador_id;
			$ras['ilustrador_nombre']=$ilustrador_nombre;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
	
	function get_editoriales()
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$pre="SELECT * from editoriales order by editorial_nombre asc";
		$ok=mysqli_prepare($conexion,$pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$ok1=mysqli_stmt_execute($ok);
		$ok2=mysqli_stmt_bind_result($ok,$editorial_id,$editorial_nombre,$editorial_enlace);
		$f=0;
        while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['editorial_nombre']=$editorial_nombre;
			$ras[$f]['editorial_enlace']=$editorial_enlace;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	function get_editorialbyid($filtro)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$pre="SELECT * from editoriales where editoriales.editorial_id=?";
		$ok=mysqli_prepare($conexion,$pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$param=mysqli_stmt_bind_param($ok,"i",$filtro);
		$result=mysqli_stmt_bind_result($ok,$editorial_id,$editorial_nombre,$editorial_enlace);
		$exe=mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['editorial_id']=$editorial_id;
			$ras['editorial_nombre']=$editorial_nombre;
			$ras['editorial_enlace']=$editorial_enlace;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
	function formatearf($fecha)
	{
		$primero=explode("-",$fecha);
		$year=$primero[0];
		$mes=$primero[1];
		$dia=$primero[2];
		if($mes=="01")
		{
			$mes="Enero";
		}
		if($mes=="02")
		{
			$mes="Febrero";
		}
		if($mes=="03")
		{
			$mes="Marzo";
		}
		if($mes=="04")
		{
			$mes="Abril";
		}
		if($mes=="05")
		{
			$mes="Mayo";
		}
		if($mes=="06")
		{
			$mes="Junio";
		}
		if($mes=="07")
		{
			$mes="Julio";
		}
		if($mes=="08")
		{
			$mes="Agosto";
		}
		if($mes=="09")
		{
			$mes="Septiembre";
		}
		else if($mes=="10")
		{
			$mes="Octubre";
		}
		else if($mes=="11")
		{
			$mes="Noviembre";
		}
		if($mes=="12")
		{
			$mes="Diciembre";
		}
		$final=$dia." de ".$mes." del ".$year; 
	return $final;
	}
	
	function get_fansubs()
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$pre="SELECT * from fansubs order by fansub_nombre asc";
		$ok=mysqli_prepare($conexion,$pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$ok1=mysqli_stmt_execute($ok);
		$ok2=mysqli_stmt_bind_result($ok,$fansub_id,$fansub_nombre,$fansub_enlace);
		$f=0;
        while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['fansub_nombre']=$fansub_nombre;
			$ras[$f]['fansub_enlace']=$fansub_enlace;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
	function get_fansubbyid($filtro)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$pre="SELECT * from fansubs where fansubs.fansub_id=?";
		$ok=mysqli_prepare($conexion,$pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$param=mysqli_stmt_bind_param($ok,"i",$filtro);
		$resul=mysqli_stmt_bind_result($ok,$fansub_id,$fansub_nombre,$fansub_enlace);
		$exe=mysqli_stmt_execute($ok);
		
        while(mysqli_stmt_fetch($ok))
		{
			$ras['fansub_id']=$fansub_id;
			$ras['fansub_nombre']=$fansub_nombre;
			$ras['fansub_enlace']=$fansub_enlace;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
	function getpaginas($filtro,$typo){
        $con= new bbdd;
        $conexion=$con->conect();
		$items_pp=20;
		if(empty($filtro))
		{
			$pre="SELECT * from obras";
			$res=mysqli_query($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
        	$num=mysqli_num_rows($res);
		}
		else
		{
			if($typo=="busqueda")
			{
				$pre="SELECT obra_id from obras where Match(obra_keywords) AGAINST ('$filtro')";
				$res=mysqli_query($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos segunda");
        		$num=mysqli_num_rows($res);
			}
			if($typo=="genero")
			{
				$pre="SELECT * from obras where obras.obra_generos LIKE '%".$filtro."%'";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok1=mysqli_stmt_execute($res);
				$ok2=mysqli_stmt_bind_result($res,$obra_id,$tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,$obra_patrocinada,
											 $patrocinador_id,$obra_fecha_inicio,$obra_caratula,$obra_miniatura,$obra_keywords);
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$z=0;
					}
					else
					{
						$z=$pagina-1;
						$z=$z*$items_pp;
					}
				}	
				else
				{
					$z=0;
				}
				$y=0;
				$v=0;
				while(mysqli_stmt_fetch($res))
				{
					$generos=explode(",",$obra_generos);
					$cou=sizeof($generos);
					for($x=0;$x<$cou;$x++)
					{
						if($generos[$x]==$filtro)
						{
							if($y>=$z)
							{
								$ras[$v]['obra_id']=$obra_id;	
								$ras[$v]['tipo_id']=$tipo_id;
								$ras[$v]['obra_nombre']=$obra_nombre;
								$ras[$v]['obra_generos']=$obra_generos;
								$ras[$v]['obra_sinopsis']=$obra_sinopsis;
                                $ras[$v]['obra_estado']=$obra_estado;
                                $ras[$v]['obra_periodo']=$obra_periodo;
                                $ras[$v]['obra_patrocinada']=$obra_patrocinada;
                                $ras[$v]['patrocinador_id']=$patrocinador_id;
								$ras[$v]['obra_fecha_inicio']=$obra_fecha_inicio;
								$ras[$v]['obra_caratula']=$obra_caratula;
								$ras[$v]['obra_miniatura']=$obra_miniatura;
								$ras[$v]['obra_keywords']=$obra_keywords;
								$y=$y+1;
								$v=$v+1;
								
							}
							else
							{
								$y=$y+1;
							}
						}
					}
				}
			$num= $y;
			@mysqli_stmt_close($res);
			}	
			if($typo=="tipo")
			{
				$pre="SELECT * from obras where obras.tipo_id=?";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
				$ok1=mysqli_stmt_execute($res);
				$num=mysqli_stmt_num_rows($res);
				@mysqli_stmt_close($res);
			}
			if($typo=="patrocinador")
			{
				$pre="SELECT * from obras where obras.patrocinador_id=?";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
				$ok1=mysqli_stmt_execute($res);
				$num=mysqli_stmt_num_rows($res);
				@mysqli_stmt_close($res);
			}
		}
		if(empty($num))
		{
			$num=0;
		}
		$items_pp=20;/* aqui definimos los items por pagina*/
		$fin['items_totales']=$num;/*items totales registrados en la bbdd*/
		$fin['items_pp']=$items_pp;
		$fin['paginas_totales']=ceil($num/$items_pp);/*numero de paginas obtenido dividiendo los item totales por los items por pagina*/
		if(!empty($res))
		{
			
		}
		return $fin;
	}
		
	
	function getnovelabygenero_id($filtro,$pagina){
		$con= new bbdd;
        $conexion=$con->conect();
		$items_pp=20;
        $consulta="SELECT * from novelas where novelas.novela_generos LIKE '%$filtro%' order by novelas.novela_nombre asc ";
        $resultado=mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");
        $num=mysqli_num_rows($resultado);
		if(!empty($pagina))
		{
			$z=$pagina;
			$z=$z-1;
			$z=$z*20;
		}	
		else
		{
			$z=0;
		}
		$y=0;
		$v=0;
        for($i=0;$i<$num;$i++)
        {
		 $reg[$i]=mysqli_fetch_array($resultado);
		 $generos=explode(",",$reg[$i]['novela_generos']);
		 $con=sizeof($generos);
			for($x=0;$x<$con;$x++)
			{
				
				if($generos[$x]==$filtro)
				{
					if($y>=$z)
					{
					$rog[$v]=$reg[$i];
					$y=$y+1;
					$v=$v+1;
					if($v==20)
					{
					return $rog;
					}
					}
					else
					{
					$y=$y+1;
					}
				}
			}
        }
		
        return $rog;
        }
	
	function sumardescargaporvolumenid($volumen_id,$novela_id)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$pregunta="SELECT * from dt where dt.novela_id='$novela_id'";
		$respuesta=mysqli_query($conexion, $pregunta) or die ( "Algo ha ido mal en la consulta a la base de datos dt1");
		if(mysqli_num_rows($respuesta)>0)
		{
			$res=mysqli_fetch_array($respuesta);
			$dt_numero=$res['dt_numero']+1;
			$pregunta2="Update dt Set dt_numero='$dt_numero' where novela_id='$novela_id'";
			$respuesta2=mysqli_query($conexion, $pregunta2) or die ( "Algo ha ido mal en la consulta a la base de datos dt2");
		}
		else
		{
			$dt_numero=1;
			$pregunta3="insert into dt(dt_id,novela_id,dt_numero)values(NULL,'$novela_id','$dt_numero')";
			$respuesta3=mysqli_query($conexion, $pregunta3) or die ( "Algo ha ido mal en la consulta a la base de datos dt3");
		}
      	$consulta="SELECT * from descargas where descargas.volumen_id='$volumen_id'";
		$resultado=mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");
		if(mysqli_num_rows($resultado)>0)
		{
			$reg=mysqli_fetch_array($resultado);
			$descarga_numero=$reg['descarga_numero']+1;
			$consulta2="Update descargas Set descarga_numero='$descarga_numero' where volumen_id='$volumen_id'";
			$resultado2=mysqli_query($conexion, $consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos");
		}
		else
		{
			$descarga_numero=1;
			$consulta3="insert into descargas(descarga_id,volumen_id,descarga_numero)values(NULL,'$volumen_id','$descarga_numero')";
			$resultado3=mysqli_query($conexion, $consulta3) or die ( "Algo ha ido mal en la consulta a la base de datos");
		}
	}
	
	function contartotaldescargasnovela()
	{
		$con= new bbdd;
        $conexion=$con->conect();
		
      	$consulta="SELECT * from novelas,dt where novelas.novela_id=dt.novela_id order by dt_numero desc limit 0,5";
		$resultado=mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$ok=mysqli_prepare($conexion,$consulta);
        $ok3=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,$novela_nombre_original,
									 $novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion,$dt_id,$novela_id,$dt_numero);
		$ok2=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['novela_nombre']=$novela_nombre;
			$ras[$f]['novela_nombre_original']=$novela_nombre_original;
			$ras[$f]['novela_generos']=$novela_generos;
			$ras[$f]['novela_sinopsis']=$novela_sinopsis;
			$ras[$f]['novela_caratula']=$novela_caratula;
			$ras[$f]['novela_miniatura']=$novela_miniatura;
			$ras[$f]['novela_keywords']=$novela_keywords;
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$ras[$f]['dt_id']=$dt_id;
			$ras[$f]['dt_numero']=$dt_numero;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	function contartotaldescargasnovela2()
	{
		$con= new bbdd;
        $conexion=$con->conect();
		
      	$consulta="SELECT * from novelas,dt where novelas.novela_id=dt.novela_id order by dt_numero desc limit 0,5";
		$resultado=mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$ok=mysqli_prepare($conexion,$consulta);
        $ok3=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,$novela_nombre_original,
									 $novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion,$dt_id,$novela_id,$dt_numero);
		$ok2=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['novela_nombre']=$novela_nombre;
			$ras[$f]['novela_nombre_original']=$novela_nombre_original;
			$ras[$f]['novela_generos']=$novela_generos;
			$ras[$f]['novela_sinopsis']=$novela_sinopsis;
			$ras[$f]['novela_caratula']=$novela_caratula;
			$ras[$f]['novela_miniatura']=$novela_miniatura;
			$ras[$f]['novela_keywords']=$novela_keywords;
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$ras[$f]['dt_id']=$dt_id;
			$ras[$f]['dt_numero']=$dt_numero;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	function getnovelabyprimeraletra($primera_letra){
		$con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT * from novelas where novelas.novela_nombre LIKE '?%' order by novelas.novela_nombre asc";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"s",$primera_letra);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['novela_nombre']=$novela_nombre;
			$ras[$f]['novela_nombre_original']=$novela_nombre_original;
			$ras[$f]['novela_generos']=$novela_generos;
			$ras[$f]['novela_sinopsis']=$novela_sinopsis;
			$ras[$f]['novela_caratula']=$novela_caratula;
			$ras[$f]['novela_miniatura']=$novela_miniatura;
			$ras[$f]['novela_keywords']=$novela_keywords;
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
    }
	
	function getgenerosbyid($genero_id){
        $con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT * from generos where generos.genero_id=?";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"i",$genero_id);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$genero_id,$genero);
		$f=0;
        while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['genero_id']=$genero_id;
			$ras[$f]['genero']=$genero;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
    }
	
	
	function getnovelabynombre($novela_nombre)
	{
		$con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT * from novelas where novelas.novela_nombre=?";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"s",$novela_nombre);
        $ok3=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion);
		$ok2=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['novela_nombre']=$novela_nombre;
			$ras[$f]['novela_nombre_original']=$novela_nombre_original;
			$ras[$f]['novela_generos']=$novela_generos;
			$ras[$f]['novela_sinopsis']=$novela_sinopsis;
			$ras[$f]['novela_caratula']=$novela_caratula;
			$ras[$f]['novela_miniatura']=$novela_miniatura;
			$ras[$f]['novela_keywords']=$novela_keywords;
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
	function getnovelabyid($novela_id,$novela_nombre){
        $con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT * from novelas,escritores,ilustradores,editoriales,fansubs 
					where novelas.novela_id=?
					and novelas.novela_nombre=?
					and escritores.escritor_id=novelas.escritor_id 
					and ilustradores.ilustrador_id=novelas.ilustrador_id 
					and editoriales.editorial_id=novelas.editorial_id 
					and fansubs.fansub_id=novelas.fansub_id order by novela_nombre asc";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"is",$novela_id,$novela_nombre);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion,$escritor_id,$escritor_nombre,$ilustrador_id,
									 $ilustrador_nombre,$editorial_id,$editorial_nombre,$editorial_enlace,$fansub_id,$fansub_nombre,$fansub_enlace);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['novela_nombre']=$novela_nombre;
			$ras[$f]['novela_nombre_original']=$novela_nombre_original;
			$ras[$f]['novela_generos']=$novela_generos;
			$ras[$f]['novela_sinopsis']=$novela_sinopsis;
			$ras[$f]['novela_caratula']=$novela_caratula;
			$ras[$f]['novela_miniatura']=$novela_miniatura;
			$ras[$f]['novela_keywords']=$novela_keywords;
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['escritor_nombre']=$escritor_nombre;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['ilustrador_nombre']=$ilustrador_nombre;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['editorial_nombre']=$editorial_nombre;
			$ras[$f]['editorial_enlace']=$editorial_enlace;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['fansub_nombre']=$fansub_nombre;
			$ras[$f]['fansub_enlace']=$fansub_enlace;
			
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
    }
	
	function getnovelabyidonly($novela_id){
        $con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT * from novelas,escritores,ilustradores,editoriales,fansubs 
					where novelas.novela_id=?
					and escritores.escritor_id=novelas.escritor_id 
					and ilustradores.ilustrador_id=novelas.ilustrador_id 
					and editoriales.editorial_id=novelas.editorial_id 
					and fansubs.fansub_id=novelas.fansub_id order by novela_nombre asc";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"i",$novela_id);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion,$escritor_id,$escritor_nombre,$ilustrador_id,
									 $ilustrador_nombre,$editorial_id,$editorial_nombre,$editorial_enlace,$fansub_id,$fansub_nombre,$fansub_enlace);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['novela_nombre']=$novela_nombre;
			$ras[$f]['novela_nombre_original']=$novela_nombre_original;
			$ras[$f]['novela_generos']=$novela_generos;
			$ras[$f]['novela_sinopsis']=$novela_sinopsis;
			$ras[$f]['novela_caratula']=$novela_caratula;
			$ras[$f]['novela_miniatura']=$novela_miniatura;
			$ras[$f]['novela_keywords']=$novela_keywords;
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['escritor_nombre']=$escritor_nombre;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['ilustrador_nombre']=$ilustrador_nombre;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['editorial_nombre']=$editorial_nombre;
			$ras[$f]['editorial_enlace']=$editorial_enlace;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['fansub_nombre']=$fansub_nombre;
			$ras[$f]['fansub_enlace']=$fansub_enlace;
			
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
    }
	
	function getvolumenesbynovelaid($novela_id){
        $con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT * from volumenes where volumenes.novela_id=? order by volumen_id asc";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"i",$novela_id);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$volumen_id,$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,$volumen_enlace_pdf,$volumen_enlace_video);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['volumen_id']=$volumen_id;
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['volumen']=$volumen;
			$ras[$f]['volumen_caratula']=$volumen_caratula;
			$ras[$f]['volumen_miniatura']=$volumen_miniatura;
			$ras[$f]['volumen_fecha_publicacion']=$volumen_fecha_publicacion;
			$ras[$f]['volumen_fecha_original']=$volumen_fecha_original;
			$ras[$f]['volumen_enlace_pdf']=$volumen_enlace_pdf;
			$ras[$f]['volumen_enlace_video']=$volumen_enlace_video;
			
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
    }
	function getvolumenesbyids($novela_id,$volumen_id){

		$con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT * from novelas,volumenes,escritores,ilustradores,editoriales,fansubs 
					where novelas.novela_id=?
					and volumenes.novela_id=novelas.novela_id
					and volumenes.volumen_id=?
					and escritores.escritor_id=novelas.escritor_id 
					and ilustradores.ilustrador_id=novelas.ilustrador_id 
					and editoriales.editorial_id=novelas.editorial_id 
					and fansubs.fansub_id=novelas.fansub_id order by novela_nombre asc";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"ii",$novela_id,$volumen_id);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion,
									 $volumen_id,$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,
									 $volumen_enlace_pdf,$volumen_enlace_video,$escritor_id,$escritor_nombre,$ilustrador_id,$ilustrador_nombre,$editorial_id,
									 $editorial_nombre,$editorial_enlace,$fansub_id,$fansub_nombre,$fansub_enlace);
        mysqli_stmt_fetch($ok);
			$ras['novela_id']=$novela_id;
			$ras['escritor_id']=$escritor_id;
			$ras['ilustrador_id']=$ilustrador_id;
			$ras['editorial_id']=$editorial_id;
			$ras['fansub_id']=$fansub_id;
			$ras['novela_nombre']=$novela_nombre;
			$ras['novela_nombre_original']=$novela_nombre_original;
			$ras['novela_generos']=$novela_generos;
			$ras['novela_sinopsis']=$novela_sinopsis;
			$ras['novela_caratula']=$novela_caratula;
			$ras['novela_miniatura']=$novela_miniatura;
			$ras['novela_keywords']=$novela_keywords;
			$ras['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$ras['volumen_id']=$volumen_id;
			$ras['volumen']=$volumen;
			$ras['volumen_caratula']=$volumen_caratula;
			$ras['volumen_miniatura']=$volumen_miniatura;
			$ras['volumen_fecha_publicacion']=$volumen_fecha_publicacion;
			$ras['volumen_fecha_original']=$volumen_fecha_original;
			$ras['volumen_enlace_pdf']=$volumen_enlace_pdf;
			$ras['volumen_enlace_video']=$volumen_enlace_video;
			$ras['escritor_id']=$escritor_id;
			$ras['escritor_nombre']=$escritor_nombre;
			$ras['ilustrador_id']=$ilustrador_id;
			$ras['ilustrador_nombre']=$ilustrador_nombre;
			$ras['editorial_id']=$editorial_id;
			$ras['editorial_nombre']=$editorial_nombre;
			$ras['editorial_enlace']=$editorial_enlace;
			$ras['fansub_id']=$fansub_id;
			$ras['fansub_nombre']=$fansub_nombre;
			$ras['fansub_enlace']=$fansub_enlace;
			
	@mysqli_stmt_close($ok);
    return $ras;
    }
	function guardarvolumenes($novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_original,$volumen_enlace_pdf,$volumen_enlace_video)
	{
		$con= new bbdd;
        $conexion=$con->conect();
        $consulta="insert into volumenes(volumen_id,novela_id,volumen,volumen_caratula,volumen_miniatura,volumen_fecha_publicacion,volumen_fecha_original,volumen_enlace)
				   values(NULL,?,?,?,?,NOW(),?,?)";
		$ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos novel paso 1");
		$params=mysqli_stmt_bind_param($ok,"isssss",$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_original,$volumen_enlace_pdf,$volumen_enlace_video);
        $exe=mysqli_stmt_execute($ok);
		@mysqli_stmt_close($ok);
	}
	
	function editarvolumenes($volumen_id,$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,$volumen_enlace_pdf,$volumen_enlace_video)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$reg['volumen_id']=$volumen_id;
		$reg['novela_id']=$novela_id;
		$reg['volumen']=$volumen;
		$reg['volumen_caratula']=$volumen_caratula;
		$reg['volumen_miniatura']=$volumen_miniatura;
		$reg['$volumen_fecha_publicacion']=$volumen_fecha_publicacion;
		$reg['$volumen_fecha_original']=$volumen_fecha_original;
		$reg['$volumen_enlace_pdf']=$volumen_enlace_pdf;
		$reg['$volumen_enlace_video']=$volumen_enlace_video;
        $consulta="UPDATE volumenes SET 
		volumen_id=?,
		novela_id=?,
		volumen=?,
		volumen_caratula=?,
		volumen_miniatura=?,
		volumen_fecha_publicacion=?,
		volumen_fecha_original=?,
		volumen_enlace=?
		WHERE volumenes.volumen_id=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ( "Algo ha ido mal en la consulta a la base de datos novel paso 1");
		$params=mysqli_stmt_bind_param($ok,
									   "iissssssi",
									   $reg['volumen_id'],
									   $reg['novela_id'],
									   $reg['volumen'],
									   $reg['volumen_caratula'],
									   $reg['volumen_miniatura'],
									   $reg['$volumen_fecha_publicacion'],
									   $reg['$volumen_fecha_original'],
									   $reg['$volumen_enlace_pdf'],
									   $reg['$volumen_enlace_video'],
									   $reg['volumen_id']);
        $exe=mysqli_stmt_execute($ok);
		@mysqli_stmt_close($ok);
	}
	
	function guardarnovela($escritor_nombre,$ilustrador_nombre,$editorial_nombre,$editorial_enlace,$fansub_nombre,
						   $fansub_enlace,$novela_nombre,$novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$reg['escritor_nombre']=$escritor_nombre;
		$reg['ilustrador_nombre']=$ilustrador_nombre;
		$reg['fansub_nombre']=$fansub_nombre;
		$reg['fansub_enlace']=$fansub_enlace;
		$reg['editorial_nombre']=$editorial_nombre;
		$reg['editorial_enlace']=$editorial_enlace;
		$consulta="SELECT * from editoriales 
							where editoriales.editorial_nombre=?";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos edit paso 3");
		$params=mysqli_stmt_bind_param($ok,"s",$reg['editorial_nombre']);
		$resultados=mysqli_stmt_bind_result($ok,$editorial_id,$editorial_nombre,$editorial_enlace);
		$exe=mysqli_stmt_execute($ok);
		while(mysqli_stmt_fetch($ok))
		{
			$reg['editorial_id']=$editorial_id;
			$reg['editorial_nombre']=$editorial_nombre;
			$reg['editorial_enlace']=$editorial_enlace;
		}
		@mysqli_stmt_close($ok);
		if(empty($reg['editorial_id']))
		{
			$consulta="insert into editoriales(editorial_id,
											   editorial_nombre,
											   editorial_enlace)
											   values(NULL,?,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ("Algo ha ido mal en la consulta a la base de datos edit paso 2 ".$reg['editorial_nombre']."");
			$params=mysqli_stmt_bind_param($ok,"ss",$reg['editorial_nombre'],$reg['editorial_enlace']);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from editoriales 
								where editoriales.editorial_nombre=?";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos edit paso 3");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['editorial_nombre']);
			$resultados=mysqli_stmt_bind_result($ok,$editorial_id,$editorial_nombre,$editorial_enlace);
			$exe2=mysqli_stmt_execute($ok);
			while(mysqli_stmt_fetch($ok))
			{
				$reg['editorial_id']=$editorial_id;
				$reg['editorial_nombre']=$editorial_nombre;
				$reg['editorial_enlace']=$editorial_enlace;
			}
			@mysqli_stmt_close($ok);
		}
		$consulta="SELECT * from escritores 
							where escritores.escritor_nombre=?";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos escri paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$reg['escritor_nombre']);
		$resultados=mysqli_stmt_bind_result($ok,$escritor_id,$escritor_nombre);
		$exe=mysqli_stmt_execute($ok);
		while(mysqli_stmt_fetch($ok))
		{
			$reg['escritor_id']=$escritor_id;
			$reg['escritor_nombre']=$escritor_nombre;
			
		}
		@mysqli_stmt_close($ok);
		if(empty($reg['escritor_id']))
		{
			$consulta="insert into escritores(escritor_id,
											  escritor_nombre)
								   			  values(NULL,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos escri paso 2");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['escritor_nombre']);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from escritores 
								where escritores.escritor_nombre=?";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos escri paso 3");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['escritor_nombre']);
			$resultados=mysqli_stmt_bind_result($ok,$escritor_id,$escritor_nombre);
			$exe=mysqli_stmt_execute($ok);
			while(mysqli_stmt_fetch($ok))
			{
				$reg['escritor_id']=$escritor_id;
				$reg['escritor_nombre']=$escritor_nombre;
			}
			@mysqli_stmt_close($ok);
		}
		$consulta="SELECT * from ilustradores 
							where ilustradores.ilustrador_nombre=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos ilus paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$reg['ilustrador_nombre']);
		$resultado=mysqli_stmt_bind_result($ok,$ilustrador_id,$ilustrador_nombre);
		$exe=mysqli_stmt_execute($ok);
		while(mysqli_stmt_fetch($ok))
		{
			$reg['ilustrador_id']=$ilustrador_id;
			$reg['ilustrador_nombre']=$ilustrador_nombre;
		}
		@mysqli_stmt_close($ok);
		if(empty($reg['ilustrador_id']))
		{
			$consulta="insert into ilustradores(ilustrador_id,
												ilustrador_nombre)
												values(NULL ,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ("Algo ha ido mal en la consulta a la base de datos ilus paso 2");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['ilustrador_nombre']);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from ilustradores 
								where ilustradores.ilustrador_nombre=?";
			$ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos ilus paso 1");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['ilustrador_nombre']);
			$resultado=mysqli_stmt_bind_result($ok,$ilustrador_id,$ilustrador_nombre);
			$exe=mysqli_stmt_execute($ok);
			while(mysqli_stmt_fetch($ok))
			{
				$reg['ilustrador_id']=$ilustrador_id;
				$reg['ilustrador_nombre']=$ilustrador_nombre;
			}
			@mysqli_stmt_close($ok);
		}
		
		$consulta="SELECT * from fansubs 
							where fansubs.fansub_nombre=?";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$reg['fansub_nombre']);
		$resultado=mysqli_stmt_bind_result($ok,$fansub_id,$fansub_nombre,$fansub_enlace);
		$exe=mysqli_stmt_execute($ok);
		while(mysqli_stmt_fetch($ok))
		{
			$reg['fansub_id']=$fansub_id;
			$reg['fansub_nombre']=$fansub_nombre;
			$reg['fansub_enlace']=$fansub_enlace;
		}
		@mysqli_stmt_close($ok);
		if(empty($reg['fansub_id']))
		{
			$consulta="insert into fansubs(fansub_id,
										   fansub_nombre,
										   fansub_enlace)
										   values(NULL,?,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 2");
			$params=mysqli_stmt_bind_param($ok,"ss",$reg['fansub_nombre'],$reg['fansub_enlace']);
			$resultado=mysqli_stmt_bind_result($ok,$fansub_id,$fansub_nombre,$fansub_enlace);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from fansubs 
								where fansubs.fansub_nombre=?";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 3");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['fansub_nombre']);
			$resultado=mysqli_stmt_bind_result($ok,$fansub_id,$fansub_nombre,$fansub_enlace);
			$exe=mysqli_stmt_execute($ok);
			while(mysqli_stmt_fetch($ok))
			{
				$reg['fansub_id']=$fansub_id;
				$reg['fansub_nombre']=$fansub_nombre;
				$reg['fansub_enlace']=$fansub_enlace;
			}
			@mysqli_stmt_close($ok);
		}		
		
		$escritor_id=$reg['escritor_id'];
		$ilustrador_id=$reg['ilustrador_id'];
		$editorial_id=$reg['editorial_id'];
		$fansub_id=$reg['fansub_id'];
        $consulta="insert into novelas(novela_id,
									   escritor_id,
									   ilustrador_id,
									   editorial_id,
									   fansub_id,
									   novela_nombre,
									   novela_nombre_original,
									   novela_generos,
									   novela_sinopsis,
									   novela_caratula,
									   novela_miniatura,
									   novela_keywords,
									   novela_fecha_publicacion)
				   values(NULL,?,?,?,?,?,?,?,?,?,?,NOW())";
        $ok=mysqli_prepare($conexion,$consulta) or die ( "Algo ha ido mal en la consulta a la base de datos novel paso 1");
	    $ok1=mysqli_stmt_bind_param($ok,"iiiisssssss",$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords);
        $ok2=mysqli_stmt_execute($ok);
        $consulta2="SELECT * from novelas
		where novelas.novela_nombre=?
		and novelas.novela_caratula=?";
		$ok3=mysqli_prepare($conexion,$consulta2) or die ("Algo ha ido mal en la consulta a la base de datos novel paso 2");
		$ok4=mysqli_stmt_bind_param($ok3,"ss",$novela_nombre,$novela_caratula);
		$ok6=mysqli_stmt_bind_result($ok3,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion); 
		$ok5=mysqli_stmt_execute($ok3);
        
		while(mysqli_stmt_fetch($ok3))
		{
			$ras['novela_id']=$novela_id;
			$ras['escritor_id']=$escritor_id;
			$ras['ilustrador_id']=$ilustrador_id;
			$ras['editorial_id']=$editorial_id;
			$ras['fansub_id']=$fansub_id;
			$ras['novela_nombre']=$novela_nombre;
			$ras['novela_nombre_original']=$novela_nombre_original;
			$ras['novela_generos']=$novela_generos;
			$ras['novela_sinopsis']=$novela_sinopsis;
			$ras['novela_caratula']=$novela_caratula;
			$ras['novela_miniatura']=$novela_miniatura;
			$ras['novela_keywords']=$novela_keywords;
			$ras['novela_fecha_publicacion']=$novela_fecha_publicacion;
		}
	@mysqli_stmt_close($ok);
	@mysqli_stmt_close($ok3);
			$error="<table><tr><td> escritor_id </td><td>".$reg['escritor_id']."</td></tr>
				   <tr><td> escritor_nombre </td><td>".$reg['escritor_nombre']."</td></tr>
				   <tr><td> ilustrador_id </td><td>".$reg['ilustrador_id']."</td></tr>
				   <tr><td> ilustrador_nombre </td><td>".$reg['ilustrador_nombre']."</td></tr>
				   <tr><td> editorial_id </td><td>".$reg['editorial_id']."</td></tr>
				   <tr><td> editorial_nombre </td><td>".$reg['editorial_nombre']."</td></tr>
				   <tr><td> fansub_id </td><td>".$reg['fansub_id']."</td></tr>
				   <tr><td> fansub_nombre </td><td>".$reg['fansub_nombre']."</td></tr>
				   <tr><td> novela_nombre </td><td>".$novela_nombre."</td></tr>
				   <tr><td> novela_nombre_original </td><td>".$novela_nombre_original."</td></tr>
				   <tr><td> novela_generos </td><td>".$novela_generos."</td></tr>
				   <tr><td> novela_sinopsis </td><td>".$novela_sinopsis."</td></tr>
				   <tr><td> novela_caratula </td><td>".$novela_caratula."</td></tr>
				   <tr><td> novela_caratula </td><td>".$novela_miniatura."</td></tr>
				   <tr><td> novela_caratula </td><td>".$novela_keywords."</td></tr>
				   <tr><td> novela_fecha_publicacion </td><td>".$novela_fecha_publicacion."</td></tr></table>";
    /*return $ras;*/
		echo $error;
    }
	
	
	function editar_novela($novela_id,$escritor_nombre,$ilustrador_nombre,$editorial_nombre,$editorial_enlace,$fansub_nombre,
						   $fansub_enlace,$novela_nombre,$novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$reg['novela_id']=$novela_id;
		$reg['escritor_nombre']=$escritor_nombre;
		$reg['ilustrador_nombre']=$ilustrador_nombre;
		$reg['editorial_nombre']=$editorial_nombre;
		$reg['editorial_enlace']=$editorial_enlace;
		$reg['fansub_nombre']=$fansub_nombre;
		$reg['fansub_enlace']=$fansub_enlace;
		$reg['novela_nombre']=$novela_nombre;
		$reg['novela_nombre_original']=$novela_nombre_original;
		$reg['novela_generos']=$novela_generos;
		$reg['novela_sinopsis']=$novela_sinopsis;
		$reg['novela_caratula']=$novela_caratula;
		$reg['novela_miniatura']=$novela_miniatura;
		$reg['novela_keywords']=$novela_keywords;
		
		
		$consulta="SELECT * from editoriales where editoriales.editorial_nombre=?";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos edit paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$reg['editorial_nombre']);
		$resultados=mysqli_stmt_bind_result($ok,$editorial_id,$editorial_nombre,$editorial_enlace);
		$exe=mysqli_stmt_execute($ok);
		while(mysqli_stmt_fetch($ok))
		{
			$reg['editorial_id']=$editorial_id;
			$reg['editorial_nombre']=$editorial_nombre;
			$reg['editorial_enlace']=$editorial_enlace;
		}
		@mysqli_stmt_close($ok);
		if(empty($reg['editorial_id']))
		{
			$consulta="insert into editoriales(editorial_id,
											   editorial_nombre,
											   editorial_enlace)
											   values(NULL,?,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ("Algo ha ido mal en la consulta a la base de datos edit paso 2");
			$params=mysqli_stmt_bind_param($ok,"ss",$reg['editorial_nombre'],$reg['editorial_enlace']);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from editoriales 
								where editoriales.editorial_nombre=?";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos edit paso 3");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['editorial_nombre']);
			$resultados=mysqli_stmt_bind_result($ok,$editorial_id,$editorial_nombre,$editorial_enlace);
			$exe2=mysqli_stmt_execute($ok);
			while(mysqli_stmt_fetch($ok))
			{
				$reg['editorial_id']=$editorial_id;
				$reg['editorial_nombre']=$editorial_nombre;
				$reg['editorial_enlace']=$editorial_enlace;
			}
			@mysqli_stmt_close($ok);
		}
		$consulta="SELECT * from escritores 
							where escritores.escritor_nombre=?";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos escri paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$reg['escritor_nombre']);
		$resultados=mysqli_stmt_bind_result($ok,$escritor_id,$escritor_nombre);
		$exe=mysqli_stmt_execute($ok);
		while(mysqli_stmt_fetch($ok))
		{
			$reg['escritor_id']=$escritor_id;
			$reg['escritor_nombre']=$escritor_nombre;
			
		}
		@mysqli_stmt_close($ok);
		if(empty($reg['escritor_id']))
		{
			$consulta="insert into escritores(escritor_id,
											  escritor_nombre)
								   			  values(NULL,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos escri paso 2");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['escritor_nombre']);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from escritores 
								where escritores.escritor_nombre=?";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos escri paso 3");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['escritor_nombre']);
			$resultados=mysqli_stmt_bind_result($ok,$escritor_id,$escritor_nombre);
			$exe=mysqli_stmt_execute($ok);
			while(mysqli_stmt_fetch($ok))
			{
				$reg['escritor_id']=$escritor_id;
				$reg['escritor_nombre']=$escritor_nombre;
			}
			@mysqli_stmt_close($ok);
		}
		$consulta="SELECT * from ilustradores 
							where ilustradores.ilustrador_nombre=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos ilus paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$reg['ilustrador_nombre']);
		$resultado=mysqli_stmt_bind_result($ok,$ilustrador_id,$ilustrador_nombre);
		$exe=mysqli_stmt_execute($ok);
		while(mysqli_stmt_fetch($ok))
		{
			$reg['ilustrador_id']=$ilustrador_id;
			$reg['ilustrador_nombre']=$ilustrador_nombre;
		}
		@mysqli_stmt_close($ok);
		if(empty($reg['ilustrador_id']))
		{
			$consulta="insert into ilustradores(ilustrador_id,
												ilustrador_nombre)
												values(NULL ,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ("Algo ha ido mal en la consulta a la base de datos ilus paso 2");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['ilustrador_nombre']);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from ilustradores 
								where ilustradores.ilustrador_nombre=?";
			$ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos ilus paso 1");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['ilustrador_nombre']);
			$resultado=mysqli_stmt_bind_result($ok,$ilustrador_id,$ilustrador_nombre);
			$exe=mysqli_stmt_execute($ok);
			while(mysqli_stmt_fetch($ok))
			{
				$reg['ilustrador_id']=$ilustrador_id;
				$reg['ilustrador_nombre']=$ilustrador_nombre;
			}
			@mysqli_stmt_close($ok);
		}
		
		$consulta="SELECT * from fansubs 
							where fansubs.fansub_nombre=?";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$reg['fansub_nombre']);
		$resultado=mysqli_stmt_bind_result($ok,$fansub_id,$fansub_nombre,$fansub_enlace);
		$exe=mysqli_stmt_execute($ok);
		while(mysqli_stmt_fetch($ok))
		{
			$reg['fansub_id']=$fansub_id;
			$reg['fansub_nombre']=$fansub_nombre;
			$reg['fansub_enlace']=$fansub_enlace;
		}
		@mysqli_stmt_close($ok);
		if(empty($reg['fansub_id']))
		{
			$consulta="insert into fansubs(fansub_id,
										   fansub_nombre,
										   fansub_enlace)
										   values(NULL,?,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 2");
			$params=mysqli_stmt_bind_param($ok,"ss",$reg['fansub_nombre'],$reg['fansub_enlace']);
			$resultado=mysqli_stmt_bind_result($ok,$fansub_id,$fansub_nombre,$fansub_enlace);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from fansubs 
								where fansubs.fansub_nombre=?";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 3");
			$params=mysqli_stmt_bind_param($ok,"s",$reg['fansub_nombre']);
			$resultado=mysqli_stmt_bind_result($ok,$fansub_id,$fansub_nombre,$fansub_enlace);
			$exe=mysqli_stmt_execute($ok);
			while(mysqli_stmt_fetch($ok))
			{
				$reg['fansub_id']=$fansub_id;
				$reg['fansub_nombre']=$fansub_nombre;
				$reg['fansub_enlace']=$fansub_enlace;
			}
		}		
		@mysqli_stmt_close($ok);
		$escritor_id=$reg['escritor_id'];
		$ilustrador_id=$reg['ilustrador_id'];
		$editorial_id=$reg['editorial_id'];
		$fansub_id=$reg['fansub_id'];
        $consulta="UPDATE novelas 
				   SET novela_id=?,
				   escritor_nombre=?,
				   ilustrador_nombre=?,
				   editorial_nombre=?,
				   fansub_nombre=?,
				   novela_nombre=?,
				   novela_nombre_original=?,
				   novela_generos=?,
				   novela_sinopsis=?,
				   novela_caratula=?,
				   novela_miniatura=?,
				   novela_keywords=?,
				   novela_fecha_publicacion='NOW()',
				   WHERE novelas.novela_id=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ( "Algo ha ido mal en la consulta a la base de datos novel paso 1");
	    $params=mysqli_stmt_bind_param($ok,
									   "iiiiisssssssi",
									   $reg['novela_id'],
									   $reg['escritor_nombre'],
									   $reg['ilustrador_nombre'],
									   $reg['editorial_nombre'],
									   $reg['fansub_nombre'],
									   $reg['novela_nombre'],
									   $reg['novela_nombre_original'],
									   $reg['novela_generos'],
									   $reg['novela_sinopsis'],
									   $reg['novela_caratula'],
									   $reg['novela_miniatura'],
									   $reg['novela_keywords'],
									   $reg['novela_id']);
        $ok2=mysqli_stmt_execute($ok);
        $consulta="SELECT * from novelas
		where novelas.novela_nombre=?
		and novelas.novela_caratula=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos novel paso 2");
		$params=mysqli_stmt_bind_param($ok,"ss",$reg['novela_nombre'],$reg['novela_caratula']);
		$resultado=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion); 
		$exe=mysqli_stmt_execute($ok); 
		while(mysqli_stmt_fetch($ok))
		{
			$ras['novela_id']=$novela_id;
			$ras['escritor_id']=$escritor_id;
			$ras['ilustrador_id']=$ilustrador_id;
			$ras['editorial_id']=$editorial_id;
			$ras['fansub_id']=$fansub_id;
			$ras['novela_nombre']=$novela_nombre;
			$ras['novela_nombre_original']=$novela_nombre_original;
			$ras['novela_generos']=$novela_generos;
			$ras['novela_sinopsis']=$novela_sinopsis;
			$ras['novela_caratula']=$novela_caratula;
			$ras['novela_miniatura']=$novela_miniatura;
			$ras['novela_keywords']=$novela_keywords;
			$ras['novela_fecha_publicacion']=$novela_fecha_publicacion;
		}
	@mysqli_stmt_close($ok);
			$error="<table><tr><td> escritor_id </td><td>".$reg['escritor_id']."</td></tr>
				   <tr><td> escritor_nombre </td><td>".$reg['escritor_nombre']."</td></tr>
				   <tr><td> ilustrador_id </td><td>".$reg['ilustrador_id']."</td></tr>
				   <tr><td> ilustrador_nombre </td><td>".$reg['ilustrador_nombre']."</td></tr>
				   <tr><td> editorial_id </td><td>".$reg['editorial_id']."</td></tr>
				   <tr><td> editorial_nombre </td><td>".$reg['editorial_nombre']."</td></tr>
				   <tr><td> fansub_id </td><td>".$reg['fansub_id']."</td></tr>
				   <tr><td> fansub_nombre </td><td>".$reg['fansub_nombre']."</td></tr>
				   <tr><td> novela_nombre </td><td>".$novela_nombre."</td></tr>
				   <tr><td> novela_nombre_original </td><td>".$novela_nombre_original."</td></tr>
				   <tr><td> novela_generos </td><td>".$novela_generos."</td></tr>
				   <tr><td> novela_sinopsis </td><td>".$novela_sinopsis."</td></tr>
				   <tr><td> novela_caratula </td><td>".$novela_caratula."</td></tr>
				   <tr><td> novela_caratula </td><td>".$novela_keywords."</td></tr>
				   <tr><td> novela_fecha_publicacion </td><td>".$novela_fecha_publicacion."</td></tr></table>";
    return $error;
    }
	
	
	function borrarnovela($novela_id)
	{
			$con= new bbdd;
			$conexion=$con->conect();
			$consulta="delete from novelas WHERE novelas.novela_id".$novela_id."";
			$resultado=mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");
		}
	
	
	
	function getvolumenes()
	{
		$con= new bbdd;
		$conexion=$con->conect();
		$consulta="SELECT * FROM volumenes";
		$ok=mysqli_prepare($conexion,$consulta);
        $resultado=mysqli_stmt_bind_result($ok,$volumen_id,$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,$volumen_enlace_pdf,$volumen_enlace_video);
		$exe=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['volumen_id']=$volumen_id;
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['volumen']=$volumen;
			$ras[$f]['volumen_caratula']=$volumen_caratula;
			$ras[$f]['volumen_miniatura']=$volumen_miniatura;
			$ras[$f]['volumen_fecha_publicacion']=$volumen_fecha_publicacion;
			$ras[$f]['volumen_fecha_original']=$volumen_fecha_original;
			$ras[$f]['volumen_enlace_pdf']=$volumen_enlace_pdf;
			$ras[$f]['volumen_enlace_video']=$volumen_enlace_video;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
	
	
	function getultimosvolumenes()
	{
		$con= new bbdd;
		$conexion=$con->conect();
		$consulta="SELECT * FROM volumenes, novelas WHERE volumenes.volumen!=1 and novelas.novela_id=volumenes.novela_id order by volumenes.volumen_fecha_publicacion desc limit 0, 5";
		$ok=mysqli_prepare($conexion,$consulta);
        $ok3=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,$novela_nombre_original,
									 $novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion,$volumen_id,$volumen,
									 $volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,$volumen_enlace_pdf,$volumen_enlace_video);
		$ok2=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['novela_nombre']=$novela_nombre;
			$ras[$f]['novela_nombre_original']=$novela_nombre_original;
			$ras[$f]['novela_generos']=$novela_generos;
			$ras[$f]['novela_sinopsis']=$novela_sinopsis;
			$ras[$f]['novela_caratula']=$novela_caratula;
			$ras[$f]['novela_miniatura']=$novela_miniatura;
			$ras[$f]['novela_keywords']=$novela_keywords;
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$ras[$f]['volumen_id']=$volumen_id;
			$ras[$f]['volumen']=$volumen;
			$ras[$f]['volumen_caratula']=$volumen_caratula;
			$ras[$f]['volumen_miniatura']=$volumen_miniatura;
			$ras[$f]['volumen_fecha_publicacion']=$volumen_fecha_publicacion;
			$ras[$f]['volumen_fecha_original']=$volumen_fecha_original;
			$ras[$f]['volumen_enlace_pdf']=$volumen_enlace_pdf;
			$ras[$f]['volumen_enlace_video']=$volumen_enlace_video;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
   function getultimasnovelas()
   {
		$con= new bbdd;
		$conexion=$con->conect();
		$consulta="SELECT * FROM volumenes,novelas WHERE volumenes.volumen=1 and volumenes.novela_id=novelas.novela_id order by novelas.novela_fecha_publicacion desc limit 0, 10";
		$ok=mysqli_prepare($conexion,$consulta);
        $ok3=mysqli_stmt_bind_result($ok,$volumen_id,$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,
									 $volumen_enlace_pdf,$volumen_enlace_video,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,$novela_nombre_original,
									 $novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion);
		$ok2=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['volumen_id']=$volumen_id;
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['volumen']=$volumen;
			$ras[$f]['volumen_caratula']=$volumen_caratula;
			$ras[$f]['volumen_miniatura']=$volumen_miniatura;
			$ras[$f]['volumen_fecha_publicacion']=$volumen_fecha_publicacion;
			$ras[$f]['volumen_fecha_original']=$volumen_fecha_original;
			$ras[$f]['volumen_enlace_pdf']=$volumen_enlace_pdf;
			$ras[$f]['volumen_enlace_video']=$volumen_enlace_video;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['novela_nombre']=$novela_nombre;
			$ras[$f]['novela_nombre_original']=$novela_nombre_original;
			$ras[$f]['novela_generos']=$novela_generos;
			$ras[$f]['novela_sinopsis']=$novela_sinopsis;
			$ras[$f]['novela_caratula']=$novela_caratula;
			$ras[$f]['novela_miniatura']=$novela_miniatura;
			$ras[$f]['novela_keywords']=$novela_keywords;
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
	function getultimosvideos()
	{
		$con= new bbdd;
		$obr= new Obra;
		$conexion=$con->conect();
		$consulta="SELECT * FROM videos,obras,estados,tipos,periodos WHERE videos.video_fecha BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND CURDATE() 
		AND obras.obra_id=videos.obra_id 
		AND estados.estado_id=obras.obra_estado 
		AND tipos.tipo_id=obras.tipo_id 
		AND periodos.periodo_id=obras.obra_periodo ORDER BY videos.video_id DESC LIMIT 0, 5";
		$ok=mysqli_prepare($conexion,$consulta);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$video_id,$obra_id,$fansub_id,$web_id,$video_capitulo_inicio,$video_capitulo_fin,$video_titulo,$video_caratula,$video_miniatura,
									 $video_visivilidad,$video_fecha,$video_enlace,$obra_id,$tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,
									 $obra_patrocinada, $patrocinador_id,$obra_fecha_inicio,$obra_caratula,$obra_miniatura,$obra_keywords,$estado_id,$estado,$tipo_id,$tipo,
									 $periodo_id,$periodo);
		$v=0;
        while(mysqli_stmt_fetch($ok))
		{
			$fan=$obr->get_fansub_by_id($fansub_id);
			$we=$obr->get_webs_by_id($web_id);
			$ras[$v]['obra_id']=$obra_id;	
			$ras[$v]['tipo_id']=$tipo_id;
			$ras[$v]['obra_nombre']=$obra_nombre;
			$ras[$v]['obra_generos']=$obra_generos;
			$ras[$v]['obra_sinopsis']=$obra_sinopsis;
			$ras[$v]['obra_estado']=$obra_estado;
			$ras[$v]['obra_periodo']=$obra_periodo;
			$ras[$v]['obra_patrocinada']=$obra_patrocinada;
			$ras[$v]['patrocinador_id']=$patrocinador_id;
			$ras[$v]['obra_fecha_inicio']=$obra_fecha_inicio;
			$ras[$v]['obra_caratula']=$obra_caratula;
			$ras[$v]['obra_miniatura']=$obra_miniatura;
			$ras[$v]['obra_keywords']=$obra_keywords;
			$ras[$v]['estado_id']=$estado_id;
			$ras[$v]['estado']=$estado;
			$ras[$v]['tipo_id']=$tipo_id;
			$ras[$v]['tipo']=$tipo;
			$ras[$v]['periodo_id']=$periodo_id;
			$ras[$v]['periodo']=$periodo;
			$ras[$v]['video_id']=$video_id;
			$ras[$v]['obra_id']=$obra_id;
			$ras[$v]['fansub_id']=$fan['fansub_id'];
			$ras[$v]['fansub_nombre']=$fan['fansub_nombre'];
			$ras[$v]['fansub_enlace']=$fan['fansub_enlace'];
			$ras[$v]['web_id']=$we['web_id'];
			$ras[$v]['web']=$we['web'];
			$ras[$v]['video_capitulo_inicio']=$video_capitulo_inicio;
			$ras[$v]['video_capitulo_fin']=$video_capitulo_fin;
			$ras[$v]['video_titulo']=$video_titulo;
			$ras[$v]['video_caratula']=$video_caratula;
			$ras[$v]['video_miniatura']=$video_miniatura;
			$ras[$v]['video_publicacion']=$video_visivilidad;
			$ras[$v]['video_fecha']=$video_fecha;
			$ras[$v]['video_enlace']=$video_enlace;
			$v=$v+1;
		}
			
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
   function getultimasnovelas2()
   {
		$con= new bbdd;
		$conexion=$con->conect();
		$consulta="SELECT * FROM volumenes,novelas WHERE volumenes.volumen=1 and volumenes.novela_id=novelas.novela_id order by novelas.novela_fecha_publicacion desc limit 0, 5";
		$ok=mysqli_prepare($conexion,$consulta);
        $ok3=mysqli_stmt_bind_result($ok,$volumen_id,$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,
									 $volumen_enlace_pdf,$volumen_enlace_video,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,$novela_nombre_original,
									 $novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_keywords,$novela_fecha_publicacion);
		$ok2=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['volumen_id']=$volumen_id;
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['volumen']=$volumen;
			$ras[$f]['volumen_caratula']=$volumen_caratula;
			$ras[$f]['volumen_miniatura']=$volumen_miniatura;
			$ras[$f]['volumen_fecha_publicacion']=$volumen_fecha_publicacion;
			$ras[$f]['volumen_fecha_original']=$volumen_fecha_original;
			$ras[$f]['volumen_enlace_pfd']=$volumen_enlace_pdf;
			$ras[$f]['volumen_enlace_video']=$volumen_enlace_video;
			$ras[$f]['escritor_id']=$escritor_id;
			$ras[$f]['ilustrador_id']=$ilustrador_id;
			$ras[$f]['editorial_id']=$editorial_id;
			$ras[$f]['fansub_id']=$fansub_id;
			$ras[$f]['novela_nombre']=$novela_nombre;
			$ras[$f]['novela_nombre_original']=$novela_nombre_original;
			$ras[$f]['novela_generos']=$novela_generos;
			$ras[$f]['novela_sinopsis']=$novela_sinopsis;
			$ras[$f]['novela_caratula']=$novela_caratula;
			$ras[$f]['novela_miniatura']=$novela_miniatura;
			$ras[$f]['novela_keywords']=$novela_keywords;
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
function feed($feedURL)
{
	$noticias="";
	$i   = 0; 
	$url = $feedURL; 
	$content="http://purl.org/rss/1.0/modules/content/";
	$rss = simplexml_load_file($url); 
	$sin=0;
    foreach($rss->channel->item as $item) 
	{ 
		$link   	 = $item->link;  	//extrae el link
		$title   	 = $item->title;  	//extrae el titulo
		$date    	 = $item->pubDate;  //extrae la fecha
		$guid        = $item->guid;  	//extrae el link de la imagen
		$coments     = $item->comments;	//extrae el cuerpo del articulo
		$category    = $item->category;
		$description = strip_tags($item->description);  //extrae la descripcion
		if (strlen($description) > 400) { //limita la descripcion a 400 caracteres
		$stringCut   = substr($description, 0, 160);                   
		$description = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';}
		$fecha=explode(' ',$date);
		$ano=$fecha[3];
		$image=$item->children($content)->encoded;
		$imagen=explode('<img ',$image);
		@$imag=explode('/>',$imagen[1]);
		$salida=$imag[0];
		$probando=explode("src=",$imag[0]);
		@$proban=explode('"',$probando[1]);
		if(empty($imagen[1]))
		{
			$sin=$sin+1;
			continue 1;
			/*$imagen=explode('<center>',$image);
			$imag=explode('</center>',$imagen[1]);
			$ima='<td style="height:100px; width:100px;"><center>'.$imag[0].'</center></td>';*/
		}
		$nombre=substr($proban[1],strrpos($proban[1],"/")+1);
		$rutaimg=$proban[1];
		$destino="../recursos/noticias/";
		$xmax=100;
		$ymax=100;
		$ext = explode(".", $nombre);
		$compara=$destino.$ext[0].".webp";
		if (file_exists($compara)) 
		{
			$nombre=$ext[0].".webp";
		}
		else
		{
			$nombre=$ext[0].".webp";
			$ext = $ext[count($ext)-1];  
			if($ext == "jpg" || $ext == "jpeg")
			{  
				$imagen = imagecreatefromjpeg($rutaimg);
			}  
			elseif($ext == "png")
			{
				$imagen = imagecreatefrompng($rutaimg); 
			}  
			elseif($ext == "gif") 
			{
				$imagen = imagecreatefromgif($rutaimg);
			} 
			if(is_array($imagen)) 
			{
				continue 1;
			}
			else
			{
				$x = imagesx($imagen);  
				$y = imagesy($imagen);
			}
			/*if($x <= $xmax && $y <= $ymax){
				echo "<center>Esta imagen ya esta optimizada para los maximos que deseas.<center>";
				return $imagen;  
			}

			if($x <= $y) {  
				$nuevax = $xmax;  
				$nuevay = $nuevax * $y / $x;  
			}  
			else {  
				$nuevay = $ymax;  
				$nuevax = $x / $y * $nuevay;  
			}  */
			$lienzo = imagecreatetruecolor(100, 100);
			imagecopyresampled($lienzo,$imagen,0,0,0,0,100, 100,$x,$y);
			imagewebp($lienzo,$destino.$nombre,100);
			imagedestroy($lienzo);
		}
		/* file_put_contents($destino, file_get_contents($proban[1]));	*/
		$salida='src="recursos/noticias/'.$nombre.'"';	
		$ima='<td><img alt="'.$title.'" style="height:100px; width:100px;"'.$salida.'></td>';
		if($fecha[0]=="Mon,")
		{$fecha[0]="Lunes, ";}
		if($fecha[0]=="Tue,")
		{$fecha[0]="Martes, ";}
		if($fecha[0]=="Wed,")
		{$fecha[0]="Miercoles, ";}
		if($fecha[0]=="Thu,")
		{$fecha[0]="Jueves, ";}
		if($fecha[0]=="Fri,")
		{$fecha[0]="Viernes, ";}
		if($fecha[0]=="Sat,")
		{$fecha[0]="Sábado, ";}
		if($fecha[0]=="Sun,")
		{$fecha[0]="Domingo, ";}
		if($fecha[2]=="Jan")
		{$fecha[2]="Ene";$mes="01";}
		if($fecha[2]=="Feb")
		{$fecha[2]="Feb";$mes="02";}
		if($fecha[2]=="Mar")
		{$fecha[2]="Mar";$mes="03";}
		if($fecha[2]=="Apr")
		{$fecha[2]="Abr";$mes="04";}
		if($fecha[2]=="May")
		{$fecha[2]="May";$mes="05";}
		if($fecha[2]=="Jun")
		{$fecha[2]="Jun";$mes="06";}
		if($fecha[2]=="Jul")
		{$fecha[2]="Jul";$mes="07";}
		if($fecha[2]=="Aug")
		{$fecha[2]="Ago";$mes="08";}
		if($fecha[2]=="Sep")
		{$fecha[2]="Sep";$mes="09";}
		if($fecha[2]=="Oct")
		{$fecha[2]="Oct";$mes="10";}
		if($fecha[2]=="Nov")
		{$fecha[2]="Nov";$mes="11";}
		if($fecha[2]=="Dec")
		{$fecha[2]="Dic";$mes="12";}		
		$fecha=$fecha[0]." ".$fecha[1]." ".$fecha[2]." ".$fecha[3]." ".$fecha[4]." ";
		if ($i <= 14) 
		{ // extrae solo 8 items
			 $noticias.='<a rel="noreferrer" href="'.$guid.'"target="_blank" style="text-decoration:none; background-color:rgba(0,0,0,0.00); color:black;">
			 <div class="conct" style="margin-bottom:2px;">
			 <div class="tit">'.$title.'</div>
			 <div class="fig">'.$ima.'</div>
			 <div class="art">'.$description.'</div>
			 <div class="cat">'.$category.'</div>
			 <div class="dat">'.$fecha.'</div>
			 </div>
			 </a>';
		}
		$i++;
	}
	$noticias.='<div class="logosomos"> 
			<a class="logoso" rel="noreferrer" target="_blank" href="https://somoskudasai.com/">
				<h3>Estas noticias son proporcionadas por</h3>
					<img class="tran" alt="logo SomosKudasai" src="recursos/iconos/kudasai.png">	
			</a> 
		</div>';
		return $noticias;
}
	
function feeed($feedURL)
{
	$noticias="";
	$i   = 0; 
	$url = $feedURL; 
	$content="http://purl.org/rss/1.0/modules/content/";
	$rss = simplexml_load_file($url); 
	$sin=0;
    foreach($rss->channel->item as $item) 
	{ 
		$link   	 = $item->link;  	//extrae el link
		$title   	 = $item->title;  	//extrae el titulo
		$date    	 = $item->pubDate;  //extrae la fecha
		$guid        = $item->guid;  	//extrae el link de la imagen
		$coments     = $item->comments;	//extrae el cuerpo del articulo
		$category    = $item->category;
		$description = strip_tags($item->description);  //extrae la descripcion
		if (strlen($description) > 400) { //limita la descripcion a 400 caracteres
		$stringCut   = substr($description, 0, 160);                   
		$description = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';}
		$fecha=explode(' ',$date);
		$ano=$fecha[3];
		$image=$item->children($content)->encoded;
		$imagen=explode('<img ',$image);
		@$imag=explode('/>',$imagen[1]);
		$salida=$imag[0];
		$probando=explode("src=",$imag[0]);
		@$proban=explode('"',$probando[1]);
		if(empty($imagen[1]))
		{
			$sin=$sin+1;
			continue 1;
			/*$imagen=explode('<center>',$image);
			$imag=explode('</center>',$imagen[1]);
			$ima='<td style="height:100px; width:100px;"><center>'.$imag[0].'</center></td>';*/
		}
		$nombre=substr($proban[1],strrpos($proban[1],"/")+1);
		$rutaimg=$proban[1];
		$destino="../recursos/noticias/";
		$xmax=100;
		$ymax=100;
		$ext = explode(".", $nombre);
		$compara=$destino.$ext[0].".webp";
		if (file_exists($compara)) 
		{
			$nombre=$ext[0].".webp";
		}
		else
		{
			$nombre=$ext[0].".webp";
			$ext = $ext[count($ext)-1];  
			if($ext == "jpg" || $ext == "jpeg")
			{  
				$imagen = imagecreatefromjpeg($rutaimg);
			}  
			elseif($ext == "png")
			{
				$imagen = imagecreatefrompng($rutaimg); 
			}  
			elseif($ext == "gif") 
			{
				$imagen = imagecreatefromgif($rutaimg);
			} 
			if(is_array($imagen)) 
			{
				continue 1;
			}
			else
			{
				$x = imagesx($imagen);  
				$y = imagesy($imagen);
			}
			/*if($x <= $xmax && $y <= $ymax){
				echo "<center>Esta imagen ya esta optimizada para los maximos que deseas.<center>";
				return $imagen;  
			}

			if($x <= $y) {  
				$nuevax = $xmax;  
				$nuevay = $nuevax * $y / $x;  
			}  
			else {  
				$nuevay = $ymax;  
				$nuevax = $x / $y * $nuevay;  
			}  */
			$lienzo = imagecreatetruecolor(100, 100);
			imagecopyresampled($lienzo,$imagen,0,0,0,0,100, 100,$x,$y);
			imagewebp($lienzo,$destino.$nombre,100);
			imagedestroy($lienzo);
		}
		/* file_put_contents($destino, file_get_contents($proban[1]));	*/
		$salida='src="recursos/noticias/'.$nombre.'"';	
		$ima='<td><img alt="'.$title.'" style="height:100px; width:100px;"'.$salida.'></td>';
		if($fecha[0]=="Mon,")
		{$fecha[0]="Lunes, ";}
		if($fecha[0]=="Tue,")
		{$fecha[0]="Martes, ";}
		if($fecha[0]=="Wed,")
		{$fecha[0]="Miercoles, ";}
		if($fecha[0]=="Thu,")
		{$fecha[0]="Jueves, ";}
		if($fecha[0]=="Fri,")
		{$fecha[0]="Viernes, ";}
		if($fecha[0]=="Sat,")
		{$fecha[0]="Sábado, ";}
		if($fecha[0]=="Sun,")
		{$fecha[0]="Domingo, ";}
		if($fecha[2]=="Jan")
		{$fecha[2]="Ene";$mes="01";}
		if($fecha[2]=="Feb")
		{$fecha[2]="Feb";$mes="02";}
		if($fecha[2]=="Mar")
		{$fecha[2]="Mar";$mes="03";}
		if($fecha[2]=="Apr")
		{$fecha[2]="Abr";$mes="04";}
		if($fecha[2]=="May")
		{$fecha[2]="May";$mes="05";}
		if($fecha[2]=="Jun")
		{$fecha[2]="Jun";$mes="06";}
		if($fecha[2]=="Jul")
		{$fecha[2]="Jul";$mes="07";}
		if($fecha[2]=="Aug")
		{$fecha[2]="Ago";$mes="08";}
		if($fecha[2]=="Sep")
		{$fecha[2]="Sep";$mes="09";}
		if($fecha[2]=="Oct")
		{$fecha[2]="Oct";$mes="10";}
		if($fecha[2]=="Nov")
		{$fecha[2]="Nov";$mes="11";}
		if($fecha[2]=="Dec")
		{$fecha[2]="Dic";$mes="12";}		
		$fecha=$fecha[0]." ".$fecha[1]." ".$fecha[2]." ".$fecha[3]." ".$fecha[4]." ";
		if ($i <= 4) 
		{ // extrae solo 8 items
			 $noticias.='<a rel="noreferrer" href="'.$guid.'"target="_blank" style="text-decoration:none; background-color:rgba(0,0,0,0.00); color:black;">
			 <div class="conct" style="margin-bottom:2px;">
			 <div class="tit">'.$title.'</div>
			 <div class="fig">'.$ima.'</div>
			 <div class="art">'.$description.'</div>
			 <div class="cat">'.$category.'</div>
			 <div class="dat">'.$fecha.'</div>
			 </div>
			 </a>';
		}
		$i++;
	}
	$noticias.='<div class="logosomos"> 
			<a class="logoso" rel="noreferrer" target="_blank" href="https://somoskudasai.com/">
				<h3>Estas noticias son proporcionadas por</h3>
					<img class="tran" alt="logo SomosKudasai" src="recursos/iconos/kudasai.png">	
			</a> 
		</div>';
		return $noticias;
}	
		
  
   /* $imagen_optimizada = redimensionar_imagen('imagen.jpg','images/imagen.jpg',700,700);
    imagejpeg($imagen_optimizada, "images/imagen_optimizada.jpg");*/

	function eliminar_simbolos($string)
	{
		$string = trim($string);
	
		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);
	
		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);
	
		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);
	
		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);
	
		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);
	
		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);
		$string = str_replace(
			array("\\", "¨", "º", "-", "~",
				"#", "@", "|", "!", "\"",
				"·", "$", "%", "&", "/",
				"(", ")", "?", "'", "¡",
				"¿", "[", "^", "<code>", "]",
				"+", "}", "{", "¨", "´",
				">", "< ", ";", ",", ":",
				".", " "),
			' ',
			$string
		);
	return $string;
	} 	
	function editarminiaturas($volumen_id,$miniatura)
	{	
		$con= new bbdd;
		$conexion=$con->conect();
		$consulta="Update volumenes set volumenes.volumen_miniatura=? where volumenes.volumen_id=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ( "Algo ha ido mal en la consulta a la base de datos novel paso 1");
	    $params=mysqli_stmt_bind_param($ok,"si",$miniatura,$volumen_id);
        $ok2=mysqli_stmt_execute($ok);
	}
	
	
	
	function paginacion($typo,$filtro,$pagina){
		$pagin=1;
    $uno= '<table class="scale" style="margin:auto; width:auto; height:auto;">
			<tr>';
				$novel=new Novela();
				$pag=$novel->getpaginas($filtro,$typo);
				if($pag['paginas_totales']<1)
				{

				}
				else
				{
					$inicio=0;
					$ultima=$pag['paginas_totales'];
					if(!empty($pagina))
					{
						$inicio=intval($pagina)-2;
					}
					if($inicio < 1)
					{
						$inicio = 1;
					}
					if($ultima < 6)
					{

					}
					else
					{
						if($pagina>3)
						{
					 $uno.= '<td class="boton2">
					 	 <div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$pagin.')" class="paginet">
							1
						  </div>
					  </td>';
							
						}
					}
					$fin=$inicio+5;
					if($fin>$ultima)
					{
						$inicio=$ultima-4;
						$fin=$ultima+1;
					}
					if($inicio<1)
					{
						$inicio=1;
					}
					for($a=$inicio;$a<$fin;$a++)
					{

						if(!empty($pagina))
						{
							if($pagina==$a)
							{
								if($a>9)
								{
									$uno.= '<td class="boton2" style="background-color:rgba(160,237,98,0.30);">
									<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
								else
								{
									$uno.= '<td class="boton2" style="background-color:rgba(160,237,98,0.30);">
									<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
							}
							else
							{
								if($a>9)
								{
									$uno.= '<td class="boton2">
									<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
								else
								{
									$uno.= '<td class="boton2">
									<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
							}
						}
						else
						{
							if($a==1)
							{
								$uno.= '<td class="boton2" style="background-color:rgba(160,237,98,0.30);">
								<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
								'.$a.'
								</div>
								</td>'; 
							}
							else
							{
								if($a>9)
								{
									$uno.= '<td class="boton2">
									<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
								else
								{
									$uno.= '<td class="boton2">
									<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
							}
						}
						
					}
					if($fin<$ultima+1)
					{	

							if($ultima>9)
							{
								$uno.= '<td class="boton2">
								<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$ultima.')"  class="paginet">
								'.$ultima.'
								</div>
								</td>';
							}
							else
							{
								$uno.='<td class="boton2">
								<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$ultima.')"  class="paginet">
								'.$ultima.'
								</div>
								</td>';
							}		
					}
				}
		$uno.= '</tr>
		</table>';
		$dos= '<table class="scale" style="margin:auto; width:auto; height:auto;">
			<tr>';
				if($pag['paginas_totales']<1)
				{

				}
				else
				{
					$inicio=0;
					$ultima=$pag['paginas_totales'];
					if(!empty($pagina))
					{
						$inicio=intval($pagina)-2;
					}
					if($inicio < 1)
					{
						$inicio = 1;
					}
					if($ultima < 6)
					{

					}
					else
					{
						if($pagina>3)
						{
					 $dos.= '<td class="boton2">
					 	 <div onclick="cazargenero(`'.$filtro.'`,`'.$typo.'`,'.$pagin.')" class="paginet">
							1
						  </div>
					  </td>';
							
						}
					}
					$fin=$inicio+5;
					if($fin>$ultima)
					{
						$inicio=$ultima-4;
						$fin=$ultima+1;
					}
					if($inicio<1)
					{
						$inicio=1;
					}
					for($a=$inicio;$a<$fin;$a++)
					{

						if(!empty($pagina))
						{
							if($pagina==$a)
							{
								if($a>9)
								{
									$dos.= '<td class="boton2" style="background-color:rgba(160,237,98,0.30);">
									<div onclick="cazargenero(`'.$filtro.'`,`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
								else
								{
									$dos.= '<td class="boton2" style="background-color:rgba(160,237,98,0.30);">
									<div onclick="cazargenero(`'.$filtro.'`,`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
							}
							else
							{
								if($a>9)
								{
									$dos.= '<td class="boton2">
									<div onclick="cazargenero(`'.$filtro.'`,`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
								else
								{
									$dos.= '<td class="boton2">
									<div onclick="cazargenero(`'.$filtro.'`,`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
							}
						}
						else
						{
							if($a==1)
							{
								$dos.= '<td class="boton2" style="background-color:rgba(160,237,98,0.30);">
								<div onclick="cazargenero(`'.$filtro.'`,`'.$typo.'`,'.$a.')"  class="paginet">
								'.$a.'
								</div>
								</td>'; 
							}
							else
							{
								if($a>9)
								{
									$dos.= '<td class="boton2">
									<div onclick="cazargenero(`'.$filtro.'`,`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
								else
								{
									$dos.= '<td class="boton2">
									<div onclick="cazargenero(`'.$filtro.'`,`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
							}
						}
						
					}
					if($fin<$ultima+1)
					{	

							if($ultima>9)
							{
								$dos.= '<td class="boton2">
								<div onclick="cazargenero(`'.$filtro.'`,`'.$typo.'`,'.$ultima.')"  class="paginet">
								'.$ultima.'
								</div>
								</td>';
							}
							else
							{
								$dos.='<td class="boton2">
								<div onclick="cazargenero(`'.$filtro.'`,`'.$typo.'`,'.$ultima.')"  class="paginet">
								'.$ultima.'
								</div>
								</td>';
							}		
					}
				}
	$dos.= '</tr>
		</table>';
		if($typo=="busqueda")
		{
			$filtro=((string)$filtro);
			echo $dos;
		}
		if($typo=="genero")
		{
			$filtro=((int)$filtro);
			echo $uno;
		}
		if($typo != "busqueda" && $typo != "genero")
		{
			echo $uno;
		}
	}
	function pasarvolumen($novela_id)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$consulta="SELECT * from volumenes where volumenes.novela_id=? order by volumen_id asc";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"i",$novela_id);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$volumen_id,$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,$volumen_enlace_pdf,$volumen_enlace_video);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['volumen_id']=$volumen_id;
			$ras[$f]['novela_id']=$novela_id;
			$ras[$f]['volumen']=$volumen;
			$ras[$f]['volumen_caratula']=$volumen_caratula;
			$ras[$f]['volumen_miniatura']=$volumen_miniatura;
			$ras[$f]['volumen_fecha_publicacion']=$volumen_fecha_publicacion;
			$ras[$f]['volumen_fecha_original']=$volumen_fecha_original;
			$ras[$f]['volumen_enlace_pdf']=$volumen_enlace_pdf;
			$ras[$f]['volumen_enlace_video']=$volumen_enlace_video;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
}
class Comentarios
{
	function insert_comentarios($usuario_id,$novela_id,$volumen_id,$comentario,$respuesta_comentario_id)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$comentario= htmlspecialchars($comentario);
		$comentario=htmlspecialchars($comentario);
		$consulta="insert into comentarios(comentario_id,usuario_id,novela_id,volumen_id,comentario,respuesta_comentario_id,comentario_fecha) values (NULL,?,?,?,?,?,NOW())";
		$ok=mysqli_prepare($conexion,$consulta)or die( "Algo ha ido mal en la consulta a la base de datos");
		$params=mysqli_stmt_bind_param($ok,"iiisi",$usuario_id,$novela_id,$volumen_id,$comentario,$respuesta_comentario_id);
		$exe=mysqli_stmt_execute($ok);
		@mysqli_stmt_close($ok);
	}
	function delete_comentarios($usuario_id,$comentario_id)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$com=new Comentarios;
		$consulta="select comentario_id,novela_id,volumen_id from comentarios where comentarios.usuario_id=? and comentarios.comentario_id=? ";
		$ok=mysqli_prepare($conexion,$consulta) or die( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($ok,"ii",$usuario_id,$comentario_id);
		mysqli_stmt_bind_result($ok,$comentario_id,$novela_id,$volumen_id);
		mysqli_stmt_execute($ok);
		$i=0;
		$uno=1;
		$dos=2;
		$tres=3;
		$cuatro=4;
		$cinco=5;
		$seis=6;
		$siete=7;
		$ocho=8;
		$nueve=9;
		$diez=10;
		$b=0;
		while(mysqli_stmt_fetch($ok))
		{	
			$reg[$i]['comentario_id']=$comentario_id;
			$tru=$com->getrespuesta($novela_id,$volumen_id,$comentario_id);
			$reg[$i]['respuestas']="";
			if(!empty($tru))
			{
				for($z=0;$z<sizeof($tru);$z++)
				{
					$tri=$com->getrespuesta($novela_id,$volumen_id,$tru[$z]['comentario_id']);
					$reg[$i]['respuestas'].=$uno.",".$tru[$z]['comentario_id'].",";
					if(!empty($tri))
					{
						for($x=0;$x<sizeof($tri);$x++)
						{
							$tre=$com->getrespuesta($novela_id,$volumen_id,$tri[$x]['comentario_id']);
							$reg[$i]['respuestas'].=$dos.",".$tri[$x]['comentario_id'].",";
							if(!empty($tre))
							{
								for($h=0;$h<sizeof($tre);$h++)
								{
									$tro=$com->getrespuesta($novela_id,$volumen_id,$tre[$h]['comentario_id']);
									$reg[$i]['respuestas'].=$tres.",".$tre[$h]['comentario_id'].",";
									if(!empty($tro))
									{
										for($k=0;$k<sizeof($tro);$k++)
										{
											$tra=$com->getrespuesta($novela_id,$volumen_id,$tro[$k]['comentario_id']);
											$reg[$i]['respuestas'].=$cuatro.",".$tro[$k]['comentario_id'].",";
											if(!empty($tra))
											{
												for($j=0;$j<sizeof($tra);$j++)
												{
													$tru1=$com->getrespuesta($novela_id,$volumen_id,$tra[$j]['comentario_id']);
													$reg[$i]['respuestas'].= $cinco.",".$tra[$j]['comentario_id'].",";
													if(!empty($tru1))
													{
														for($v=0;$v<sizeof($tru1);$v++)
														{
															$tri1=$com->getrespuesta($novela_id,$volumen_id,$tru1[$v]['comentario_id']);
															$reg[$i]['respuestas'].=$seis.",".$tru1[$v]['comentario_id'].",";
															if(!empty($tri1))
															{
																for($o=0;$o<sizeof($tri1);$o++)
																{
																	$tre1=$com->getrespuesta($novela_id,$volumen_id,$tri1[$o]['comentario_id']);
																	$reg[$i]['respuestas'].=$siete.",".$tri1[$o]['comentario_id'].",";
																	if(!empty($tre1))
																	{
																		for($g=0;$g<sizeof($tre1);$g++)
																		{
																			$tro1=$com->getrespuesta($novela_id,$volumen_id,$tre1[$g]['comentario_id']);
																			$reg[$i]['respuestas'].=$ocho.",".$tre1[$g]['comentario_id'].",";
																			if(!empty($tro1))
																			{
																				for($k=0;$k<sizeof($tro1);$k++)
																				{
																					$tra1=$com->getrespuesta($novela_id,$volumen_id,$tro1[$k]['comentario_id']);
																					$reg[$i]['respuestas'].=$nueve.",".$tro1[$k]['comentario_id'].",";
																					if(!empty($tra1))
																					{	
																						for($s=0;$s<sizeof($tra1);$s++)
																						{	
																							$reg[$i]['respuestas'].= $diez.",".$tra1[$s]['comentario_id'].",";
																						}	
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}		
											}
										}
									}
								}
							}
						}
					}
				}
			}
			$resu=explode(",",$reg[$i]['respuestas']);
			if(!empty($resu))
			{
				$u=0;
				$p=1;
				$datos[$b]['comentario_id']=$reg[$i]['comentario_id'];
				$b=$b+1;
				for($c=0;$c<sizeof($resu);$c++)
				{	
					if($resu[$u]==null)
					{
						break;
					}
					$datos[$b]['margen']=$resu[$u];
					$datos[$b]['comentario_id']=$resu[$p];
					$u=$u+2;
					$p=$p+2;
					$b=$b+1;
				}
			}
			else
			{
				$datos[$b]['comentario_id']=$reg[$i]['comentario_id'];
				$b=$b+1;
			}
			$i++;
		}
		mysqli_stmt_free_result($ok);
		@mysqli_stmt_close($ok);
		for($i=0;$i<sizeof($datos);$i++)
		{
			$comen_id=$datos[$i]['comentario_id'];
			$consulta="delete from comentarios where comentarios.comentario_id=? and comentarios.usuario_id=?";
			$ok=mysqli_prepare($conexion,$consulta)or die( "Algo ha ido mal en la consulta a la base de datos");
			$params=mysqli_stmt_bind_param($ok,"ii",$comen_id,$usuario_id);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
		}
	}
	function update_comentarios($usuario_id,$comentario_id,$comentario)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$comentario=htmlspecialchars($comentario);
		$consulta="Update comentarios set comentario=? where comentarios.comentario_id=? and comentarios.usuario_id=?";
		$ok=mysqli_prepare($conexion,$consulta)or die( "Algo ha ido mal en la consulta a la base de datos");
		$params=mysqli_stmt_bind_param($ok,"sii",$comentario,$comentario_id,$usuario_id);
		$exe=mysqli_stmt_execute($ok);
		@mysqli_stmt_close($ok);
	}
	function getrespuesta($novela_id,$volumen_id,$comentario_id)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$consulta="select comentario_id from comentarios where comentarios.novela_id=? and comentarios.volumen_id=? and comentarios.respuesta_comentario_id=?   order by comentario_id asc";
		$ok=mysqli_prepare($conexion,$consulta)or die( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($ok,"iii",$novela_id,$volumen_id,$comentario_id);
		mysqli_stmt_bind_result($ok,$comentario_id);
		mysqli_stmt_execute($ok);
		mysqli_stmt_store_result($ok);
		$num=mysqli_stmt_num_rows($ok);
		if($num==0)
		{
			mysqli_stmt_free_result($ok);
			@mysqli_stmt_close($ok);
			return;
		}
		else
		{
			$i=0;
			while(mysqli_stmt_fetch($ok))
			{	
				$res[$i]['comentario_id']=$comentario_id;
				$i=$i+1;
			}
			mysqli_stmt_free_result($ok);
			@mysqli_stmt_close($ok);
			return $res;
		}
		
	}
	function get_comentarios($novela_id,$volumen_id)
	{

		$con= new bbdd;
        $conexion=$con->conect();
		$com=new Comentarios;
		$control=0;
		$consulta="select comentario_id from comentarios where comentarios.novela_id=? and comentarios.volumen_id=? and comentarios.respuesta_comentario_id=? order by comentario_id asc";
		$ok=mysqli_prepare($conexion,$consulta)or die( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($ok,"iii",$novela_id,$volumen_id,$control);
		mysqli_stmt_bind_result($ok,$comentario_id);
		mysqli_stmt_execute($ok);
		$i=0;
		$uno=1;
		$dos=2;
		$tres=3;
		$cuatro=4;
		$cinco=5;
		$seis=6;
		$siete=7;
		$ocho=8;
		$nueve=9;
		$diez=10;
		$b=0;
		while(mysqli_stmt_fetch($ok))
		{	
			$reg[$i]['comentario_id']=$comentario_id;
			$tru=$com->getrespuesta($novela_id,$volumen_id,$comentario_id);
			$reg[$i]['respuestas']="";
			if(!empty($tru))
			{
				for($z=0;$z<sizeof($tru);$z++)
				{
					$tri=$com->getrespuesta($novela_id,$volumen_id,$tru[$z]['comentario_id']);
					$reg[$i]['respuestas'].=$uno.",".$tru[$z]['comentario_id'].",";
					if(!empty($tri))
					{
						for($x=0;$x<sizeof($tri);$x++)
						{
							$tre=$com->getrespuesta($novela_id,$volumen_id,$tri[$x]['comentario_id']);
							$reg[$i]['respuestas'].=$dos.",".$tri[$x]['comentario_id'].",";
							if(!empty($tre))
							{
								for($h=0;$h<sizeof($tre);$h++)
								{
									$tro=$com->getrespuesta($novela_id,$volumen_id,$tre[$h]['comentario_id']);
									$reg[$i]['respuestas'].=$tres.",".$tre[$h]['comentario_id'].",";
									if(!empty($tro))
									{
										for($k=0;$k<sizeof($tro);$k++)
										{
											$tra=$com->getrespuesta($novela_id,$volumen_id,$tro[$k]['comentario_id']);
											$reg[$i]['respuestas'].=$cuatro.",".$tro[$k]['comentario_id'].",";
											if(!empty($tra))
											{
												for($j=0;$j<sizeof($tra);$j++)
												{
													$tru1=$com->getrespuesta($novela_id,$volumen_id,$tra[$j]['comentario_id']);
													$reg[$i]['respuestas'].= $cinco.",".$tra[$j]['comentario_id'].",";
													if(!empty($tru1))
													{
														for($v=0;$v<sizeof($tru1);$v++)
														{
															$tri1=$com->getrespuesta($novela_id,$volumen_id,$tru1[$v]['comentario_id']);
															$reg[$i]['respuestas'].=$seis.",".$tru1[$v]['comentario_id'].",";
															if(!empty($tri1))
															{
																for($o=0;$o<sizeof($tri1);$o++)
																{
																	$tre1=$com->getrespuesta($novela_id,$volumen_id,$tri1[$o]['comentario_id']);
																	$reg[$i]['respuestas'].=$siete.",".$tri1[$o]['comentario_id'].",";
																	if(!empty($tre1))
																	{
																		for($g=0;$g<sizeof($tre1);$g++)
																		{
																			$tro1=$com->getrespuesta($novela_id,$volumen_id,$tre1[$g]['comentario_id']);
																			$reg[$i]['respuestas'].=$ocho.",".$tre1[$g]['comentario_id'].",";
																			if(!empty($tro1))
																			{
																				for($k=0;$k<sizeof($tro1);$k++)
																				{
																					$tra1=$com->getrespuesta($novela_id,$volumen_id,$tro1[$k]['comentario_id']);
																					$reg[$i]['respuestas'].=$nueve.",".$tro1[$k]['comentario_id'].",";
																					if(!empty($tra1))
																					{	
																						for($s=0;$s<sizeof($tra1);$s++)
																						{	
																							$reg[$i]['respuestas'].= $diez.",".$tra1[$s]['comentario_id'].",";
																						}	
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}		
											}
										}
									}
								}
							}
						}
					}
				}
			}
			$resu=explode(",",$reg[$i]['respuestas']);
			if(!empty($resu))
			{
				$u=0;
				$p=1;
				$datos[$b]['comentario_id']=$reg[$i]['comentario_id'];
				$b=$b+1;
				for($c=0;$c<sizeof($resu);$c++)
				{	
					if($resu[$u]==null)
					{
						break;
					}
					$datos[$b]['margen']=$resu[$u];
					$datos[$b]['comentario_id']=$resu[$p];
					$u=$u+2;
					$p=$p+2;
					$b=$b+1;
				}
			}
			else
			{
				$datos[$b]['comentario_id']=$reg[$i]['comentario_id'];
				$b=$b+1;
			}
			
			$i++;
		}
		mysqli_stmt_free_result($ok);
		@mysqli_stmt_close($ok);
		for($i=0;$i<sizeof($datos);$i++)
		{
			$com_id=$datos[$i]['comentario_id'];
			$consulta="select * from comentarios where comentarios.novela_id=? and comentarios.volumen_id=? and comentarios.comentario_id=?";
			$ok=mysqli_prepare($conexion,$consulta)or die( "Algo ha ido mal en la consulta a la base de datos");
			$params=mysqli_stmt_bind_param($ok,"iii",$novela_id,$volumen_id,$com_id);
			$result=mysqli_stmt_bind_result($ok,$comentario_id,$usuario_id,$novela_id,$volumen_id,$comentario,$respuesta_comentario_id,$comentario_fecha);
			$exe=mysqli_stmt_execute($ok);
			mysqli_stmt_fetch($ok);
			$res[$i]['comentario_id']=$comentario_id;
			$res[$i]['usuario_id']=$usuario_id;
			$res[$i]['novela_id']=$novela_id;
			$res[$i]['volumen_id']=$volumen_id;
			$comentario=htmlspecialchars_decode($comentario);
			$comentario=stripslashes($comentario);
			$res[$i]['comentario']=$com->BBCode($comentario);
			$res[$i]['respuesta_comentario_id']=$respuesta_comentario_id;
			$res[$i]['comentario_fecha']=$comentario_fecha;
			if(!empty($datos[$i]['margen']))
			{
				$res[$i]['margen']=$datos[$i]['margen'];
			}
			else
			{
				$res[$i]['margen']=0;
			}
			mysqli_stmt_free_result($ok);
			@mysqli_stmt_close($ok);
			
			$consulta="SELECT usuario_nombre,usuario_avatar FROM usuarios WHERE usuario_id=?";
			$ok=mysqli_prepare($conexion,$consulta) or die("Algo ha ido mal en la consulta a la base de datos");
			mysqli_stmt_bind_param($ok,"i",$res[$i]['usuario_id']);
			mysqli_stmt_bind_result($ok,$usuario_nombre,$usuario_avatar);
			mysqli_stmt_execute($ok);
			mysqli_stmt_fetch($ok);
			$res[$i]['usuario_nick']=$usuario_nombre;
			$res[$i]['usuario_avatar']=$usuario_avatar;
			mysqli_stmt_free_result($ok);
			@mysqli_stmt_close($ok);
			$consult="SELECT like_id FROM likescomentarios WHERE comentario_id=?";
			$okk=mysqli_prepare($conexion,$consult) or die("Algo ha ido mal en la consulta a la base de datos");
			mysqli_stmt_bind_param($okk,"i",$res[$i]['comentario_id']);
			mysqli_stmt_execute($okk);
			mysqli_stmt_store_result($okk);
			$res[$i]['likes']=mysqli_stmt_num_rows($okk);
			mysqli_stmt_free_result($okk);
			@mysqli_stmt_close($okk);
			
		}
		return $res;
	}
	function get_comentariosbycomentarioid($comentario_id)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$com=new Comentarios;
		$consulta="select * from comentarios where comentarios.comentario_id=? ";
		$ok=mysqli_prepare($conexion,$consulta)or die( "Algo ha ido mal en la consulta a la base de datos");
		$params=mysqli_stmt_bind_param($ok,"i",$comentario_id);
		$result=mysqli_stmt_bind_result($ok,$comentario_id,$usuario_id,$novela_id,$volumen_id,$comentario,$respuesta_comentario_id,$comentario_fecha);
		$exe=mysqli_stmt_execute($ok);
		mysqli_stmt_fetch($ok);
		$res['comentario_id']=$comentario_id;
		$res['usuario_id']=$usuario_id;
		$res['novela_id']=$novela_id;
		$res['volumen_id']=$volumen_id;
		$comentario=htmlspecialchars_decode($comentario);
		$comentario=stripslashes($comentario);
		$res['comentario']=$comentario;
		$res['respuesta_comentario_id']=$respuesta_comentario_id;
		$res['comentario_fecha']=$comentario_fecha;
		@mysqli_stmt_close($ok);
		return $res;
	}
	function guardarlike($comentario_id,$usuario_id)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$consulta="select like_id from likescomentarios where likescomentarios.comentario_id=? and likescomentarios.usuario_id=?";
		$ok=mysqli_prepare($conexion,$consulta)or die( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($ok,"ii",$comentario_id,$usuario_id);
		mysqli_stmt_execute($ok);
		mysqli_stmt_store_result($ok);
		$num=mysqli_stmt_num_rows($ok);
		mysqli_stmt_free_result($ok);
		@mysqli_stmt_close($ok);
		if($num==0)
		{
			$consulta="insert into likescomentarios(like_id,comentario_id, usuario_id,like_fecha) values(NULL,?,?,NOW())";
			$ok=mysqli_prepare($conexion,$consulta)or die( "Algo ha ido mal en la consulta a la base de datos");
			$params=mysqli_stmt_bind_param($ok,"ii",$comentario_id,$usuario_id);
			$exe=mysqli_stmt_execute($ok);
			mysqli_stmt_free_result($ok);
			@mysqli_stmt_close($ok);
		}
		else
		{
			$consulta="delete from likescomentarios where likescomentarios.comentario_id=? and likescomentarios.usuario_id=?";
			$ok=mysqli_prepare($conexion,$consulta)or die( "Algo ha ido mal en la consulta a la base de datos");
			$params=mysqli_stmt_bind_param($ok,"ii",$comentario_id,$usuario_id);
			$exe=mysqli_stmt_execute($ok);
			mysqli_stmt_free_result($ok);
			@mysqli_stmt_close($ok);
		}
	}
	function BBCode($texto)
	{
		$marca=explode('[quote=',$texto);
		$num=sizeof($marca)-1;
		if(!empty($marca[1]))
		{
			for($i=1;$i<sizeof($marca);$i++)
			{
				if(!empty($marca[$i]))
				{
					$uno=explode('[quote=',$texto);
					$dos[$i]=explode(']',$uno[1]);
					$nombre[$i]=$dos[$i][0];
					$texto=str_replace('[quote='.$nombre[$i].']','[quote]',$texto);
					$nombre[$i]='<span>'.$nombre[$i].'</span>[/quote]';
				}
			}
		}
		for($x=$num;$x>0;$x--)
		{
			if($x==$num)
			{
				$texto=str_replace('[/quote]',$nombre[$x],$texto);
			}
			else
			{
				$z=$x+1;
				if($x==0)
				{
					$texto=implode($nombre[$x], explode($nombre[$z], $texto, 1));
				}
				else
				{
					$texto=implode($nombre[$x], explode($nombre[$z], $texto, $z));
				}
				

			}
		}

		$primero=explode('[link=',$texto);
		$nume=sizeof($primero);
		if(!empty($primero[1]))
		{
			for($h=1;$h<$nume;$h++)
			{
				if(!empty($primero[$h]))
				{
					$prim=explode('[link=',$texto);
					$segundo[$h]=explode(']',$prim[1]);
					$enlace[$h]=$segundo[$h][0];
					$texto=str_replace('[link='.$enlace[$h].']','<a href="'.$enlace[$h].'" target="_blank">',$texto);
					$texto=str_replace('[/link]','</a>',$texto);
				}
			}
			
		}
		$bb_code = array(
			// emoticonos: debéis apuntar a vuestras imágenes en el código HTML
			':)'  => '  <img height="25" width="25" src="recursos/iconos/feliz.webp" />  ',
			':('  => '  <img height="25" width="25" src="recursos/iconos/triste.webp" />  ',
			':D'  => '  <img height="25" width="25" src="recursos/iconos/contento.webp" />  ',
			';)'  => '  <img height="25" width="25" src="recursos/iconos/guino.webp" />  ',
			'T.T' => '  <img height="25" width="25" src="recursos/iconos/llorar.webp" />  ',
			'¬¬'  => '  <img height="25" width="25" src="recursos/iconos/desaprobacion.webp" />  ',
			']~[' => '  <img height="25" width="25" src="recursos/iconos/frustracion.webp" />  ',
			'zzz' => '  <img height="25" width="25" src="recursos/iconos/durmiendo.webp" />  ',
			'#$!&'=> '  <img height="25" width="25" src="recursos/iconos/insulto.webp" />  ',
			'x.x' => '  <img height="25" width="25" src="recursos/iconos/mareo.webp" />  ',
			'XD'  => '  <img height="25" width="25" src="recursos/iconos/XD.webp" />  ',
			'XP'  => '  <img height="25" width="25" src="recursos/iconos/XP.webp" />  ',
			'[3'  => '  <img height="25" width="25" src="recursos/iconos/corazon.webp" />  ',
			// letra negrita
			'[b]' => '<span style="font-weight:bold">',
			'[/b]' => '</span>',
			
			// letra cursiva
			'[i]' => '<span style="font-style:italic">',  
			'[/i]' => '</span>',
			
			// letra subrayada
			'[u]' => '<span style="text-decoration:underline">',
			'[/u]' => '</span>',
			
			//texto tachado
			'[t]'=>	'<span style="text-decoration:line-through;">',
			'[/t]'=>'</span>',
			
			// salto de línea
			'[space]' => ' <br>',
			
			// imagenes
			'[imagen]' => '<img src="',
			'[/imagen]' => '"/>',

			//cita
			'[quote]'=>'<blockquote class="blockquote">',
			'[/quote]'=> '</blockquote>',

			//spoiler
			'[spoiler]'=>'<div class="spoiler"><div class="spoiler-title">Spoiler</div><div class="spoiler-content">',
			'[/spoiler]'=>'</div></div>'
			);
			$search = array_keys($bb_code);
			$codigo = str_replace($search, $bb_code, $texto);
			return $codigo;
			
	}
	function BBCodepre($texto)
	{
		$marca=explode('[quote=',$texto);
		$num=sizeof($marca)-1;
		if(!empty($marca[1]))
		{
			for($i=1;$i<sizeof($marca);$i++)
			{
				if(!empty($marca[$i]))
				{
					$uno=explode('[quote=',$texto);
					$dos[$i]=explode(']',$uno[1]);
					$nombre[$i]=$dos[$i][0];
					$texto=str_replace('[quote='.$nombre[$i].']','[quote]',$texto);
					$nombre[$i]='<span>'.$nombre[$i].'</span>[/quote]';
				}
			}
		}
		for($x=$num;$x>0;$x--)
		{
			if($x==$num)
			{
				$texto=str_replace('[/quote]',$nombre[$x],$texto);
			}
			else
			{
				$z=$x+1;
				if($x==0)
				{
					$texto=implode($nombre[$x], explode($nombre[$z], $texto, 1));
				}
				else
				{
					$texto=implode($nombre[$x], explode($nombre[$z], $texto, $z));
				}
				

			}
		}

		$primero=explode('[link=',$texto);
		$nume=sizeof($primero);
		if(!empty($primero[1]))
		{
			for($h=1;$h<$nume;$h++)
			{
				if(!empty($primero[$h]))
				{
					$prim=explode('[link=',$texto);
					$segundo[$h]=explode(']',$prim[1]);
					$enlace[$h]=$segundo[$h][0];
					$texto=str_replace('[link='.$enlace[$h].']','<a href="'.$enlace[$h].'">',$texto);
					$texto=str_replace('[/link]','</a>',$texto);
				}
			}
			
		}
		$bb_code = array(
			// emoticonos: debéis apuntar a vuestras imágenes en el código HTML
			':)'  => '  <img height="25" width="25" src="recursos/iconos/feliz.webp" />  ',
			':('  => '  <img height="25" width="25" src="recursos/iconos/triste.webp" />  ',
			':D'  => '  <img height="25" width="25" src="recursos/iconos/contento.webp" />  ',
			';)'  => '  <img height="25" width="25" src="recursos/iconos/guino.webp" />  ',
			'T.T' => '  <img height="25" width="25" src="recursos/iconos/llorar.webp" />  ',
			'¬¬'  => '  <img height="25" width="25" src="recursos/iconos/desaprobacion.webp" />  ',
			']~[' => '  <img height="25" width="25" src="recursos/iconos/frustracion.webp" />  ',
			'zzz' => '  <img height="25" width="25" src="recursos/iconos/durmiendo.webp" />  ',
			'#$!&'=> '  <img height="25" width="25" src="recursos/iconos/insulto.webp" />  ',
			'x.x' => '  <img height="25" width="25" src="recursos/iconos/mareo.webp" />  ',
			'XD'  => '  <img height="25" width="25" src="recursos/iconos/XD.webp" />  ',
			'XP'  => '  <img height="25" width="25" src="recursos/iconos/XP.webp" />  ',
			'[3'  => '  <img height="25" width="25" src="recursos/iconos/corazon.webp" />  ',
			// letra negrita
			'[b]' => '<span style="font-weight:bold">',
			'[/b]' => '</span>',
			
			// letra cursiva
			'[i]' => '<span style="font-style:italic">',  
			'[/i]' => '</span>',
			
			// letra subrayada
			'[u]' => '<span style="text-decoration:underline">',
			'[/u]' => '</span>',
			
			//texto tachado
			'[t]'=>	'<span style="text-decoration:line-through;">',
			'[/t]'=>'</span>',
			
			// salto de línea
			'[space]' => ' <br>',
			
			// imagenes
			'[imagen]' => '<img src="',
			'[/imagen]' => '"/>',

			//cita
			'[quote]'=>'<blockquote class="blockquote">',
			'[/quote]'=> '</blockquote>',

			//spoiler
			'[spoiler]'=>'<div class="spoiler"><div class="spoiler-titl">Spoiler</div><div class="spoiler-conten">',
			'[/spoiler]'=>'</div></div>'
			);
			$search = array_keys($bb_code);
			$codigo = str_replace($search, $bb_code, $texto);
			return $codigo;
			
	}
}
class Usuarios{
    function validar_clave($clave)
    {
        if(strlen($clave) < 6){
           $error_clave = "La clave debe tener al menos 6 caracteres";
           return $error_clave;
        }
        if(strlen($clave) > 16){
           $error_clave = "La clave no puede tener más de 16 caracteres";
           return $error_clave;
        }
        if (!preg_match('`[a-z]`',$clave)){
           $error_clave = "La clave debe tener al menos una letra minúscula";
           return $error_clave;
        }
        if (!preg_match('`[A-Z]`',$clave)){
           $error_clave = "La clave debe tener al menos una letra mayúscula";
           return $error_clave;
        }
        if (!preg_match('`[0-9]`',$clave)){
           $error_clave = "La clave debe tener al menos un caracter numérico";
           return $error_clave;
        }
        $error_clave = "";
        return "ok";
    }
	function nickunico($nick)
	{
		$con= new bbdd;
        $conexion=$con->conect();
        $vali=new Usuarios;
        $consu="select usuario_nombre from usuarios where usuarios.usuario_nombre=?";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($ok,"s",$nick);
        mysqli_stmt_bind_result($ok,$usuario_nombre);
		mysqli_stmt_execute($ok);
        mysqli_stmt_fetch($ok);
		if(!empty($usuario_nombre))
        {
            $ret['estado']="no";
            $ret['titulo']="Error de registro";
            $ret['info']="Este Nick: ".$nick." ya esta en uso.";
			@mysqli_stmt_close($ok);
            return $ret;
        }
		else
		{
			$ret['estado']="ok";
            $ret['titulo']="Nick disponible";
            $ret['info']="Este Nick: ".$nick." esta disponible.";
			@mysqli_stmt_close($ok);
            return $ret;
		}
        
	}
    function registro($nombre,$email,$email2,$fecha,$password,$password2)
    {
        $con= new bbdd;
        $conexion=$con->conect();
        $vali=new Usuarios;
        $consu="select usuario_email from usuarios where usuarios.usuario_email=?";
        $okk=mysqli_prepare($conexion,$consu) or die ( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($okk,"s",$email);
		mysqli_stmt_bind_result($okk,$usuario_email);
		mysqli_stmt_execute($okk);
        mysqli_stmt_fetch($okk);
		if(!empty($usuario_email))
        {
            $ret['estado']="no";
            $ret['titulo']="Error de registro";
            $ret['info']="Este email: ".$email." ya tiene una cuenta registrada.";
            return $ret;
        }
        @mysqli_stmt_close($okk);
		$consu="select usuario_nombre from usuarios where usuarios.usuario_nombre=?";
        $okk=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($okk,"s",$nombre);
        mysqli_stmt_bind_result($okk,$usuario_nombre);
		mysqli_stmt_execute($okk);
        mysqli_stmt_fetch($okk);
		if(!empty($usuario_nombre))
        {
			$ret['estado']="no";
            $ret['titulo']="Error de registro";
            $ret['info']="Este Nick: ".$nombre." ya esta en uso.";
            return $ret;
		}
        if(empty($nombre) or empty($email) or empty($email2) or empty($fecha) or empty($password) or empty($password2))
        {
            $ret['estado']="no";
            $ret['titulo']="Error de registro";
            $ret['info']="No rellenaste alguno de los campos , intentalo de nuevo.";
            return $ret;
        }
        if($email!=$email2)
        {
            $ret['estado']="no";
            $ret['titulo']="Error de registro";
            $ret['info']="El email: ".$email." No coincie con la confirmación de email: ".$email2;
            return $ret;
        }
        if($password!=$password2)
        {
            $ret['estado']="no";
            $ret['titulo']="Error de registro";
            $ret['info']="La contaseña no coincide con la confirmación de contraseña.";
            return $ret;
        }
        else
        {
            $valida=$vali->validar_clave($password);
            if($valida=="ok")
            {
                $pass=password_hash($password,PASSWORD_DEFAULT);
                $password=$pass;
            }
            else
            {
                $ret['estado']="no";
                $ret['titulo']="Error de registro";
                $ret['info']=$valida;
                return $ret;
            }
        }
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
        {
           
            $consulta="insert into usuarios(usuario_id,usuario_nombre,usuario_fecha_nacimiento,usuario_email,usuario_password)
                       values(NULL,?,?,?,?)";
            $ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos");
            $params=mysqli_stmt_bind_param($ok,"ssss",$nombre,$fecha,$email,$password);
            $exe=mysqli_stmt_execute($ok);
            @mysqli_stmt_close($ok);
            $ret['estado']="ok";
            $ret['titulo']="Formulario de registro";
            $ret['info']="Los datos se guardaron correctamente en la base de datos.";
            return $ret;
        } 
        else 
        {
            $ret['estado']="no";
            $ret['titulo']="Error de registro";
            $ret['info']= $email." No es un email valido";
            return $ret;
        }
        
    }
    function login($email,$password)
    {
        $con= new bbdd;
        $conexion=$con->conect();
        $consult="select usuario_email,
        usuario_password from usuarios where usuarios.usuario_email=?";
        $okk=mysqli_prepare($conexion,$consult);
	    $okk1=mysqli_stmt_bind_param($okk,"s",$email);
        $okk2=mysqli_stmt_execute($okk);
        $okk3=mysqli_stmt_bind_result($okk,$usuario_email,$usuario_password);
        mysqli_stmt_fetch($okk);
        if(password_verify($password,$usuario_password)==1) 
        {
            @mysqli_stmt_close($okk);
            $consulta="select usuario_id,usuario_nombre,usuario_avatar,usuario_fecha_nacimiento,usuario_email,
            usuario_password from usuarios where usuarios.usuario_email=?";
            $ok=mysqli_prepare($conexion,$consulta);
            $ok1=mysqli_stmt_bind_param($ok,"s",$email);
            $ok2=mysqli_stmt_execute($ok);
            $ok3=mysqli_stmt_bind_result($ok,$usuario_id,$usuario_nombre,$usuario_avatar,
            $usuario_fecha_nacimiento,$usuario_email,$usuario_password);
            mysqli_stmt_fetch($ok);
            @mysqli_stmt_close($ok);
            if(password_verify($password,$usuario_password)==1) 
            {          
                $ret['usuario_id']=$usuario_id;
                $ret['nombre']=$usuario_nombre;
                $ret['avatar']=$usuario_avatar;
                $ret['fecha']=$usuario_fecha_nacimiento;
                $ret['email']=$usuario_email;
                $ret['estado']="ok";
                $ret['titulo']="Login";
                $ret['info']="Estas logeado correctamente"; 
                return $ret;  
            }
        } 
        else
        {
            $ret['estado']="no";
            $ret['titulo']="Error de Login";
            $ret['info']="El email o la contraseña no son válidas";
            return $ret;
        } 
    }
    function generate_string($input, $strength = 16) 
    {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) 
        {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }
    function recpas($email,$email2){
        $con= new bbdd;
        $conexion=$con->conect();
        if($email!=$email2)
        {
            $ret['estado']="no";
            $ret['titulo']="Error confirmación del Email";
            $ret['info']="El email: ".$email." No coincie con la confirmación de email: ".$email2;
            return $ret;
        }
        else
        {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
            {
                $consult="select * from usuarios where usuarios.usuario_email=?";
                $okk=mysqli_prepare($conexion,$consult);
                $okk1=mysqli_stmt_bind_param($okk,"s",$email);
                $okk2=mysqli_stmt_execute($okk);
                $okk3=mysqli_stmt_bind_result($okk,$usuario_id,$usuario_nombre,$usuario_apellidos,
                $usuario_fecha_nacimiento,$usuario_email,$usuario_password,$usuario_publicidad);
                mysqli_stmt_fetch($okk);
                @mysqli_stmt_close($okk);
                if(!empty($usuario_email))
                {
                    $consult="DELETE FROM recpas WHERE recpas.usuario_id=?";
                    $ik=mysqli_prepare($conexion,$consult) or die ("Algo ha ido mal en la consulta a la base de datos");
                    $param=mysqli_stmt_bind_param($ik,"i",$usuario_id);
                    $ex=mysqli_stmt_execute($ik);
		            @mysqli_stmt_close($ik);
                    $tok=new Usuarios;
                    $permitted_chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $token=$tok->generate_string($permitted_chars, 16);
                    $consulta="insert into recpas(recpas_id,usuario_id,token,recpas_fecha) values(NULL,?,?,NOW())";
                    $ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos");
                    $params=mysqli_stmt_bind_param($ok,"is",$usuario_id,$token);
                    $exe=mysqli_stmt_execute($ok);
		            @mysqli_stmt_close($ok);
                    $ret['estado']="ok";
                    $ret['titulo']="Confirmación del Email";
                    $ret['info']="Se envio un correo a ".$usuario_email." con un código de verificación para que puedas cambiar tu contraseña";
                    $ret['email']=$usuario_email;
                    $ret['token']=$token;
                    return $ret;
                }
                else
                {
                    $ret['estado']="no";
                    $ret['titulo']="Error confirmación del Email";
                    $ret['info']="No existe ninguna cuenta registrada con el email ".$email;
                    @mysqli_stmt_close($okk);
                    return $ret;
                }
            }
            else 
            {
                $ret['estado']="no";
                $ret['titulo']="Error confirmación del Email";
                $ret['info']=$email." No es un email valido";
                return $ret;
            }
            
        }
    }
    function nuecon($password,$password2,$tok)
    {
        $con= new bbdd;
        $conexion=$con->conect();
        $vali=new Usuarios;
        $valida=$vali->validar_clave($password);
        if($password!=$password2)
        {
            $ret['estado']="no";
            $ret['titulo']="Error nueva contraseña";
            $ret['info']="La contraseña no coincide con la confirmación de contraeña";
            return $ret;
        }
        else
        {   
            $vali=new Usuarios;
            $valida=$vali->validar_clave($password);
            if($valida=="ok")
            {
                $pass=password_hash($password,PASSWORD_DEFAULT);
                $password=$pass;
            }
            else
            {
                $ret['token']=$tok;
                $ret['estado']="no";
                $ret['titulo']="Error nueva contraseña";
                $ret['info']=$valida;
                return $ret;
            }
        }
        $consult="select usuario_id,
        token,recpas_fecha from recpas where recpas.token=?";
        $okk=mysqli_prepare($conexion,$consult) or die ("Algo ha ido mal en la consulta a la base de datos 0");
	    $okk1=mysqli_stmt_bind_param($okk,"s",$tok);
        $okk2=mysqli_stmt_execute($okk);
        $okk3=mysqli_stmt_bind_result($okk,$usuario_id,$token,$recpas_fecha);
        mysqli_stmt_fetch($okk);
        if(empty($usuario_id) || empty($recpas_fecha) || empty($token))
        {   
            $ret['token']=$token;
            $ret['estado']="no";
            $ret['titulo']="Error nueva contraseña";
            $ret['info']="Ocurrio un error durante el proceso de cambio de contraseña";
            @mysqli_stmt_close($okk);
            return $ret;
        }
        @mysqli_stmt_close($okk);
        date_default_timezone_set('Europe/Madrid');
        $fecha_actual = getdate();
        $dia=$fecha_actual['mday'];
        $mes=$fecha_actual['mon'];
        $ano=$fecha_actual['year'];
        $hora=$fecha_actual['hours']-1;
        $minutos=$fecha_actual['minutes'];
        $segundos=$fecha_actual['seconds'];
        $mes=sprintf("%02d", $mes);
        $dia=sprintf("%02d", $dia);
        $hora=sprintf("%02d", $hora);
        $minutos=sprintf("%02d", $minutos);
        $segundos=sprintf("%02d", $segundos); 
        $refecha=$ano."-".$mes."-".$dia." ".$hora.":".$minutos.":".$segundos;
        if($recpas_fecha<$refecha) 
        {   
            $consul="DELETE FROM recpas WHERE token=?";
            $okkk=mysqli_prepare($conexion,$consul) or die ("Algo ha ido mal en la consulta a la base de datos 1");
            $okkk1=mysqli_stmt_bind_param($okkk,"s",$token);
            $okkk2=mysqli_stmt_execute($okkk);
            $res['estado']="no";
            $res['titulo']="Error nueva contraseña";
            $res['info']="Tiempo para esta opción excedido, recuerda que tienes 1 hora desde que se envia
            el email de recuperación hasta que este caduque";
            $res['fecha1']=$refecha;
            $res['fecha']=$recpas_fecha;
            $res['token']=$token;
            $res['usuario_id']=$usuario_id;
            $res['password']=$password;
            @mysqli_stmt_close($okkk);
            return $res;
        }
        else
        {
            $consulta="UPDATE usuarios SET usuario_password=? WHERE usuario_id=?";
            $ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos 2");
            $ok1=mysqli_stmt_bind_param($ok,"si",$password,$usuario_id);
            $ok2=mysqli_stmt_execute($ok);
            @mysqli_stmt_close($ok);
            $consu="DELETE FROM recpas WHERE token=?";
            $okkkk=mysqli_prepare($conexion,$consu) or die ("Algo ha ido mal en la consulta a la base de datos 3");
            $okkkk1=mysqli_stmt_bind_param($okkkk,"s",$token);
            $okkkk2=mysqli_stmt_execute($okkkk);
            $res['fecha1']=$refecha;
            $res['fecha']=$recpas_fecha;
            $res['token']=$token;
            $res['usuario_id']=$usuario_id;
            $res['password']=$password;
            $res['estado']="ok";
            $res['titulo']="Nueva contraseña";
            $res['info']="Nueva contraseña guardada correctamente";
            @mysqli_stmt_close($okkkk);
            return $res;
        }
    }
    function eliminar_simbolos($string){
 
        $string = trim($string);
     
        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );
     
        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );
     
        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );
     
        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );
     
        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );
     
        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );
     
        $string = str_replace(
            array("\\", "¨", "º", "-", "~",
                 "#", "@", "|", "!", "\"",
                 "·", "$", "%", "&", "/",
                 "(", ")", "?", "'", "¡",
                 "¿", "[", "^", "<code>", "]",
                 "+", "}", "{", "¨", "´",
                 ">", "< ", ";", ",", ":",
                 ".", " "),
            ' ',
            $string
        );
    return $string;
    } 
    function formatearf($fecha)
	{
		$primero=explode("-",$fecha);
		$year=$primero[0];
		$mes=$primero[1];
		$dia=$primero[2];
		$seg=explode(" ",$primero[2]);
		$dia=$seg[0];
		$hora=$seg[1];
		if($mes=="01")
		{
			$mes="Enero";
		}
		if($mes=="02")
		{
			$mes="Febrero";
		}
		if($mes=="03")
		{
			$mes="Marzo";
		}
		if($mes=="04")
		{
			$mes="Abril";
		}
		if($mes=="05")
		{
			$mes="Mayo";
		}
		if($mes=="06")
		{
			$mes="Junio";
		}
		if($mes=="07")
		{
			$mes="Julio";
		}
		if($mes=="08")
		{
			$mes="Agosto";
		}
		if($mes=="09")
		{
			$mes="Septiembre";
		}
		else if($mes=="10")
		{
			$mes="Octubre";
		}
		else if($mes=="11")
		{
			$mes="Noviembre";
		}
		if($mes=="12")
		{
			$mes="Diciembre";
		}
		$final=$dia." de ".$mes." del ".$year." a las ".$hora; 
	return $final;
	}
	function guardarvideo($novela_id,$volumen_id,$usuario_id,$indice,$tiempo,$duracion){
		$con= new bbdd;
        $conexion=$con->conect();
		$consult="select video_id from videos where videos.volumen_id=? and videos.usuario_id=? and videos.indice=?";
		$okk=mysqli_prepare($conexion,$consult);
		mysqli_stmt_bind_param($okk,"iii",$volumen_id,$usuario_id,$indice);
		mysqli_stmt_bind_result($okk,$video_id);
		mysqli_stmt_execute($okk);
		mysqli_stmt_fetch($okk);
		if(!empty($video_id))
		{
			mysqli_stmt_close($okk);
			$consulta="UPDATE videos SET novela_id=?,volumen_id=?,usuario_id=?,indice=?,tiempo=?,duracion=? WHERE volumen_id=? AND usuario_id=? AND indice=?";
			$ok=mysqli_prepare($conexion,$consulta);
			mysqli_stmt_bind_param($ok,"iiiiiiiii",$novela_id,$volumen_id,$usuario_id,$indice,$tiempo,$duracion,$volumen_id,$usuario_id,$indice);
			mysqli_stmt_execute($ok);
			mysqli_stmt_close($ok);
		}
		else
		{
			mysqli_stmt_close($okk);
			$consulta="insert into videos(video_id,novela_id,volumen_id,usuario_id,indice,tiempo,duracion) values (NULL,?,?,?,?,?,?)";
			$ok=mysqli_prepare($conexion,$consulta);
			mysqli_stmt_bind_param($ok,"iiiiii",$novela_id,$volumen_id,$usuario_id,$indice,$tiempo,$duracion);
			mysqli_stmt_execute($ok);
			mysqli_stmt_close($ok);
		}
	}
	function getstart($volumen_id,$usuario_id,$indice)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$consult="select * from videos where videos.volumen_id=? and videos.usuario_id=? and videos.indice=?";
		$okk=mysqli_prepare($conexion,$consult);
		mysqli_stmt_bind_param($okk,"iii",$volumen_id,$usuario_id,$indice);
		mysqli_stmt_bind_result($okk,$video_id,$novela_id,$volumen_id,$usuario_id,$indice,$tiempo,$duracion);
		mysqli_stmt_execute($okk);
		mysqli_stmt_fetch($okk);
		$res['video_id']=$video_id ;
		$res['novela_id']=$novela_id ;
		$res['volumen_id']=$volumen_id ;
		$res['usuario_id']=$usuario_id ;
		$res['indice']=$indice ;
		$res['tiempo']=$tiempo ;
		$res['duracion']=$duracion ;
		return $res;
	}
	function guardarvisualizacion($novela_id,$volumen_id,$indice,$usuario_id){
		$con= new bbdd;
        $conexion=$con->conect();
		$consult="select visualizacion_id from visualizaciones where volumen_id=? and usuario_id=? and indice=?";
		$okk=mysqli_prepare($conexion,$consult);
		mysqli_stmt_bind_param($okk,"iii",$volumen_id,$usuario_id,$indice);
		mysqli_stmt_bind_result($okk,$visualizacion_id);
		mysqli_stmt_execute($okk);
		mysqli_stmt_fetch($okk);
		if(empty($visualizacion_id))
		{
			mysqli_stmt_close($okk);
			$consulta="insert into visualizaciones(visualizacion_id,novela_id,volumen_id,indice,usuario_id,fecha_visualizacion) values (NULL,?,?,?,?,NOW())";
			$ok=mysqli_prepare($conexion,$consulta);
			mysqli_stmt_bind_param($ok,"iiii",$novela_id,$volumen_id,$indice,$usuario_id);
			mysqli_stmt_execute($ok);
			mysqli_stmt_close($ok);
		}
	}
	function getvisualizaciones($novela_id,$volumen_id,$indice,$usuario_id){
		$con= new bbdd;
		$usu=new Usuarios;
        $conexion=$con->conect();
		$consult="select * from visualizaciones where novela_id=? and volumen_id=? and indice=? and usuario_id=? ";
		$okk=mysqli_prepare($conexion,$consult);
		mysqli_stmt_bind_param($okk,"iiii",$novela_id,$volumen_id,$indice,$usuario_id);
		mysqli_stmt_bind_result($okk,$visualizacion_id,$novela_id,$volumen_id,$indice,$usuario_id,$fecha_visualizacion);
		mysqli_stmt_execute($okk);
		mysqli_stmt_fetch($okk);
		$res['visualizacion_id']=$visualizacion_id;
		$res['novela_id']=$novela_id;
		$res['volumen_id']=$volumen_id;
		$res['indice']=$indice;
		$res['usuario_id']=$usuario_id;
		$res['fecha_visualizacion']=$usu->formatearf($fecha_visualizacion);
		return $res;
	}
	function getAvatarByUsuarioId($usuario_id)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$consult="select usuario_avatar from usuarios where usuario_id=?";
		$okk=mysqli_prepare($conexion,$consult);
		mysqli_stmt_bind_param($okk,"i",$usuario_id);
		mysqli_stmt_bind_result($okk,$usuario_avatar);
		mysqli_stmt_execute($okk);
		mysqli_stmt_fetch($okk);
		return $usuario_avatar;
	}
}