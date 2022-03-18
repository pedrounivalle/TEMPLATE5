<?php 
  // Conexion DB
  include 'conexion_db.php';
  $dbcon = conexion(); 

	
	$sql1 = "select descripcion from eventos3 where gid = (select max(gid)-1 from eventos3)";	
	$resultado1 = pg_query($dbcon, $sql1);  

	$status1 = pg_fetch_result($resultado1,0,0);
	echo ($status1);
	

 ?>