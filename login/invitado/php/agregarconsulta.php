<?php
  include 'conexion_db.php';
  $dbcon = conexion();

  $tipoConsulta=$_POST['tipo'];
  $Consulta=$_POST['cons'];
  $capa=$_POST['capa']; 
  $estacion=$_POST['estacion'];
  $capa2=$_POST['capa2']; 
  $estacion2=$_POST['estacion2'];
  $capa3=$_POST['capa3']; 
  $estacion3=$_POST['estacion3'];
  
  $return_arr = array();

    #Sentencia SQL para realizar una operacion en la base de datos
	if($tipoConsulta=='barrios'){
		$sql = "create or replace view consulta_por_barrio as select v.gid, v.geom from eventos as v, ".$tipoConsulta." as b where st_intersects(v.geom,b.geom) and barrio ILIKE '%".$Consulta."%'";
		$resultado = pg_query($dbcon, $sql);
		$sql2 = "select v.gid, fecha, hora, direccion, bus, ruta, tipo, descripcion from eventos as v, barrios as b where st_intersects(v.geom,b.geom) and barrio ILIKE '%".$Consulta."%'";
		$resultado2 = pg_query($dbcon, $sql2);
		while($row = pg_fetch_array($resultado2)){

   	 $gid = $row['gid'];
   	 $fecha = $row['fecha'];
   	 $hora = $row['hora'];
   	 $direccion = $row['direccion'];
   	 $bus = $row['bus'];
	 $ruta = $row['ruta'];
	 $tipo = $row['tipo'];
	 $descripcion = $row['descripcion'];
	 


   	 $return_arr[]= array("gid" => $gid ,
   	 "fecha" => $fecha,
   	 "hora" => $hora,
   	 "direccion" => $direccion,
   	 "bus" => $bus,
	 "ruta" => $ruta,
	 "tipo" => $conductor,
	 "descripcion" => $descripcion);
    }

    echo json_encode($return_arr);
		
	}else if($tipoConsulta=='estaciones'){
		$sql= "create or replace view consulta_por_estacion as select v.gid, v.geom from eventos as v, estaciones as b where st_intersects(st_transform(v.geom,3115),(select st_buffer(st_transform(geom,3115),200) from estaciones where estacion ILIKE '%".$Consulta."%'))";
        $resultado = pg_query($dbcon, $sql);
		$sql2 = "select gid, fecha, hora, direccion, bus, ruta, tipo, descripcion from eventos where st_intersects(st_transform(geom,3115),(select st_buffer(st_transform(geom,3115),200) from estaciones where estacion ILIKE '%".$Consulta."%'))";
		$resultado2 = pg_query($dbcon, $sql2);
		while($row = pg_fetch_array($resultado2)){

   	 $gid = $row['gid'];
   	 $fecha = $row['fecha'];
   	 $hora = $row['hora'];
   	 $direccion = $row['direccion'];
   	 $bus = $row['bus'];
	 $ruta = $row['ruta'];
	 $tipo = $row['tipo'];
	 $descripcion = $row['descripcion'];
	 


   	 $return_arr[]= array("gid" => $gid ,
   	 "fecha" => $fecha,
   	 "hora" => $hora,
   	 "direccion" => $direccion,
   	 "bus" => $bus,
	 "ruta" => $ruta,
	 "tipo" => $tipo,
	 "descripcion" => $descripcion);
    }

    echo json_encode($return_arr);
	}else if($tipoConsulta=='comunas'){
		$sql = "create or replace view consulta_por_comuna as select v.gid, v.geom from eventos as v, comunas as b where st_intersects(v.geom,b.geom) and comuna = '".$Consulta."'";
		$resultado = pg_query($dbcon, $sql);
		$sql2 = "select v.gid, fecha, hora, direccion, bus, ruta, tipo, descripcion from eventos as v, comunas as b where st_intersects(v.geom,b.geom) and comuna = '".$Consulta."'";
		$resultado2 = pg_query($dbcon, $sql2);
		while($row = pg_fetch_array($resultado2)){

   	 $gid = $row['gid'];
   	 $fecha = $row['fecha'];
   	 $hora = $row['hora'];
   	 $direccion = $row['direccion'];
   	 $bus = $row['bus'];
	 $ruta = $row['ruta'];
	 $tipo = $row['tipo'];
	 $descripcion = $row['descripcion'];
	 


   	 $return_arr[]= array("gid" => $gid ,
   	 "fecha" => $fecha,
   	 "hora" => $hora,
   	 "direccion" => $direccion,
   	 "bus" => $bus,
	 "ruta" => $ruta,
	 "tipo" => $conductor,
	 "descripcion" => $descripcion);
    }

    echo json_encode($return_arr);
		
	}if($capa=='tiendas_deportivas'){
		$sql= "CREATE OR REPLACE VIEW ruta_tienda AS SELECT seq, id1 AS node, id2 AS edge, cost, b.geom FROM pgr_dijkstra('
                SELECT gid AS id,
                         source::integer,
                         target::integer,
                         reverse_cost::double precision AS cost
                        FROM mallavial_cali',
(select id::integer from (select id, st_distance(the_geom,(select geom from estaciones where estacion ILIKE '%".$estacion."%'))from mallavial_cali_vertices_pgr
order by 2 limit 1) as inicio),
(select id::integer from (select id, st_distance(the_geom,(select t.geom from ".$capa." as t, estaciones as e where estacion ILIKE '%".$estacion."%' order by st_distance(t.geom,e.geom) limit 1))from mallavial_cali_vertices_pgr
order by 2 limit 1) as final), 
                        false, false) a LEFT JOIN mallavial_cali b ON (a.id2 = b.gid)";
        $resultado = pg_query($dbcon, $sql);
		$sql2 = "select name, tipo, descrip from ".$capa." order by st_distance((select geom from estaciones where estacion ILIKE '%".$estacion."%'),geom) limit 1";
		$resultado2 = pg_query($dbcon, $sql2);
		while($row = pg_fetch_array($resultado2)){

   	 $name = $row['name'];
   	 $tipo = $row['tipo'];
   	 $descrip = $row['descrip'];

   	 $return_arr[]= array("name" => $name ,
   	 "tipo" => $tipo,
   	 "descrip" => $descrip);
    }

    echo json_encode($return_arr);
        
	}if($capa2=='escenarios_deporte'){
		$sql= "CREATE OR REPLACE VIEW ruta_escenario AS SELECT seq, id1 AS node, id2 AS edge, cost, b.geom FROM pgr_dijkstra('
                SELECT gid AS id,
                         source::integer,
                         target::integer,
                         reverse_cost::double precision AS cost
                        FROM mallavial_cali',
(select id::integer from (select id, st_distance(the_geom,(select geom from estaciones where estacion ILIKE '%".$estacion2."%'))from mallavial_cali_vertices_pgr
order by 2 limit 1) as inicio),
(select id::integer from (select id, st_distance(the_geom,(select t.geom from ".$capa2." as t, estaciones as e where estacion ILIKE '%".$estacion2."%' order by st_distance(t.geom,e.geom) limit 1))from mallavial_cali_vertices_pgr
order by 2 limit 1) as final), 
                        false, false) a LEFT JOIN mallavial_cali b ON (a.id2 = b.gid)";
        $resultado = pg_query($dbcon, $sql);
		$sql2 = "select nombre from ".$capa2." order by st_distance((select geom from estaciones where estacion ILIKE '%".$estacion2."%'),geom) limit 1";
		$resultado2 = pg_query($dbcon, $sql2);
		while($row = pg_fetch_array($resultado2)){

   	 $nombre = $row['nombre'];

   	 $return_arr[]= array("nombre" => $nombre);
    }

    echo json_encode($return_arr);
        
	}if($capa3=='sitios_interes'){
		$sql= "CREATE OR REPLACE VIEW ruta_poi AS SELECT seq, id1 AS node, id2 AS edge, cost, b.geom FROM pgr_dijkstra('
                SELECT gid AS id,
                         source::integer,
                         target::integer,
                         reverse_cost::double precision AS cost
                        FROM mallavial_cali',
(select id::integer from (select id, st_distance(the_geom,(select geom from estaciones where estacion ILIKE '%".$estacion3."%'))from mallavial_cali_vertices_pgr
order by 2 limit 1) as inicio),
(select id::integer from (select id, st_distance(the_geom,(select t.geom from ".$capa3." as t, estaciones as e where estacion ILIKE '%".$estacion3."%' order by st_distance(t.geom,e.geom) limit 1))from mallavial_cali_vertices_pgr
order by 2 limit 1) as final), 
                        false, false) a LEFT JOIN mallavial_cali b ON (a.id2 = b.gid)";
        $resultado = pg_query($dbcon, $sql);
		$sql2 = "select name from ".$capa3." order by st_distance((select geom from estaciones where estacion ILIKE '%".$estacion3."%'),geom) limit 1";
		$resultado2 = pg_query($dbcon, $sql2);
		while($row = pg_fetch_array($resultado2)){

   	 $name = $row['name'];

   	 $return_arr[]= array("name" => $name);
    }

    echo json_encode($return_arr);
    }    
	


?>
