<?php
  include 'conexion_db.php';
  $dbcon = conexion();

  $tipoConsulta=$_POST['tipo'];
  $Consulta=$_POST['cons'];
  
  
  $return_arr = array();

	
	if($tipoConsulta=='barrios'){
		$sql = "create or replace view consulta_por_barrio as select v.gid, v.geom from eventos3 as v, ".$tipoConsulta." as b where st_intersects(v.geom,b.geom) and b.barrio ILIKE '%".$Consulta."%'";
		$resultado = pg_query($dbcon, $sql);
		$sql2 = "select v.gid, v.nombre, email, fecha, descripcion from eventos3 as v, barrios as b where st_intersects(v.geom,b.geom) and b.barrio ILIKE '%".$Consulta."%'";
		$resultado2 = pg_query($dbcon, $sql2);
		while($row = pg_fetch_array($resultado2)){

   $gid = $row['gid'];
   	 $nombre = $row['nombre'];
   	 $email = $row['email'];
   	 $fecha = $row['fecha'];
	 $descripcion = $row['descripcion'];
	 


   	 $return_arr[]= array("gid" => $gid ,
   	 "nombre" => $nombre,
   	 "email" => $email,
   	 "fecha" => $fecha,
	 "descripcion" => $descripcion);
    }

    echo json_encode($return_arr);
		
	} else if($tipoConsulta=='comunas'){
		/* $sql = "create or replace view consulta_por_comuna as select v.gid, v.geom v.longitud, v.latitud from eventos3 as v, comunas as b where st_intersects(v.geom,b.geom) and comuna = '".$Consulta."'";
		$resultado = pg_query($dbcon, $sql); */
		$sql2 = "select v.gid, v.nombre, email, fecha, descripcion from eventos3 as v, comunas as b where st_intersects(v.geom,b.geom) and comuna = '".$Consulta."'";
		$resultado2 = pg_query($dbcon, $sql2);
		while($row = pg_fetch_array($resultado2)){

   	 $gid = $row['gid'];
   	 $nombre = $row['nombre'];
   	 $email = $row['email'];
   	 $fecha = $row['fecha'];
	 $descripcion = $row['descripcion'];
	 


   	 $return_arr[]= array("gid" => $gid ,
   	 "nombre" => $nombre,
   	 "email" => $email,
   	 "fecha" => $fecha,
	 "descripcion" => $descripcion);
    }

    echo json_encode($return_arr);
		
	}
?>
