<?php 
  // Conexion DB
  include 'conexion_db.php';
  $dbcon = conexion(); 

	$v = $_POST['v'];

	if(isset($v)){
		$sql = "UPDATE prueba SET slider=$v";
		$resultado = pg_query($dbcon, $sql);
	};
	
	$sql2 = "select descripcion from eventos3 where gid = (select max(gid)-2 from eventos3)";	
	$resultado2 = pg_query($dbcon, $sql2);  

	$status2 = pg_fetch_result($resultado2,0,0);
	echo ($status2);

 ?>