<?php 
  // Conexion DB
  include 'conexion_db.php';
  $dbcon = conexion(); 

	$v = $_POST['v'];

	if(isset($v)){
		$sql = "UPDATE prueba SET slider=$v";
		$resultado = pg_query($dbcon, $sql);
	};
	
	$sql = "select descripcion from eventos3 where gid = (select max(gid) from eventos3)";	
	$resultado = pg_query($dbcon, $sql);  

	$status = pg_fetch_result($resultado,0,0);
	echo ($status);

 ?>