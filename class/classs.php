<?php
// The base class for all db classes


// Class for MySQL, which extends base class
class bbdd {
	function conect(){
		$servidor ="localhost";
		$usuario ="root";
		$pass ="putif3ria";
		$bd ="novelas";
		// creación de la conexión a la base de datos con mysql_connect()
		$conexion =mysqli_connect( $servidor, $usuario, $pass, $bd ) or die ("No se ha podido conectar al servidor de Base de datos");
		// Selección del a base de datos a utilizar
		return $conexion;
	}
	function conecta(){
		$servidor ="localhost";
		$usuario ="root";
		$pass ="putif3ria";
		$bd ="animes";
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
						  novela_fecha_publicacion from novelas order by novela_nombre asc";
        $ok=mysqli_prepare($conexion,$consulta);
		$ok1=mysqli_stmt_execute($ok);
		$ok2=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion);
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
								  novela_fecha_publicacion  from novelas order by novelas.novela_nombre asc limit ".$limite."";
			$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos primera");
		}
		else
		{
			if($typo=="primera_letra")
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
				$filtro=$filtro."%";
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
								  novela_fecha_publicacion  from novelas where novelas.novela_nombre LIKE ? order by novelas.novela_nombre asc limit ".$limite."";
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
								  novela_fecha_publicacion from novelas where novelas.novela_generos LIKE '%".$filtro."%' order by novelas.novela_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos tercera");
				$ok1=mysqli_stmt_execute($res);
				$ok2=mysqli_stmt_bind_result($res,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion);
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
							 novela_fecha_publicacion from novelas where novelas.fansub_id=? order by novelas.novela_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
		}
        $ok1=mysqli_stmt_execute($res);
		$ok2=mysqli_stmt_bind_result($res,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion);
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
			$ras[$v]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$v=$v+1;
		}
	@mysqli_stmt_close($res);
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
			$pre="SELECT * from novelas";
			$res=mysqli_query($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
        	$num=mysqli_num_rows($res);
		}
		else
		{
			if($typo=="primera_letra")
			{
				$filtro=$filtro."%";
				$pre="SELECT * from novelas where novelas.novela_nombre LIKE ?";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"s",$filtro);
				$ok1=mysqli_stmt_execute($res);
        		$num=mysqli_stmt_num_rows($res);
				@mysqli_stmt_close($res);
			}
			if($typo=="genero")
			{
				$pre="SELECT * from novelas where novelas.novela_generos LIKE '%".$filtro."%'";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok1=mysqli_stmt_execute($res);
				$ok2=mysqli_stmt_bind_result($res,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
											 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion);
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
								$ras[$v]['novela_fecha_publicacion']=$novela_fecha_publicacion;
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
			if($typo=="escritor")
			{
				$pre="SELECT * from novelas where novelas.escritor_id=?";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
				$ok1=mysqli_stmt_execute($res);
				$num=mysqli_stmt_num_rows($res);
				@mysqli_stmt_close($res);
			}
			if($typo=="ilustrador")
			{
				$pre="SELECT * from novelas where novelas.ilustrador_id=?";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
				$ok1=mysqli_stmt_execute($res);
				$num=mysqli_stmt_num_rows($res);
				@mysqli_stmt_close($res);
			}
			if($typo=="editorial")
			{
				$pre="SELECT * from novelas where novelas.editorial_id=?";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
				$ok1=mysqli_stmt_execute($res);
				$num=mysqli_stmt_num_rows($res);
				@mysqli_stmt_close($res);
			}
			if($typo=="fansub")
			{
				$pre="SELECT * from novelas where novelas.fansub_id=?";
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
									 $novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion,$dt_id,$novela_id,$dt_numero);
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
		
      	$consulta="SELECT * from novelas,dt where novelas.novela_id=dt.novela_id order by dt_numero desc limit 0,11";
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
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion);
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
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion);
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
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion,$escritor_id,$escritor_nombre,$ilustrador_id,
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
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion,$escritor_id,$escritor_nombre,$ilustrador_id,
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
        $ok3=mysqli_stmt_bind_result($ok,$volumen_id,$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,$volumen_enlace);
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
			$ras[$f]['volumen_enlace']=$volumen_enlace;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
    }
	
	function guardarvolumenes($novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_original,$volumen_enlace)
	{
		$con= new bbdd;
        $conexion=$con->conect();
        $consulta="insert into volumenes(volumen_id,novela_id,volumen,volumen_caratula,volumen_miniatura,volumen_fecha_publicacion,volumen_fecha_original,volumen_enlace)
				   values(NULL,?,?,?,?,NOW(),?,?)";
		$ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos novel paso 1");
		$params=mysqli_stmt_bind_param($ok,"isssss",$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_original,$volumen_enlace);
        $exe=mysqli_stmt_execute($ok);
		@mysqli_stmt_close($ok);
	}
	
	function editarvolumenes($volumen_id,$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,$volumen_enlace)
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
		$reg['$volumen_enlace']=$volumen_enlace;
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
									   $reg['$volumen_enlace'],
									   $reg['volumen_id']);
        $exe=mysqli_stmt_execute($ok);
		@mysqli_stmt_close($ok);
	}
	
	function guardarnovela($escritor_nombre,$ilustrador_nombre,$editorial_nombre,$editorial_enlace,$fansub_nombre,
						   $fansub_enlace,$novela_nombre,$novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura)
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
		}		
		@mysqli_stmt_close($ok);
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
									   novela_fecha_publicacion)
				   values(NULL,?,?,?,?,?,?,?,?,?,?,NOW())";
        $ok=mysqli_prepare($conexion,$consulta) or die ( "Algo ha ido mal en la consulta a la base de datos novel paso 1");
	    $ok1=mysqli_stmt_bind_param($ok,"iiiissssss",$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura);
        $ok2=mysqli_stmt_execute($ok);
        $consulta2="SELECT * from novelas
		where novelas.novela_nombre=?
		and novelas.novela_caratula=?";
		$ok3=mysqli_prepare($conexion,$consulta2) or die ("Algo ha ido mal en la consulta a la base de datos novel paso 2");
		$ok4=mysqli_stmt_bind_param($ok3,"ss",$novela_nombre,$novela_caratula);
		$ok6=mysqli_stmt_bind_result($ok3,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion); 
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
			$ras[$f]['novela_miniatura']=$novela_miniatura;
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
				   <tr><td> novela_fecha_publicacion </td><td>".$novela_fecha_publicacion."</td></tr></table>";
    /*return $ras;*/
		echo $error;
    }
	
	
	function editar_novela($novela_id,$escritor_nombre,$ilustrador_nombre,$editorial_nombre,$editorial_enlace,$fansub_nombre,
						   $fansub_enlace,$novela_nombre,$novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura)
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
		return $reg;
		
		$consulta="SELECT * from editoriales 
							where editoriales.editorial_nombre=?";
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
				   novela_fecha_publicacion='NOW()',
				   novela_enlace_descarga=?
				   WHERE novelas.novela_id=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ( "Algo ha ido mal en la consulta a la base de datos novel paso 1");
	    $params=mysqli_stmt_bind_param($ok,
									   "iiiiisssssi",
									   $reg['novela_id'],
									   $reg['escritor_nombre'],
									   $reg['ilustrador_nombre'],
									   $reg['editorial_nombre'],
									   $reg['editorial_enlace'],
									   $reg['fansub_nombre'],
									   $reg['fansub_enlace'],
									   $reg['novela_nombre'],
									   $reg['novela_nombre_original'],
									   $reg['novela_generos'],
									   $reg['novela_sinopsis'],
									   $reg['novela_caratula'],
									   $reg['novela_miniatura'],
									   $reg['novela_id']);
        $ok2=mysqli_stmt_execute($ok);
        $consulta="SELECT * from novelas
		where novelas.novela_nombre=?
		and novelas.novela_caratula=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos novel paso 2");
		$params=mysqli_stmt_bind_param($ok,"ss",$reg['novela_nombre'],$reg['novela_caratula']);
		$resultado=mysqli_stmt_bind_result($ok,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,
									 $novela_nombre_original,$novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion); 
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
			$ras[$f]['novela_miniatura']=$novela_miniatura;
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
				   <tr><td> novela_fecha_publicacion </td><td>".$novela_fecha_publicacion."</td></tr></table>";
    return $error;
    }
	
	
	function borrarnovela($novela_id)
	{
			$con= new bbdd;
			$conexion=$con->conect();
			$consulta="delete from novelas, 
				   novela_id,
				   novela_nombre,
				   novela_nombre_original,
				   novela_volumen,
				   novela_generos,
				   novela_sinopsis,
				   novela_escritor,
				   novela_ilustrador,
				   novela_editor,
				   novela_caratula,
				   novela_miniatura,
				   novela_fecha_original,
				   novela_fecha_publicacion,
				   novela_traductor_ji,
				   novela_traductor_ie,
				   novela_fansub,
				   novela_enlace_fansub,
				   novela_enlace_descarga
				   WHERE novelas.novela_id".$novela_id."";
			$resultado=mysqli_query($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");
		}
	
	
	
	function getvolumenes()
	{
		$con= new bbdd;
		$conexion=$con->conect();
		$consulta="SELECT * FROM volumenes";
		$ok=mysqli_prepare($conexion,$consulta);
        $resultado=mysqli_stmt_bind_result($ok,$volumen_id,$novela_id,$volumen,$volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,$volumen_enlace);
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
			$ras[$f]['volumen_enlace']=$volumen_enlace;
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
									 $novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion,$volumen_id,$volumen,
									 $volumen_caratula,$volumen_miniatura,$volumen_fecha_publicacion,$volumen_fecha_original,$volumen_enlace);
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
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$ras[$f]['volumen_id']=$volumen_id;
			$ras[$f]['volumen']=$volumen;
			$ras[$f]['volumen_caratula']=$volumen_caratula;
			$ras[$f]['volumen_miniatura']=$volumen_miniatura;
			$ras[$f]['volumen_fecha_publicacion']=$volumen_fecha_publicacion;
			$ras[$f]['volumen_fecha_original']=$volumen_fecha_original;
			$ras[$f]['volumen_enlace']=$volumen_enlace;
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
									 $volumen_enlace,$novela_id,$escritor_id,$ilustrador_id,$editorial_id,$fansub_id,$novela_nombre,$novela_nombre_original,
									 $novela_generos,$novela_sinopsis,$novela_caratula,$novela_miniatura,$novela_fecha_publicacion);
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
			$ras[$f]['volumen_enlace']=$volumen_enlace;
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
			$ras[$f]['novela_fecha_publicacion']=$novela_fecha_publicacion;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	
	
	function getultimosvolumenes2()
	{
		$con= new bbdd;
		$conexion=$con->conect();
		$consulta="SELECT * FROM volumenes, novelas WHERE volumenes.volumen!=1 AND volumenes.volumen_fecha_publicacion BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND CURDATE() 
		AND novelas.novela_id=volumenes.novela_id ORDER BY volumenes.volumen_id DESC LIMIT 0, 5";
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
	
	
   function getultimasnovelas2()
   {
		$con= new bbdd;
		$conexion=$con->conect();
		$consulta="SELECT * FROM volumenes,novelas WHERE volumenes.volumen=1 and volumenes.novela_id=novelas.novela_id order by novelas.novela_fecha_publicacion desc limit 0, 6";
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
			$x = imagesx($imagen);  
			$y = imagesy($imagen);  

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
		if ($i <= 7) 
		{ // extrae solo 8 items
			 echo '<a rel="noreferrer" href="'.$guid.'"target="_blank" style="text-decoration:none; background-color:rgba(0,0,0,0.00); color:black;">
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
   echo '<div class="logosomos"> 
			<a class="logoso" rel="noreferrer" target="_blank" href="https://www.somoskudasai.com/">
				<h3>Estas noticias son proporcionadas por</h3>
					<img class="tran" alt="logo SomosKudasai" src="recursos/iconos/kudasai.png">	
			</a> 
		</div>';
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
		$pag=1;
    echo '<table class="scale" style="margin:auto; width:auto; height:auto;">
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
					  echo '<td class="boton2">
					 	 <div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$pag.')" class="paginet">
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
									echo '<td class="boton3" style="background-color:rgba(160,237,98,0.30);">
									<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
								else
								{
									echo '<td class="boton2" style="background-color:rgba(160,237,98,0.30);">
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
									echo '<td class="boton3">
									<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
								else
								{
									echo '<td class="boton2">
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
								echo '<td class="boton2" style="background-color:rgba(160,237,98,0.30);">
								<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
								'.$a.'
								</div>
								</td>'; 
							}
							else
							{
								if($a>9)
								{
									echo '<td class="boton3">
									<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$a.')"  class="paginet">
									'.$a.'
									</div>
									</td>';
								}
								else
								{
									echo '<td class="boton2">
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
								echo '<td class="boton3">
								<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$ultima.')"  class="paginet">
								'.$ultima.'
								</div>
								</td>';
							}
							else
							{
								echo '<td class="boton2">
								<div onclick="cazargenero('.$filtro.',`'.$typo.'`,'.$ultima.')"  class="paginet">
								'.$ultima.'
								</div>
								</td>';
							}		
					}
				}
	  echo '</tr>
		</table>';
	}
}
class Animes{
	function get_generos(){
		$con= new bbdd;
		$conexion=$con->conecta();
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
	
	function getanimebynombre($anime_nombre)
	{
		$con= new bbdd;
        $conexion=$con->conecta();
        $consulta="SELECT * from animes where animes.anime_nombre=?";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"s",$anime_nombre);
        $ok3=mysqli_stmt_bind_result($ok,$anime_id,$anime_nombre,$anime_nombre_original,$anime_caratula,$anime_miniatura,$anime_generos,$productor_id,
		$artista_id,$anime_fecha,$anime_sinopsis);
		$ok2=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['anime_id']=$anime_id;
			$ras[$f]['anime_nombre']=$anime_nombre;
			$ras[$f]['anime_nombre_original']=$anime_nombre_original;
			$ras[$f]['anime_caratula']=$anime_caratula;
			$ras[$f]['anime_miniatura']=$anime_miniatura;
			$ras[$f]['anime_generos']=$anime_generos;
			$ras[$f]['productor_id']=$productor_id;
			$ras[$f]['artista_id']=$artista_id;
			$ras[$f]['anime_fecha']=$anime_estreno;
			$ras[$f]['anime_sinopsis']=$anime_sinopsis;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	function getanimebyid($anime_id)
	{
		$con= new bbdd;
        $conexion=$con->conecta();
		$consulta="SELECT * from animes,artistas,productores where animes.anime_id=? 
				   and animes.anime_artista_id=artistas.artista_id 
				   and animes.anime_productor_id=productores.productor_id ";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"i",$anime_id);
        $ok3=mysqli_stmt_bind_result($ok,$anime_id,$anime_nombre,$anime_nombre_original,$anime_caratula,$anime_miniatura,$anime_generos,$anime_productor_id,
		$anime_artista_id,$anime_fecha,$anime_sinopsis,$artista_id,$artista_nombre,$artista_enlace,$productor_id,$productor_nombre,$productor_enlace);
		$ok2=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['anime_id']=$anime_id;
			$ras[$f]['anime_nombre']=$anime_nombre;
			$ras[$f]['anime_nombre_original']=$anime_nombre_original;
			$ras[$f]['anime_caratula']=$anime_caratula;
			$ras[$f]['anime_miniatura']=$anime_miniatura;
			$ras[$f]['anime_generos']=$anime_generos;
			$ras[$f]['productor_id']=$productor_id;
			$ras[$f]['productor_nombre']=$productor_nombre;
			$ras[$f]['productor_enlace']=$productor_enlace;
			$ras[$f]['artista_id']=$artista_id;
			$ras[$f]['artista_nombre']=$artista_nombre;
			$ras[$f]['artista_enlace']=$artista_enlace;
			$ras[$f]['anime_fecha']=$anime_estreno;
			$ras[$f]['anime_sinopsis']=$anime_sinopsis;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}

	function getanimes($filtro,$typo,$pagina){
        $con= new bbdd;
        $conexion=$con->conecta();
		$items_pp=25;
		if(empty($filtro))
		{
			if(!empty($pagina))
			{
				if($pagina==1)
				{
					$limite="0,25";
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
				$limite="0,25";
			}
			$pre="SELECT * from animes order by animes.anime_nombre asc limit ".$limite."";
			$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos primera");
		}
		else
		{
			
			if($typo=="primera_letra")
			{
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$limite="0,25";
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
					$limite="0,25";
				}
				$filtro=$filtro."%";
				$pre="SELECT * from animes where animes.anime_nombre LIKE ? order by animes.anime_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos segunda");
        		$ok=mysqli_stmt_bind_param($res,"s",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
			if($typo=="genero")
			{
				$items_pp=25;
				$consulta="SELECT * from animes where animes.anime_generos LIKE '%".$filtro."%' order by animes.anime_nombre asc ";
				$res=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos tercera");
				$ok1=mysqli_stmt_execute($res);
				$ok2=mysqli_stmt_bind_result($res,$anime_id,$anime_nombre,$anime_nombre_original,$anime_caratula,$anime_miniatura,$anime_generos,$productor_id,
				$artista_id,$anime_fecha,$anime_sinopsis);
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
					$generos=explode(",",$anime_generos);
					$cou=sizeof($generos);
					for($x=0;$x<$cou;$x++)
					{
						if($generos[$x]==$filtro)
						{
							if($y>=$z)
							{
								$ras[$v]['anime_id']=$anime_id;
								$ras[$v]['anime_nombre']=$anime_nombre;
								$ras[$v]['anime_nombre_original']=$anime_nombre_original;
								$ras[$v]['anime_caratula']=$anime_caratula;
								$ras[$v]['anime_miniatura']=$anime_miniatura;
								$ras[$v]['anime_generos']=$anime_generos;
								$ras[$v]['productor_id']=$productor_id;
								$ras[$v]['artista_id']=$artista_id;
								$ras[$v]['anime_fecha']=$anime_estreno;
								$ras[$v]['anime_sinopsis']=$anime_sinopsis;
								$y=$y+1;
								$v=$v+1;
								if($v==25)
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
			if($typo=="artista")
			{
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$limite="0,25";
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
					$limite="0,25";
				}
				$pre="SELECT * from animes where animes.artista_id=? order by animes.anime_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
			if($typo=="productor")
			{
				if(!empty($pagina))
				{
					if($pagina==1)
					{
						$limite="0,25";
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
					$limite="0,25";
				}
				$pre="SELECT * from animes where animes.productor_id=? order by animes.anime_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
		}
        $ok1=mysqli_stmt_execute($res);
		$ok2=mysqli_stmt_bind_result($res,$anime_id,$anime_nombre,$anime_nombre_original,$anime_caratula,$anime_miniatura,$anime_generos,$productor_id,
		$artista_id,$anime_fecha,$anime_sinopsis);
		$v=0;
		while(mysqli_stmt_fetch($res))
		{
			$ras[$v]['anime_id']=$anime_id;
			$ras[$v]['anime_nombre']=$anime_nombre;
			$ras[$v]['anime_nombre_original']=$anime_nombre_original;
			$ras[$v]['anime_caratula']=$anime_caratula;
			$ras[$v]['anime_miniatura']=$anime_miniatura;
			$ras[$v]['anime_generos']=$anime_generos;
			$ras[$v]['productor_id']=$productor_id;
			$ras[$v]['artista_id']=$artista_id;
			$ras[$v]['anime_fecha']=$anime_estreno;
			$ras[$v]['anime_sinopsis']=$anime_sinopsis;
			$v=$v+1;
		}
	@mysqli_stmt_close($res);
    return $ras;
	}
	function getpaginas($filtro,$typo){
        $con= new bbdd;
        $conexion=$con->conecta();
		if(empty($filtro))
		{
			$pre="SELECT * from animes";
			$res=mysqli_query($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos primera");
        	$num=mysqli_num_rows($res);
		}
		else
		{
			if($typo=="primera_letra")
			{
				$filtro=$filtro."%";
				$pre="SELECT * from animes where animes.anime_nombre LIKE ?";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"s",$filtro);
				$ok1=mysqli_stmt_execute($res);
        		$num=mysqli_stmt_num_rows($res);
			}
			if($typo=="genero")
			{
				$pre="SELECT * from animes where animes.anime_generos LIKE '%".$filtro."%'";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok1=mysqli_stmt_execute($res);
				$ok2=mysqli_stmt_bind_result($res,$anime_id,$anime_nombre,$anime_nombre_original,$anime_caratula,$anime_miniatura,$anime_generos,$productor_id,
				$artista_id,$anime_fecha,$anime_sinopsis);
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
								$ras[$v]['anime_id']=$anime_id;
								$ras[$v]['anime_nombre']=$anime_nombre;
								$ras[$v]['anime_nombre_original']=$anime_nombre_original;
								$ras[$v]['anime_caratula']=$anime_caratula;
								$ras[$v]['anime_miniatura']=$anime_miniatura;
								$ras[$v]['anime_generos']=$anime_generos;
								$ras[$v]['productor_id']=$productor_id;
								$ras[$v]['artista_id']=$artista_id;
								$ras[$v]['anime_fecha']=$anime_estreno;
								$ras[$v]['anime_sinopsis']=$anime_sinopsis;
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
			}	
			if($typo=="artista")
			{
				$pre="SELECT * from animes where animes.artista_id=?";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
				$ok1=mysqli_stmt_execute($res);
				$num=mysqli_stmt_num_rows($res);
			}
			if($typo=="productor")
			{
				$pre="SELECT * from animes where animes.productor_id=?";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
				$ok1=mysqli_stmt_execute($res);
				$num=mysqli_stmt_num_rows($res);
			}
		}
		$items_pp=20;/* aqui definimos los items por pagina*/
		$fin['items_totales']=$num;/*items totales registrados en la bbdd*/
		$fin['items_pp']=$items_pp;
		$fin['paginas_totales']=ceil($num/$items_pp);/*numero de paginas obtenido dividiendo los item totales por los items por pagina*/
		@mysqli_stmt_close($res);
		return $fin;
	}
	/*function paginacion($typo,$filtro,$pagina){
	echo '<table style="margin:auto; width:auto;">
			<tr>';
				$anim=new Animes();
				$pag=$anim->getpaginas($filtro,$typo);
				if($pag['paginas_totales']<1)
				{
	
				}
				else
				{
					$ultima=$pag['paginas_totales'];
					if(!empty($pagina))
					{
						$inicio=$pagina-2;
					}
					if($inicio<1)
					{
						$inicio=1;
					}
					if($ultima<6)
					{
	
					}
					else
					{
						if($pagina>3)
						{
			     	  echo '<form method="get" action="novelas.php" id="paginas">
							<input type="hidden" name="typo" value="'.$typo.'">
							<input type="hidden" name="filtro" value="'.$filtro.'">
							<input type="hidden" name="pagina" value="1">
							<td class="boton2"><input type="submit" style="background-color:rgba(0,0,0,0.00); height:100%; width:100%; outline:none; cursor:pointer; padding: 12px 15px 14px 15px;" value="1"></td>
							</form>';
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
				  echo '<form method="get" action="novelas.php" id="paginas'.$a.'">
						<input type="hidden" name="typo" value="'.$typo.'">
						<input type="hidden" name="filtro" value="'.$filtro.'">
						<input type="hidden" name="pagina" value="'.$a.'">';
						if(!empty($pagina))
						{
							if($pagina==$a)
							{
									if($a>9)
								{
									echo '<td class="boton3" style="background-color:rgba(160,237,98,0.30);"><input type="submit" style="background-color:rgba(0,0,0,0.00); height:100%; width:100%; outline:none; cursor:pointer; padding: 12px 15px 14px 15px;" value="'.$a.'" ></td></form>';
								}
								else
								{
									echo '<td class="boton2" style="background-color:rgba(160,237,98,0.30);"><input type="submit" style="background-color:rgba(0,0,0,0.00); height:100%; width:100%; outline:none; cursor:pointer; padding: 12px 15px 14px 15px;" value="'.$a.'" ></td></form>';
								}
							}
							else
							{
								if($a>9)
								{
									echo '<td class="boton3"><input type="submit" style="background-color:rgba(0,0,0,0.00); height:100%; width:100%; outline:none; cursor:pointer; padding: 12px 15px 14px 15px;" value="'.$a.'" ></td></form>';
								}
								else
								{
									echo '<td class="boton2"><input type="submit" style="background-color:rgba(0,0,0,0.00); height:100%; width:100%; outline:none; cursor:pointer; padding: 12px 15px 14px 15px;" value="'.$a.'" ></td></form>';
								}
							}
						}
						else
						{
							if($a==1)
							{
								echo '<td class="boton2" style="background-color:rgba(160,237,98,0.30);"><input type="submit" style="background-color:rgba(0,0,0,0.00); height:100%; width:100%; outline:none; cursor:pointer; padding: 12px 15px 14px 15px;" value="'.$a.'" ></td></form>'; 
							}
							else
							{
								if($a>9)
								{
									echo '<td class="boton3"><input type="submit" style="background-color:rgba(0,0,0,0.00); height:100%; width:100%; outline:none; cursor:pointer; padding: 12px 15px 14px 15px;" value="'.$a.'" ></td></form>';
								}
								else
								{
									echo '<td class="boton2"><input type="submit" style="background-color:rgba(0,0,0,0.00); height:100%; width:100%; outline:none; cursor:pointer; padding: 12px 15px 14px 15px;" value="'.$a.'" ></td></form>';
								}
							}
						}
							
					}
					if($fin<$ultima+1)
					{	
				  echo '<form method="get" action="novelas.php" id="paginasfin">
						<input type="hidden" name="typo" value="'.$typo.'">
						<input type="hidden" name="filtro" value="'.$filtro.'">
						<input type="hidden" name="pagina" value="'.$ultima.'">';
							if($ultima>9)
							{
								echo '<td class="boton3"><input type="submit" style="background-color:rgba(0,0,0,0.00); height:100%; width:100%; outline:none; cursor:pointer; padding: 12px 15px 14px 15px;" value="'.$ultima.'" ></td></form>';
							}
							else
							{
								echo '<td class="boton2"><input type="submit" style="background-color:rgba(0,0,0,0.00); height:100%; width:100%; outline:none; cursor:pointer; padding: 12px 15px 14px 15px;" value="'.$ultima.'" ></td></form>';
							}		
						
					}
				}
		 echo '</tr>
		</table>';
	}*/

	function getgenerosbyid($genero_id){
		$con= new bbdd;
		$conexion=$con->conecta();
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
	function getcapitulosbyanimeid($anime_id){
        $con= new bbdd;
        $conexion=$con->conecta();
        $consulta="SELECT * from capitulos where capitulos.anime_id=? order by capitulo_id asc";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"i",$anime_id);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$capitulo_id,$anime_id,$capitulo_numero,$capitulo_nombre,$capitulo_enlace1,$capitulo_enlace2,$capitulo_enlace3,$capitulo_enlace4,$capitulo_enlace5);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['capitulo_id']=$capitulo_id;
			$ras[$f]['anime_id']=$anime_id;
			$ras[$f]['capitulo_numero']=$capitulo_numero;
			$ras[$f]['capitulo_nombre']=$capitulo_nombre;
			$ras[$f]['capitulo_enlace1']=$capitulo_enlace1;
			$ras[$f]['capitulo_enlace2']=$capitulo_enlace2;
			$ras[$f]['capitulo_enlace3']=$capitulo_enlace3;
			$ras[$f]['capitulo_enlace4']=$capitulo_enlace4;
			$ras[$f]['capitulo_enlace5']=$capitulo_enlace5;
			
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	function getanimez(){
        $con= new bbdd;
        $conexion=$con->conecta();
	   $consulta="SELECT * from animes,artistas,productores 
	   		       where animes.anime_artista_id=artistas.artista_id 
				   and animes.anime_productor_id=productores.productor_id ";
        $ok=mysqli_prepare($conexion,$consulta);
        $ok3=mysqli_stmt_bind_result($ok,$anime_id,$anime_nombre,$anime_nombre_original,$anime_caratula,$anime_miniatura,$anime_generos,$anime_productor_id,
		$anime_artista_id,$anime_estreno,$anime_sinopsis,$artista_id,$artista_nombre,$artista_enlace,$productor_id,$productor_nombre,$productor_enlace);
		$ok2=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['anime_id']=$anime_id;
			$ras[$f]['anime_nombre']=$anime_nombre;
			$ras[$f]['anime_nombre_original']=$anime_nombre_original;
			$ras[$f]['anime_caratula']=$anime_caratula;
			$ras[$f]['anime_miniatura']=$anime_miniatura;
			$ras[$f]['anime_generos']=$anime_generos;
			$ras[$f]['productor_id']=$productor_id;
			$ras[$f]['productor_nombre']=$productor_nombre;
			$ras[$f]['productor_enlace']=$productor_enlace;
			$ras[$f]['artista_id']=$artista_id;
			$ras[$f]['artista_nombre']=$artista_nombre;
			$ras[$f]['artista_enlace']=$artista_enlace;
			$ras[$f]['anime_fecha']=$anime_estreno;
			$ras[$f]['anime_sinopsis']=$anime_sinopsis;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}

	function getcapitulobcapituloid($capitulo_id){
        $con= new bbdd;
        $conexion=$con->conecta();
        $consulta="SELECT * from capitulos where capitulos.capitulo_id=? order by capitulo_id asc";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"i",$capitulo_id);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$capitulo_id,$anime_id,$capitulo_numero,$capitulo_nombre,$capitulo_enlace1,$capitulo_enlace2,$capitulo_enlace3,$capitulo_enlace4,$capitulo_enlace5);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['capitulo_id']=$capitulo_id;
			$ras[$f]['anime_id']=$anime_id;
			$ras[$f]['capitulo_numero']=$capitulo_numero;
			$ras[$f]['capitulo_nombre']=$capitulo_nombre;
			$ras[$f]['capitulo_enlace1']=$capitulo_enlace1;
			$ras[$f]['capitulo_enlace2']=$capitulo_enlace2;
			$ras[$f]['capitulo_enlace3']=$capitulo_enlace3;
			$ras[$f]['capitulo_enlace4']=$capitulo_enlace4;
			$ras[$f]['capitulo_enlace5']=$capitulo_enlace5;
			
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	function getultimoscapitulos(){
        $con= new bbdd;
        $conexion=$con->conecta();
        $consulta="SELECT * from capitulos, animes where capitulos.anime_id=animes.anime_id order by capitulo_id desc limit 0,5";
        $ok=mysqli_prepare($conexion,$consulta);
        $ok2=mysqli_stmt_execute($ok);
		$ok3=mysqli_stmt_bind_result($ok,$capitulo_id,$anime_id,$capitulo_numero,$capitulo_nombre,$capitulo_enlace1,$capitulo_enlace2,$capitulo_enlace3,$capitulo_enlace4,$capitulo_enlace5,
		$anime_id,$anime_nombre,$anime_nombre_original,$anime_caratula,$anime_miniatura,$anime_generos,$anime_productor_id,
		$anime_artista_id,$anime_estreno,$anime_sinopsis);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['capitulo_id']=$capitulo_id;
			$ras[$f]['anime_id']=$anime_id;
			$ras[$f]['capitulo_numero']=$capitulo_numero;
			$ras[$f]['capitulo_nombre']=$capitulo_nombre;
			$ras[$f]['capitulo_enlace1']=$capitulo_enlace1;
			$ras[$f]['capitulo_enlace2']=$capitulo_enlace2;
			$ras[$f]['capitulo_enlace3']=$capitulo_enlace3;
			$ras[$f]['capitulo_enlace4']=$capitulo_enlace4;
			$ras[$f]['capitulo_enlace5']=$capitulo_enlace5;
			$ras[$f]['anime_nombre']=$anime_nombre;
			$ras[$f]['anime_nombre_original']=$anime_nombre_original;
			$ras[$f]['anime_caratula']=$anime_caratula;
			$ras[$f]['anime_miniatura']=$anime_miniatura;
			$ras[$f]['anime_generos']=$anime_generos;
			$ras[$f]['productor_id']=$productor_id;
			$ras[$f]['artista_id']=$artista_id;
			$ras[$f]['anime_fecha']=$anime_estreno;
			$ras[$f]['anime_sinopsis']=$anime_sinopsis;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	function getcapituloanterior($capitulo_numero,$anime_id){
		$con= new bbdd;
		$conexion=$con->conecta();
		$capitulo_numero=$capitulo_numero-1;
        $consulta="SELECT * from capitulos, animes where capitulos.anime_id=? and capitulos.capitulo_numero=? and animes.anime_id=capitulos.anime_id ";
		$ok=mysqli_prepare($conexion,$consulta);
		$ok1=mysqli_stmt_bind_param($ok,"ii",$anime_id,$capitulo_numero);
        $ok2=mysqli_stmt_execute($ok);
		$ok3=mysqli_stmt_bind_result($ok,$capitulo_id,$anime_id,$capitulo_numero,$capitulo_nombre,$capitulo_enlace1,$capitulo_enlace2,$capitulo_enlace3,$capitulo_enlace4,$capitulo_enlace5,
		$anime_id,$anime_nombre,$anime_nombre_original,$anime_caratula,$anime_miniatura,$anime_generos,$anime_productor_id,
		$anime_artista_id,$anime_estreno,$anime_sinopsis);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['capitulo_id']=$capitulo_id;
			$ras[$f]['anime_id']=$anime_id;
			$ras[$f]['capitulo_numero']=$capitulo_numero;
			$ras[$f]['capitulo_nombre']=$capitulo_nombre;
			$ras[$f]['capitulo_enlace1']=$capitulo_enlace1;
			$ras[$f]['capitulo_enlace2']=$capitulo_enlace2;
			$ras[$f]['capitulo_enlace3']=$capitulo_enlace3;
			$ras[$f]['capitulo_enlace4']=$capitulo_enlace4;
			$ras[$f]['capitulo_enlace5']=$capitulo_enlace5;
			$ras[$f]['anime_nombre']=$anime_nombre;
			$ras[$f]['anime_nombre_original']=$anime_nombre_original;
			$ras[$f]['anime_caratula']=$anime_caratula;
			$ras[$f]['anime_miniatura']=$anime_miniatura;
			$ras[$f]['anime_generos']=$anime_generos;
			$ras[$f]['productor_id']=$productor_id;
			$ras[$f]['artista_id']=$artista_id;
			$ras[$f]['anime_fecha']=$anime_estreno;
			$ras[$f]['anime_sinopsis']=$anime_sinopsis;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}

	function getcapitulosiguiente($capitulo_numero,$anime_id){
		$con= new bbdd;
		$conexion=$con->conecta();
		$capitulo_numero=$capitulo_numero+1;
        $consulta="SELECT * from capitulos, animes where capitulos.anime_id=? and capitulos.capitulo_numero=? and animes.anime_id=capitulos.anime_id ";
		$ok=mysqli_prepare($conexion,$consulta);
		$ok1=mysqli_stmt_bind_param($ok,"ii",$anime_id,$capitulo_numero);
        $ok2=mysqli_stmt_execute($ok);
		$ok3=mysqli_stmt_bind_result($ok,$capitulo_id,$anime_id,$capitulo_numero,$capitulo_nombre,$capitulo_enlace1,$capitulo_enlace2,$capitulo_enlace3,$capitulo_enlace4,$capitulo_enlace5,
		$anime_id,$anime_nombre,$anime_nombre_original,$anime_caratula,$anime_miniatura,$anime_generos,$anime_productor_id,
		$anime_artista_id,$anime_estreno,$anime_sinopsis);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['capitulo_id']=$capitulo_id;
			$ras[$f]['anime_id']=$anime_id;
			$ras[$f]['capitulo_numero']=$capitulo_numero;
			$ras[$f]['capitulo_nombre']=$capitulo_nombre;
			$ras[$f]['capitulo_enlace1']=$capitulo_enlace1;
			$ras[$f]['capitulo_enlace2']=$capitulo_enlace2;
			$ras[$f]['capitulo_enlace3']=$capitulo_enlace3;
			$ras[$f]['capitulo_enlace4']=$capitulo_enlace4;
			$ras[$f]['capitulo_enlace5']=$capitulo_enlace5;
			$ras[$f]['anime_nombre']=$anime_nombre;
			$ras[$f]['anime_nombre_original']=$anime_nombre_original;
			$ras[$f]['anime_caratula']=$anime_caratula;
			$ras[$f]['anime_miniatura']=$anime_miniatura;
			$ras[$f]['anime_generos']=$anime_generos;
			$ras[$f]['productor_id']=$productor_id;
			$ras[$f]['artista_id']=$artista_id;
			$ras[$f]['anime_fecha']=$anime_estreno;
			$ras[$f]['anime_sinopsis']=$anime_sinopsis;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
    return $ras;
	}
	function getultimosanimes(){
		$con= new bbdd;
		$conexion=$con->conecta();
		$consulta="SELECT * from animes,artistas,productores 
	   		       where artistas.artista_id=animes.anime_artista_id 
				   and animes.anime_productor_id=productores.productor_id order by animes.anime_estreno desc limit 0, 6";
		$ok=mysqli_prepare($conexion,$consulta);
        $ok2=mysqli_stmt_bind_result($ok,$anime_id,$anime_nombre,$anime_nombre_original,$anime_caratula,$anime_miniatura,$anime_generos,$anime_productor_id,
		$anime_artista_id,$anime_estreno,$anime_sinopsis,$artista_id,$artista_nombre,$artista_enlace,$productor_id,$productor_nombre,$productor_enlace);
		$ok3=mysqli_stmt_execute($ok);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$f]['anime_id']=$anime_id;
			$ras[$f]['anime_nombre']=$anime_nombre;
			$ras[$f]['anime_nombre_original']=$anime_nombre_original;
			$ras[$f]['anime_caratula']=$anime_caratula;
			$ras[$f]['anime_miniatura']=$anime_miniatura;
			$ras[$f]['anime_generos']=$anime_generos;
			$ras[$f]['productor_id']=$productor_id;
			$ras[$f]['productor_nombre']=$productor_nombre;
			$ras[$f]['productor_enlace']=$productor_enlace;
			$ras[$f]['artista_id']=$artista_id;
			$ras[$f]['artista_nombre']=$artista_nombre;
			$ras[$f]['artista_enlace']=$artista_enlace;
			$ras[$f]['anime_estreno']=$anime_estreno;
			$ras[$f]['anime_sinopsis']=$anime_sinopsis;
			$f=$f+1;
		}
	@mysqli_stmt_close($ok);
	return $ras;
	}

	function guardar_reportes($anime_id,$capitulo_id,$enlace){
		$con= new bbdd;
		$conexion=$con->conecta();
		$reporte_estado="Reportado";
		$reporte_enlace=$enlace;
		$consulta="insert into reportes(reporte_id,
									    anime_id,
									    capitulo_id,
									    reporte_enlace,
									    reporte_fecha,
									    reporte_estado) values(NULL,?,?,?,NOW(),?)";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos reporte de enlace");
		$params=mysqli_stmt_bind_param($ok,"iiss",$anime_id,$capitulo_id,$reporte_enlace,$reporte_estado);
		$exe=mysqli_stmt_execute($ok);
		@mysqli_stmt_close($ok);
	}
	
}
?>
