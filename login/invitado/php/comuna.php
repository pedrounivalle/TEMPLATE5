<?php 

include 'conexion_db.php';
$dbcon = conexion(); 
// print_r($dbcon);
// exit();
$consulta = $_POST["ref"];
/* echo ($consulta);
exit(); */
$query = "select v.gid, v.longitud, v.latitud,v.nombre, v.email, v.fecha, v.descripcion from eventos3 as v, comunas as b where st_intersects(v.geom,b.geom) and b.comuna = $consulta";

/* echo ($query);
exit(); */
// $result = odbc_exec($dbcon,$query);
$result = pg_query($dbcon,$query);


$geojson = array('type' => 'FeatureCollection', 'name'=>'eventos3','features' => array());

while($row = pg_fetch_array($result)) {
    $marker = array(
        'type' => 'Feature',                   
        'properties' => array(
			"gid" => $row['gid'],
			"nombre" => $row['nombre'],
			"email" => $row['email'],
			"fecha" => $row['fecha'],		
			"descripcion" => $row['descripcion']
        ),
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array(
                 floatval($row['longitud']),
                 floatval($row['latitud'])
            )
        )
        
    );
    array_push($geojson['features'], $marker);
}

echo json_encode($geojson); 

?>