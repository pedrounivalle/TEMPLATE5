<?php 
  // Conexion DB
  include 'conexion_db.php';
  $dbcon = conexion(); 

  //Variables POST y arrays para almacenar datos  
 
  
  $i= $_POST['i'];

 /*  if ($i=='ambiental') { */
  	# code...
  
  //Consulta SQL
	$sql2 = "select b.barrio, count(b.barrio) from eventos3 as v,barrios as b where st_intersects(v.geom,b.geom) group by b.barrio order by count desc limit 10";
	$resultado2 = pg_query($dbcon, $sql2);	


  //Inserción de filas del query en array
	while($row = pg_fetch_array($resultado2)){

 	 $return_arr[]= array(
 	/* "id_amb" => $row['id_amb'], */
	"count" => $row['count'],
	/* "precipitacion" => $row['precipitacion'],
	"rad_solar" => $row['rad_solar'],
	"temp_bulhum" => $row['temp_bulhum'],
	"temp_aire" => $row['temp_aire'],
	"dir_viento" => $row['dir_viento'],
	"vel_viento" => $row['vel_viento'],
	"pres_atm" => $row['pres_atm'],
	"temp_suelo" => $row['temp_suelo'],
	"pres_porprof_30" => $row['pres_porprof_30'],
	"pres_porprof_60" => $row['pres_porprof_60'],
	"pres_porprof_90" => $row['pres_porprof_90'],  */
	"barrio" => $row['barrio']);
  };

  //Retorno del array como un JSON
  echo json_encode($return_arr);


/* }elseif ($i=='electrico') {
	# code...
	//Consulta SQL
	$sql2 = "select * from (select * from sist_ele order by id_st desc limit 12) a order by 1";
	$resultado2 = pg_query($dbcon, $sql2);	


  //Inserción de filas del query en array
	while($row = pg_fetch_array($resultado2)){

 	 $return_arr2[]= array(
 	"id_st" => $row['id_st'],
 	"tiempo" => $row['tiempo_ele'],
	"vdc_bat_comp1" => $row['vdc_bat_comp1'],
	"idc_bat_comp1" => $row['idc_bat_comp1'],
	"vdc_bat_comp2" => $row['vdc_bat_comp2'],
	"idc_bat_comp2" => $row['idc_bat_comp2'],
	"cbat_comp1" => $row['cbat_comp1'],
	"cbat_comp2" => $row['cbat_comp2'],
	"idc_siscomp1" => $row['idc_siscomp1'],
	"idc_siscomp2" => $row['idc_siscomp2'],
	"valcon_siscomp1" => $row['valcon_siscomp1'],
	"valcon_siscomp2" => $row['valcon_siscomp2']);
  };

  //Retorno del array como un JSON
  echo json_encode($return_arr2);

}elseif ($i=='lamina') {
	# code...
		$sql3 = "select * from (select * from control_la order by id_ct desc limit 12) a order by 1";
	$resultado3 = pg_query($dbcon, $sql3);	


  //Inserción de filas del query en array
	while($row = pg_fetch_array($resultado3)){

 	 $return_arr3[]= array(
 	"id_ct" => $row['id_ct'],
 	"tiempo" => $row['tiempo_la'],
	"niv_lamagua" => $row['niv_lamagua'],
	"niv_compadm" => $row['niv_compadm'],
	"niv_compsal" => $row['niv_compsal'],
	"detec_amax_comp1" => $row['detec_amax_comp1'],
	"detec_ctol_comp1" => $row['detec_ctol_comp1'],
	"detec_amax_comp2" => $row['detec_amax_comp2'],
	"detec_ctol_comp2" => $row['detec_ctol_comp2'],
	"pos_comp1" => $row['pos_comp1'],
	"pos_comp2" => $row['pos_comp2'],
	"niv_compadm_ext" => $row['niv_compadm_ext'],
	"niv_compadm_cau" => $row['niv_compadm_cau'],
	"niv_compsal_cau" => $row['niv_compsal_cau']);
  };

  //Retorno del array como un JSON
  echo json_encode($return_arr3);
}; */

 ?>