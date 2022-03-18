<?php 

include 'conexion_db.php';
$dbcon = conexion(); 
// print_r($dbcon);
// exit();
$query = 'select gid, longitud, latitud,nombre, email, fecha, descripcion, direccion, barrio, numerocomuna from eventos3';
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
			"descripcion" => $row['descripcion'],
			"direccion" => $row['direccion'],
			"barrio" => $row['barrio'],		
			"numerocomuna" => $row['numerocomuna']
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