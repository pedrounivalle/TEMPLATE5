<?php 
  // Conexion DB
  include 'conexion_db.php';
  $dbcon = conexion(); 

  //Variables POST y arrays para almacenar datos
  $init = $_POST['init'];
  $end = $_POST['end'];
  $return_arr = array();
  
  //Consulta SQL
	$sql = "select * from eventos3 where fecha between '$init' and '$end' order by fecha";
	$resultado = pg_query($dbcon, $sql);	


  //Inserción de filas del query en array
	while($row = pg_fetch_array($resultado)){

 	  $return_arr[]= array(
 	 
 	  "gid" => $row['gid'],
   	"nombre" => $row['nombre'],
   	"email" => $row['email'],
   	"fecha" => $row['fecha'],
   	"descripcion" => $row['descripcion'],
	"direccion" => $row['direccion'],
   	"barrio" => $row['barrio'],
   	"numerocomuna" => $row['numerocomuna'],);
  };

  //Retorno del array como un JSON
  echo json_encode($return_arr);

 ?>