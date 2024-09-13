<?php
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

class Obra{
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
	function get_tipos(){
		$con= new bbdd;
        $conexion=$con->conect();
        $consu="select * from tipos";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
        mysqli_stmt_bind_result($ok,$tipo_id,$tipo);
		mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['tipo_id']=$tipo_id;
			$ras['tipo']=$tipo;
		}
		@mysqli_stmt_close($ok);
		return $ras;
	}
	function get_tipos_by_id($id){
		$con= new bbdd;
        $conexion=$con->conect();
        $consu="select * from tipos where tipos.tipo_id=?";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($ok,"i",$id);
        mysqli_stmt_bind_result($ok,$tipo_id,$tipo);
		mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['tipo_id']=$tipo_id;
			$ras['tipo']=$tipo;
		}
		@mysqli_stmt_close($ok);
		return $ras;
	}
	function get_webs(){
		$con= new bbdd;
        $conexion=$con->conect();
        $consu="select * from webs";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
        mysqli_stmt_bind_result($ok,$web_id,$web);
		mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['web_id']=$web_id;
			$ras['web']=$web;
		}
		@mysqli_stmt_close($ok);
		return $ras;
	}
	function get_webs_by_id($id){
		$con= new bbdd;
        $conexion=$con->conect();
        $consu="select * from webs where webs.web_id=?";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($ok,"i",$id);
        mysqli_stmt_bind_result($ok,$web_id,$web);
		mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['web_id']=$web_id;
			$ras['web']=$web;
		}
		@mysqli_stmt_close($ok);
		return $ras;
	}
	function get_estados(){
		$con= new bbdd;
        $conexion=$con->conect();
        $consu="select * from estados";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
        mysqli_stmt_bind_result($ok,$estado_id,$estado);
		mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['estado_id']=$estado_id;
			$ras['estado']=$estado;
		}
		@mysqli_stmt_close($ok);
		return $ras;
	}
	function get_estados_by_id($id){
		$con= new bbdd;
        $conexion=$con->conect();
        $consu="select * from estados where estados.estado_id=?";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($ok,"i",$id);
        mysqli_stmt_bind_result($ok,$estado_id,$estado);
		mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['estado_id']=$estado_id;
			$ras['estado']=$estado;
		}
		@mysqli_stmt_close($ok);
		return $ras;
	}
	function get_periodos(){
		$con= new bbdd;
        $conexion=$con->conect();
        $consu="select * from periodos";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
        mysqli_stmt_bind_result($ok,$periodo_id,$periodo);
		mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['periodo_id']=$periodo_id;
			$ras['periodo']=$periodo;
		}
		@mysqli_stmt_close($ok);
		return $ras;
	}
	function get_periodos_by_id($id){
		$con= new bbdd;
        $conexion=$con->conect();
        $consu="select * from periodos where periodos.periodo_id=?";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($ok,"i",$id);
        mysqli_stmt_bind_result($ok,$periodo_id,$periodo);
		mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['periodo_id']=$periodo_id;
			$ras['periodo']=$periodo;
		}
		@mysqli_stmt_close($ok);
		return $ras;
	}
	function get_fansub(){
		$con= new bbdd;
        $conexion=$con->conect();
        $consu="select * from fansub";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
        mysqli_stmt_bind_result($ok,$fansub_id,$fansub_nombre,$fansub_enlace);
		mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['fansub_id']=$fansub_id;
			$ras['fansub_nombre']=$fansub_nombre;
			$ras['fansub_enlace']=$fansub_enlace;
		}
		@mysqli_stmt_close($ok);
		return $ras;
	}
	function get_fansub_by_id($id){
		$con= new bbdd;
        $conexion=$con->conect();
        $consu="select * from fansub where fansub.fansub_id=?";
        $ok=mysqli_prepare($conexion,$consu)or die ( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_stmt_bind_param($ok,"i",$id);
        mysqli_stmt_bind_result($ok,$fansub_id,$fansub_nombre,$fansub_enlace);
		mysqli_stmt_execute($ok);
        while(mysqli_stmt_fetch($ok))
		{
			$ras['fansub_id']=$fansub_id;
			$ras['fansub_nombre']=$fansub_nombre;
			$ras['fansub_enlace']=$fansub_enlace;
		}
		@mysqli_stmt_close($ok);
		return $ras;
	}
    function getobras($filtro,$typo,$pagina){
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
			$pre="SELECT obra_id,
						 tipo_id,
						 obra_nombre,
						 obra_generos,
						 SUBSTRING(obra_sinopsis,1,500) AS obra_sinopsis,
                         obra_estado,
                         obra_periodo,
                         obra_patrocinada,
                         patrocinador_id,
						 obra_fecha_inicio,
						 obra_caratula,
						 obra_miniatura,
						 obra_keywords from obras order by obras.obra_nombre asc limit ".$limite."";
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
				$pre="SELECT obra_id,
                            tipo_id,
                            obra_nombre,
                            obra_generos,
                            SUBSTRING(obra_sinopsis,1,500) AS obra_sinopsis,
                            obra_estado,
                            obra_periodo,
                            obra_patrocinada,
                            patrocinador_id,
							obra_fecha_inicio ,
                            obra_caratula,
                            obra_miniatura,
                            obra_keywords from obras where Match(obra_keywords) AGAINST (?) order by obras.obra_nombre asc limit ".$limite."";
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
				$consulta="SELECT   obra_id,
                                    tipo_id,
                                    obra_nombre,
                                    obra_generos,
                                    SUBSTRING(obra_sinopsis,1,500) AS obra_sinopsis,
                                    obra_estado,
                                    obra_periodo,
                                    obra_patrocinada,
                                    patrocinador_id,
                                    obra_caratula,
                                    obra_miniatura,
                                    obra_keywords,
                                    obra_fecha_inicio from obras where obras.obra_generos LIKE '%".$filtro."%' order by obras.obra_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos tercera");
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
			if($typo=="tipo")
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
				$pre="SELECT obra_id,
                                    tipo_id,
                                    obra_nombre,
                                    obra_generos,
                                    SUBSTRING(obra_sinopsis,1,500) AS obra_sinopsis,
                                    obra_estado,
                                    obra_periodo,
                                    obra_patrocinada,
                                    patrocinador_id,
									obra_fecha_inicio,
                                    obra_caratula,
                                    obra_miniatura,
                                    obra_keywords from obras where obras.tipo_id=? order by obras.obra_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
			if($typo=="patrocinador")
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
				$pre="SELECT obra_id,
                                    tipo_id,
                                    obra_nombre,
                                    obra_generos,
                                    SUBSTRING(obra_sinopsis,1,500) AS obra_sinopsis,
                                    obra_estado,
                                    obra_periodo,
                                    obra_patrocinada,
                                    patrocinador_id,
									obra_fecha_inicio,
                                    obra_caratula,
                                    obra_miniatura,
                                    obra_keywords  from obras where obras.patrocinador_id=? order by obras.obra_nombre asc limit ".$limite."";
				$res=mysqli_prepare($conexion, $pre) or die ( "Algo ha ido mal en la consulta a la base de datos");
				$ok=mysqli_stmt_bind_param($res,"i",$filtro);
        		$num=mysqli_stmt_num_rows($res);
			}
		}
		if(!empty($res))
		{
			$ok1=mysqli_stmt_execute($res);
			$ok2=mysqli_stmt_bind_result($res,$obra_id,$tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,$obra_patrocinada,
                                         $patrocinador_id,$obra_fecha_inicio,$obra_caratula,$obra_miniatura,$obra_keywords);
			$v=0;
			while(mysqli_stmt_fetch($res))
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
				$v=$v+1;
			}
		@mysqli_stmt_close($res);
		}
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
    function paginacion($typo,$filtro,$pagina){
		$pagin=1;
    	$uno= '<table class="scale" style="margin:auto; width:auto; height:auto;">
				<tr>';
		$novel=new obra();
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
            $destino="../../recursos/noticias/";
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
            $salida='src="../recursos/noticias/'.$nombre.'"';	
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
					<img class="tran" alt="logo SomosKudasai" src="../recursos/iconos/kudasai.png">	
			</a> 
		</div>';
		return $noticias;
    }
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
    function guardarobra($tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,$obra_patrocinada,
                         $patrocinador_id,$obra_caratula,$obra_miniatura,$obra_keywords)
	{
		$con= new bbdd;
        $conexion=$con->conect();
        $consulta="insert into obras(obra_id,
                                    tipo_id,
                                    obra_nombre,
                                    obra_generos,
                                    obra_sinopsis,
                                    obra_estado,
                                    obra_periodo,
                                    obra_patrocinada,
                                    patrocinador_id,
                                    obra_fecha_inicio,
                                    obra_caratula,
                                    obra_miniatura,
                                    obra_keywords)
				   values(NULL,?,?,?,?,?,?,?,?,NOW(),?,?,?)";
        $ok=mysqli_prepare($conexion,$consulta) or die ( "Algo ha ido mal en la consulta a la base de datos novel paso 1");
	    $ok1=mysqli_stmt_bind_param($ok,"isssiiiisss",$tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,$obra_patrocinada,$patrocinador_id,
                                                      $obra_caratula,$obra_miniatura,$obra_keywords);
        $ok2=mysqli_stmt_execute($ok);
        $consulta2="SELECT * from obras
		where obras.obra_nombre=?
		and obras.obra_caratula=?";
		$ok3=mysqli_prepare($conexion,$consulta2) or die ("Algo ha ido mal en la consulta a la base de datos novel paso 2");
		$ok4=mysqli_stmt_bind_param($ok3,"ss",$obra_nombre,$obra_caratula);
		$ok6=mysqli_stmt_bind_result($ok3,$obra_id,$tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,$obra_patrocinada,
                                     $patrocinador_id,$obra_fecha_inicio,$obra_caratula,$obra_miniatura,$obra_keywords); 
		$ok5=mysqli_stmt_execute($ok3);
		while(mysqli_stmt_fetch($ok3))
		{
            $ras['obra_id']=$obra_id;	
            $ras['tipo_id']=$tipo_id;
            $ras['obra_nombre']=$obra_nombre;
            $ras['obra_generos']=$obra_generos;
            $ras['obra_sinopsis']=$obra_sinopsis;
            $ras['obra_estado']=$obra_estado;
            $ras['obra_periodo']=$obra_periodo;
            $ras['obra_patrocinada']=$obra_patrocinada;
            $ras['patrocinador_id']=$patrocinador_id;
            $ras['obra_fecha_inicio']=$obra_fecha_inicio;
            $ras['obra_caratula']=$obra_caratula;
            $ras['obra_miniatura']=$obra_miniatura;
            $ras['obra_keywords']=$obra_keywords;
        }
	    @mysqli_stmt_close($ok);
        @mysqli_stmt_close($ok3);
		   $error="<table><tr><td> obra_id </td><td>".$ras['obra_id']."</td></tr>
				   <tr><td> tipo </td><td>".$ras['tipo_id']."</td></tr>
				   <tr><td> nombre </td><td>".$ras['obra_nombre']."</td></tr>
				   <tr><td> generos </td><td>".$ras['obra_generos']."</td></tr>
				   <tr><td> sinopsis </td><td>".$ras['obra_sinopsis']."</td></tr>
				   <tr><td> estado </td><td>".$ras['obra_estado']."</td></tr>
				   <tr><td> fansub_id </td><td>".$ras['obra_periodo']."</td></tr>
				   <tr><td> Patrocinio </td><td>".$ras['obra_patrocinada']."</td></tr>
				   <tr><td> Patrocinador </td><td>".$ras['patrocinador_id']."</td></tr>
				   <tr><td> inicio </td><td>".$ras['obra_fecha_inicio']."</td></tr>
				   <tr><td> caratula </td><td>".$ras['obra_caratula']."</td></tr>
				   <tr><td> miniatura </td><td>".$ras['obra_miniatura']."</td></tr>
				   <tr><td> keywords </td><td>".$ras['obra_keywords']."</td></tr></table>";
       
    /*return $ras;*/
		echo $error;
    }
	function editar_obra($obra_id,$tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,$obra_patrocinada,
						   $patrocinador_id,$obra_caratula,$obra_miniatura,$obra_keywords)
	{
		$con= new bbdd;
        $conexion=$con->conect();

		$ras['obra_id']=$obra_id;	
        $ras['tipo_id']=$tipo_id;
        $ras['obra_nombre']=$obra_nombre;
        $ras['obra_generos']=$obra_generos;
        $ras['obra_sinopsis']=$obra_sinopsis;
        $ras['obra_estado']=$obra_estado;
        $ras['obra_periodo']=$obra_periodo;
        $ras['obra_patrocinada']=$obra_patrocinada;
        $ras['patrocinador_id']=$patrocinador_id;
        $ras['obra_caratula']=$obra_caratula;
        $ras['obra_miniatura']=$obra_miniatura;
        $ras['obra_keywords']=$obra_keywords;
	
        $consulta="UPDATE obras 
				   SET  obra_id=?,
                    	tipo_id=?,
                        obra_nombre=?,
                        obra_generos=?,
                        obra_sinopsis=?,
                        obra_estado=?,
                        obra_periodo=?,
                        obra_patrocinada=?,
                        patrocinador_id=?,
                        obra_fecha_inicio=NOW(),
                        obra_caratula=?,
                        obra_miniatura=?,
                        obra_keywords=?
				   WHERE obras.obra_id=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ( "Algo ha ido mal en la consulta a la base de datos novel paso 1");
	    $params=mysqli_stmt_bind_param($ok,
									   "iisssiiiisssi",
									   	$ras['obra_id'],	
										$ras['tipo_id'],
										$ras['obra_nombre'],
										$ras['obra_generos'],
										$ras['obra_sinopsis'],
										$ras['obra_estado'],
										$ras['obra_periodo'],
										$ras['obra_patrocinada'],
										$ras['patrocinador_id'],
										$ras['obra_caratula'],
										$ras['obra_miniatura'],
										$ras['obra_keywords'],
										$ras['obra_id']);
										$ok2=mysqli_stmt_execute($ok);
		$consulta="SELECT * from obras
		where obras.obra_nombre=?
		and obras.obra_caratula=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos novel paso 2");
		$params=mysqli_stmt_bind_param($ok,"ss",$reg['obra_nombre'],$reg['obra_caratula']);
		$resultado=mysqli_stmt_bind_result($ok,$obra_id,$tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,$obra_patrocinada,
										   $patrocinador_id,$obra_fecha_inicio,$obra_caratula,$obra_miniatura,$obra_keywords); 
		$exe=mysqli_stmt_execute($ok); 
		while(mysqli_stmt_fetch($ok))
		{
			$res['obra_id']=$obra_id;	
			$res['tipo_id']=$tipo_id;
			$res['obra_nombre']=$obra_nombre;
			$res['obra_generos']=$obra_generos;
			$res['obra_sinopsis']=$obra_sinopsis;
			$res['obra_estado']=$obra_estado;
			$res['obra_periodo']=$obra_periodo;
			$res['obra_patrocinada']=$obra_patrocinada;
			$res['patrocinador_id']=$patrocinador_id;
			$res['obra_fecha_inicio']=$obra_fecha_inicio;
			$res['obra_caratula']=$obra_caratula;
			$res['obra_miniatura']=$obra_miniatura;
			$res['obra_keywords']=$obra_keywords;
		}
		@mysqli_stmt_close($ok);
		$error="<table><tr><td> obra_id </td><td>".$ras['obra_id']."</td></tr>
		<tr><td> tipo </td><td>".$ras['tipo_id']."</td></tr>
		<tr><td> nombre </td><td>".$ras['obra_nombre']."</td></tr>
		<tr><td> generos </td><td>".$ras['obra_generos']."</td></tr>
		<tr><td> sinopsis </td><td>".$ras['obra_sinopsis']."</td></tr>
		<tr><td> estado </td><td>".$ras['obra_estado']."</td></tr>
		<tr><td> fansub_id </td><td>".$ras['obra_periodo']."</td></tr>
		<tr><td> Patrocinio </td><td>".$ras['obra_patrocinada']."</td></tr>
		<tr><td> Patrocinador </td><td>".$ras['patrocinador_id']."</td></tr>
		<tr><td> inicio </td><td>".$ras['obra_fecha_inicio']."</td></tr>
		<tr><td> caratula </td><td>".$ras['obra_caratula']."</td></tr>
		<tr><td> miniatura </td><td>".$ras['obra_miniatura']."</td></tr>
		<tr><td> keywords </td><td>".$ras['obra_keywords']."</td></tr></table>";
   		echo $error;
    }
	function guardarvideos($obra_id,$video_titulo,$video_caratula,$video_miniatura,$fansub,$fansub_enlace,$web,$video_enlace,$inicio,$fin,$publicacion)
	{
		$con= new bbdd;
		$conexion=$con->conect();
		$consulta="SELECT * from fansub 
							where fansub.fansub_nombre=?";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$fansub);
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
			$consulta="insert into fansub(fansub_id,
										   fansub_nombre,
										   fansub_enlace)
										   values(NULL,?,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 2");
			$params=mysqli_stmt_bind_param($ok,"ss",$fansub,$fansub_enlace);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from fansub 
								where fansub.fansub_nombre=?";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 3");
			$params=mysqli_stmt_bind_param($ok,"s",$fansub);
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
        $consulta="SELECT * from webs 
							where webs.web=?";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$web);
		$resultado=mysqli_stmt_bind_result($ok,$web_id,$web);
		$exe=mysqli_stmt_execute($ok);
		while(mysqli_stmt_fetch($ok))
		{
			$reg['web_id']=$web_id;
			$reg['web']=$web;
		}
		@mysqli_stmt_close($ok);
		if(empty($reg['web_id']))
		{
			$consulta="insert into webs(web_id,
										web)
										values(NULL,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 2");
			$params=mysqli_stmt_bind_param($ok,"s",$web);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from webs 
								where webs.web=?";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 3");
			$params=mysqli_stmt_bind_param($ok,"s",$web);
			$resultado=mysqli_stmt_bind_result($ok,$web_id,$web);
			$exe=mysqli_stmt_execute($ok);
			while(mysqli_stmt_fetch($ok))
			{
				$reg['web_id']=$web_id;
				$reg['web']=$web;
			}
		@mysqli_stmt_close($ok);
		}
        $consulta="insert into videos(video_id,
									  obra_id,
									  fansub_id,
									  web_id,
									  video_capitulo_inicio,
									  video_capitulo_fin,
									  video_titulo,
									  video_caratula,
									  video_miniatura,
									  video_visivilidad,
									  video_fecha,
									  video_enlace)
				   					  values(NULL,?,?,?,?,?,?,?,?,?,NOW(),?)";
		$ok=mysqli_prepare($conexion,$consulta) or die ("Algo ha ido mal en la consulta a la base de datos novel paso 1");
		$params=mysqli_stmt_bind_param($ok,"iiisssssis",$obra_id,$reg['fansub_id'],$reg['web_id'],$inicio,$fin,$video_titulo,$video_caratula,$video_miniatura,$publicacion,$video_enlace);
        $exe=mysqli_stmt_execute($ok);
		@mysqli_stmt_close($ok);
	}
	function getvideosbyobraid($obra_id){
        $con= new bbdd;
		$obr= new Obra;
        $conexion=$con->conect();
        $consulta="SELECT * from videos where videos.obra_id=? order by video_id asc";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"i",$obra_id);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$video_id,$obra_id,$fansub_id,$web_id,$video_capitulo_inicio,$video_capitulo_fin,$video_titulo,$video_caratula,
									 $video_miniatura,$video_visivilidad,$video_fecha,$video_enlace);
        $f=0;
		while(mysqli_stmt_fetch($ok))
		{
			$fan=$obr->get_fansub_by_id($fansub_id);
			$we=$obr->get_webs_by_id($web_id);
			$ras[$f]['video_id']=$video_id;
			$ras[$f]['obra_id']=$obra_id;
			$ras[$f]['fansub_id']=$fan['fansub_id'];
			$ras[$f]['fansub_nombre']=$fan['fansub_nombre'];
			$ras[$f]['fansub_enlace']=$fan['fansub_enlace'];
			$ras[$f]['web_id']=$we['web_id'];
			$ras[$f]['web']=$we['web'];
			$ras[$f]['video_capitulo_inicio']=$video_capitulo_inicio;
			$ras[$f]['video_capitulo_fin']=$video_capitulo_fin;
			$ras[$f]['video_titulo']=$video_titulo;
			$ras[$f]['video_caratula']=$video_caratula;
			$ras[$f]['video_miniatura']=$video_miniatura;
			$ras[$f]['video_publicacion']=$video_visivilidad;
			$ras[$f]['video_fecha']=$video_fecha;
			$ras[$f]['video_enlace']=$video_enlace;
			$f=$f+1;
		}
		@mysqli_stmt_close($ok);
		if(!empty($ras))
		{
			return $ras;
		}
    }
	function editarvideos($video_id,$obra_id,$video_titulo,$video_caratula,$video_miniatura,$fansub,$fansub_enlace,$web,$video_enlace,$inicio,$fin,$publicacion)
	{
		$con= new bbdd;
		$obr= new Obra;
        $conexion=$con->conect();
		$consulta="SELECT * from fansub 
							where fansub.fansub_nombre=?";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$fansub);
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
			$consulta="insert into fansub(fansub_id,
										   fansub_nombre,
										   fansub_enlace)
										   values(NULL,?,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 2");
			$params=mysqli_stmt_bind_param($ok,"ss",$fansub,$fansub_enlace);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from fansub 
								where fansub.fansub_nombre=?";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 3");
			$params=mysqli_stmt_bind_param($ok,"s",$fansub);
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
        $consulta="SELECT * from webs 
							where webs.web=?";
		$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 1");
		$params=mysqli_stmt_bind_param($ok,"s",$web);
		$resultado=mysqli_stmt_bind_result($ok,$web_id,$web);
		$exe=mysqli_stmt_execute($ok);
		while(mysqli_stmt_fetch($ok))
		{
			$reg['web_id']=$web_id;
			$reg['web']=$web;
		}
		@mysqli_stmt_close($ok);
		if(empty($reg['web_id']))
		{
			$consulta="insert into webs(web_id,
										web)
										values(NULL,?)";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 2");
			$params=mysqli_stmt_bind_param($ok,"s",$web);
			$exe=mysqli_stmt_execute($ok);
			@mysqli_stmt_close($ok);
			$consulta="SELECT * from webs 
								where webs.web=?";
			$ok=mysqli_prepare($conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos fan paso 3");
			$params=mysqli_stmt_bind_param($ok,"s",$web);
			$resultado=mysqli_stmt_bind_result($ok,$web_id,$web);
			$exe=mysqli_stmt_execute($ok);
			while(mysqli_stmt_fetch($ok))
			{
				$reg['web_id']=$web_id;
				$reg['web']=$web;
			}
		@mysqli_stmt_close($ok);
		}
		$fan=$obr->get_fansub_by_id($fansub_id);
		$we=$obr->get_webs_by_id($web_id);
			$reg['video_id']=$video_id;
			$reg['obra_id']=$obra_id;
			$reg['fansub_id']=$fan['fansub_id'];
			$reg['fansub_nombre']=$fan['fansub_nombre'];
			$reg['fansub_enlace']=$fan['fansub_enlace'];
			$reg['web_id']=$we['web_id'];
			$reg['web']=$we['web'];
			$reg['video_capitulo_inicio']=$inicio;
			$reg['video_capitulo_fin']=$fin;
			$reg['video_titulo']=$video_titulo;
			$reg['video_caratula']=$video_caratula;
			$reg['video_miniatura']=$video_miniatura;
			$reg['video_publicacion']=$publicacion;
			$reg['video_enlace']=$video_enlace;
        $consulta="UPDATE videos SET 
		obra_id=?,
		fansub_id=?,
		web_id=?,
		video_capitulo_inicio=?,
		video_capitulo_fin=?,
		video_titulo=?,
		video_caratula=?,
		video_miniatura=?,
		video_visivilidad=?,
		video_enlace=?
		WHERE videos.video_id=?";
		$ok=mysqli_prepare($conexion,$consulta) or die ( "Algo ha ido mal en la consulta a la base de datos novel paso 1");
		$params=mysqli_stmt_bind_param($ok,
									   "iiisssssisi",
									   $reg['obra_id'],
									   $reg['fansub_id'],
									   $reg['web_id'],
									   $reg['video_capitulo_inicio'],
									   $reg['video_capitulo_fin'],
									   $reg['video_titulo'],
									   $reg['video_caratula'],
									   $reg['video_miniatura'],
									   $reg['video_publicacion'],
									   $reg['video_enlace'],
									   $reg['video_id']);
        $exe=mysqli_stmt_execute($ok);
		@mysqli_stmt_close($ok);
	}
    function getobrabynombre($obra_nombre)
	{
		$con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT * from obras where obras.obra_nombre=?";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"s",$obra_nombre);
        $ok3=mysqli_stmt_bind_result($ok,$obra_id,$tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,$obra_patrocinada,
                                     $patrocinador_id,$obra_fecha_inicio,$obra_caratula,$obra_miniatura,$obra_keywords);
		$ok2=mysqli_stmt_execute($ok);
        $v=0;
		while(mysqli_stmt_fetch($ok))
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
			$v=$v+1;
		}
	    @mysqli_stmt_close($ok);
        return $ras;
	}
    function getobrabyid($obra_id){
        $con= new bbdd;
        $conexion=$con->conect();
        $consulta="SELECT * from obras,tipos,estados,periodos
					where obras.obra_id=?
					and tipos.tipo_id=obras.tipo_id 
					and estados.estado_id=obras.obra_estado 
					and periodos.periodo_id=obras.obra_periodo order by obra_nombre asc";
        $ok=mysqli_prepare($conexion,$consulta);
	    $ok1=mysqli_stmt_bind_param($ok,"i",$obra_id);
        $ok2=mysqli_stmt_execute($ok);
        $ok3=mysqli_stmt_bind_result($ok,$obra_id,$tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,$obra_patrocinada,
		                            $patrocinador_id,$obra_fecha_inicio,$obra_caratula,$obra_miniatura,$obra_keywords,$tipo_id,$tipo,$estado_id,$estado,$periodo_id,$periodo);

        /*$ok3=mysqli_stmt_bind_result($ok,$obra_id,$tipo_id,$obra_nombre,$obra_generos,$obra_sinopsis,$obra_estado,$obra_periodo,$obra_patrocinada,
		                            $patrocinador_id,$obra_fecha_inicio,$obra_caratula,$obra_miniatura,$obra_keywords,$tipo,$estado,$periodo);*/
        $v=0;
		while(mysqli_stmt_fetch($ok))
		{
			$ras[$v]['obra_id']=$obra_id;	
            $ras[$v]['tipo_id']=$tipo_id;
			$ras[$v]['tipo']=$tipo;
            $ras[$v]['obra_nombre']=$obra_nombre;
            $ras[$v]['obra_generos']=$obra_generos;
            $ras[$v]['obra_sinopsis']=$obra_sinopsis;
            $ras[$v]['obra_estado']=$obra_estado;
			$ras[$v]['estado']=$estado;
            $ras[$v]['obra_periodo']=$obra_periodo;
			$ras[$v]['periodo']=$periodo;
            $ras[$v]['obra_patrocinada']=$obra_patrocinada;
            $ras[$v]['patrocinador_id']=$patrocinador_id;
            $ras[$v]['obra_fecha_inicio']=$obra_fecha_inicio;
            $ras[$v]['obra_caratula']=$obra_caratula;
            $ras[$v]['obra_miniatura']=$obra_miniatura;
            $ras[$v]['obra_keywords']=$obra_keywords;
			$v=$v+1;
		}
	    @mysqli_stmt_close($ok);
        return $ras;
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
	function get_usuarios()
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$consult="select usuario_id,usuario_nombre FROM  usuarios order by usuario_nombre asc";
        $ok=mysqli_prepare($conexion,$consult);
        $okk2=mysqli_stmt_execute($ok);
        $okk3=mysqli_stmt_bind_result($ok,$usuario_id,$usuario_nombre);
		$v=0;
        while(mysqli_stmt_fetch($ok))
		{
			$ret[$v]['usuario_id']=$usuario_id;
			$ret[$v]['usuario_nombre']=$usuario_nombre; 
			$v=$v+1;
		}
		@mysqli_stmt_close($ok);
		return $ret; 
	}
	function get_usuarios_by_id($usuario_id)
	{
		$con= new bbdd;
        $conexion=$con->conect();
		$consult="select usuario_id,usuario_nombre FROM usuarios WHERE usuarios.usuario_id=? order by usuario_nombre asc";
        $ok=mysqli_prepare($conexion,$consult);
		$ok1=mysqli_stmt_bind_param($ok,"i",$usuario_id);
        $okk2=mysqli_stmt_execute($ok);
        $okk3=mysqli_stmt_bind_result($ok,$usuario_id,$usuario_nombre);
		mysqli_stmt_fetch($ok);
		$ret['usuario_id']=$usuario_id;
		$ret['usuario_nombre']=$usuario_nombre; 
		@mysqli_stmt_close($ok);
		return $ret; 
	}
}
?>