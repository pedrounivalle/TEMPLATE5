<?php 

  //Archivo de funciones

   include('configuracion_base.php');
   
   session_start();
   
  
   $peticion = isset($_POST['peticion']) ? $_POST['peticion'] : null;  
   $parametros = isset($_POST['parametros']) ? $_POST['parametros'] : null; 
   
   switch($peticion)
   {	
		//Caso para obtener lista usuarios 
		case 'obtener-listausuarios':
		{
			$sql="SELECT id_usuario, nombre, apellido from usuarios;";
			$query = pg_query($dbcon,$sql);
			// si se obtiene mas de un registro en el select
			$html="";
			while ($row = pg_fetch_row($query)) 
			{
				$html .=  '<option value="' . $row[0] . '" >' . $row[0].'-'.$row[1] . '</option>';
			}
			echo $html;
			break;
		}
		
	//Caso para obtener usuario 	
		case 'obtener-usuario':
		{
			$usuario = $parametros['usuario'];
			$sql="select nombre, apellido, id_rol from usuarios WHERE id_usuario = '$usuario';";
			$query3 = pg_query($dbcon,$sql);
			$row = pg_fetch_row($query3);
			echo $row[0].'|'.$row[1];
			break;
		}
		
		//Caso para modificar usuario
		case 'modificar-usuario':
		{
			$usuario = $parametros['usuario'];
			$nombre = $parametros['nombre'];
			$apellido = $parametros['apellido'];			
			$rh = $parametros['rh'];
			$email = $parametros['email'];
			$pass = md5($parametros['pass']);
			
			$sql="UPDATE usuarios set nombre='$nombre' ,  apellido='$apellido', rh='$rh', correo='$email', contrasena='$pass'  WHERE id_usuario='$usuario';";
			$query = pg_query($dbcon,$sql);
			if($query)
			{
				echo "MODIFICADO";
			}else
			{
				echo "ERROR";
			}
			break;
		}
		
		//Caso para borrar un usuario 
		case 'borrar-usuario':
		{
			$usuario = $parametros['usuario'];
			
			$sql =  "DELETE FROM usuarios WHERE id_usuario='$usuario';";
			$query = pg_query($dbcon,$sql);
			if($query)
			{
				echo "ELIMINADO";
			}else
			{
				echo "ERROR";
			}
			break;
   		}		
		
	} 


?>