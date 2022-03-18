<?php
include 'php/conexion_db.php'; // Se incluye el archivo de conexión a la base de datos
$dbcon = conexion(); // se crea una variable con la función definida anteriormente
session_start(); // se inicia una sesión

if(isset($_POST['login'])){ //De acuerdo con el formulario definido aquí, se ejecuta cuando presionamos el botón login
    $L_usuario=$_POST['L_usuario']; // Guarda la variable usuario definida en el formulario
	$L_pass=md5($_POST['L_pass']); //Guarda la variable pwd definida en el formulario (codificamos la contraseña en MD5)
//  Validación de la existencia de los usuarios

 if (!empty($L_usuario) && !empty($L_pass)){ // Se consulta que no exista ningún campo vacío
		$sql =" SELECT usuario, contrasena, rol FROM usuarios WHERE usuario='$L_usuario';"; // Consulta de usuario en SQL
		$resultado = pg_query($dbcon, $sql); // Se ejecuta la consulta en PostgreSQL con la conexión definida anteriormente
		if($row = pg_fetch_array($resultado)){ // se estructura el resultado en matriz
			if($row["contrasena"] == $L_pass){ // Valida la contraseña de la base de datos y la digitada por el usuario  
			   $_SESSION['usuario'] = $row['usuario']; //se define el parametro usuario en la sesion creada
			   $_SESSION['rol'] = $row['rol']; //se define el parametro usuario en la sesion creada
				   echo '<script language="javascript">'; 
				   echo 'location.href = "dashboard/index.html";'; //se define el redireccionamiento de la pagina de inicio en javascript*/
				   echo '</script>';			   
			}else{
			   echo "<script>
            alert('Constraseña incorrecta');
                    window.location='login.html'
                  </script>";; // Si la contraseña de la base de datos no es igual a la digitada por el usuario, retorna un mensaje en HTML
			}
		}else{
		  echo "<script>
            alert('el usuario no existe en la base de datos');
                    window.location='login.html'
                  </script>";; // Cuando la consulta en base de datos no retorna ningún valor, se debe a que no existe el usuario retornando un mensaje en HTML
		}
		
	}else{
		echo "<script>
            alert('campos vacios, por favor revise');
                    window.location='iniciosesion.php'
                  </script>"; // Si existe algún campo vacío, retorna el mensaje en HTML
	}
}
?>
