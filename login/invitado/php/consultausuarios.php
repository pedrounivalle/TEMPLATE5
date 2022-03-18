<?php 
  // Conexion DB
  include 'conexion_db.php';
  $dbcon = conexion(); 

	$v = $_POST['v'];

	if(isset($v)){
		$sql = "UPDATE prueba SET slider=$v";
		$resultado = pg_query($dbcon, $sql);
	};
	
	$sql3 = "select count(*) from usuarios";	
	$resultado3 = pg_query($dbcon, $sql3);  

	$status = pg_fetch_result($resultado3,0,0);
	echo ($status);

 ?>