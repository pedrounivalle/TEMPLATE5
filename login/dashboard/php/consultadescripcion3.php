<?php 
  // Conexion DB
  include 'conexion_db.php';
  $dbcon = conexion(); 

	$v = $_POST['v'];

	if(isset($v)){
		$sql = "UPDATE prueba SET slider=$v";
		$resultado = pg_query($dbcon, $sql);
	};
	
	
	$sql3 = "select descripcion from eventos3 where gid = (select max(gid)-3 from eventos3)";	
	$resultado3 = pg_query($dbcon, $sql3);  

	$status3 = pg_fetch_result($resultado3,0,0);
	echo ($status3);

 ?>