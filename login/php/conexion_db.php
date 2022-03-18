<?php
function conexion(){
$host = 'ec2-18-210-191-5.compute-1.amazonaws.com';
$port = '5432';
$base_datos = 'd750e1jkiklgf6';
$usuario = 'ywttvgdgdsweuw';
$pass = '94849cfcdef7ec0bb7ff805bf94b995cb7061ed86d7a710a839cecff90d6b21b';
$conexion = pg_connect("host=$host port=$port dbname=$base_datos user=$usuario password=$pass");
return($conexion);
}
?>