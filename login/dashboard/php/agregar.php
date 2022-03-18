<?php
include 'conexion_db.php';
$dbcon = conexion();

 $lat=$_POST['lat'];
 $lon=$_POST['lon'];
 $fec=$_POST['fec'];
 $nom=$_POST['nom'];
 $mai=$_POST['mai'];
 $des=$_POST['des']; 
 $foto=$_POST['foto'];	
 $dir=$_POST['dir'];
 $bar=$_POST['bar'];
 $com=$_POST['com']; 


  if($foto == 'Sin Foto'){
 $nomb_img =$foto ;
 }else{
 $nomb_img= 'img/'.time().".jpg";

 list(, $foto) = explode(';', $foto);
 list(, $foto)      = explode(',', $foto);
 $foto = base64_decode($foto);

 file_put_contents("../".$nomb_img, $foto);

 }
 
 $sql ="INSERT INTO eventos3 (latitud, longitud, nombre,email, fecha, descripcion, foto, direccion, barrio, numerocomuna)
    VALUES ('".$lat."', '".$lon."', '".$nom."','".$mai."','".$fec."', '".$des."','".$nomb_img."','".$dir."','".$bar."','".$com."');";

 $resultado = pg_query($dbcon, $sql);

?>
