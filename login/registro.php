
<?php		

include 'php/conexion_db.php'; // Se incluye el archivo de conexión a la base de datos
$dbcon = conexion(); // se crea una variable con la función definida anteriormente
session_start(); // se inicia una sesión
/* *************************    Inicio de la zona de registro   **************************/

if(isset($_POST['registro'])){ //De acuerdo con el formulario definido aquí se ejecuta cuando presionamos el botón registro 
    $R_usuario=$_POST['R_usuario']; // Se guarda en una variable cada entrada definida en el formulario
	$R_nombre=$_POST['R_nombre']; // Se guarda en una variable cada entrada definida en el formulario
	$R_apellidos=$_POST['R_apellidos']; // Se guarda en una variable cada entrada definida en el formulario
	$R_pass=md5($_POST['R_pass']); // Se guarda en una variable cada entrada definida en el formulario (codificamos la contraseña en MD5)
	
	if (!empty($R_usuario) && !empty($R_nombre) && !empty($R_apellidos) && !empty($R_pass)){ // Se consulta que no exista ningún campo vacío
		$sql ="INSERT INTO usuarios(usuario, nombre, apellidos,contrasena,rol) VALUES('$R_usuario', '$R_nombre', '$R_apellidos','$R_pass','usuario');"; // Ingreso de registro en SQL (parametros de usuario)
		$resultado = pg_query($dbcon, $sql); // Se ejecuta la consulta en PostgreSQL con la conexión definida anteriormente

		if(pg_affected_rows($resultado)==1){ //Si el registro es exitoso, retorna el valor de 1
			echo "<script>
            alert('registro exitoso');
                    window.location='login.html'
                  </script>";; // Mensaje de salida en HTML
			/*echo '<p><a href="inicio_sesion.php">Inicio Sesion</a></p>'; // Mensaje de salida en HTML*/
		}else{
			echo "<script>
            alert('registro fallido usuario no disponible');
                    window.location='registro.php'
                  </script>";; // Si el registro no es exitoso, retorna el mensaje en HTML
		}	
	}else{
		echo "<script>
            alert('registro fallido, campos vacios por favor revise');
                    window.location='registro.php'
                  </script>";; // Si existe algún campo vacío, retorna el mensaje en HTML
	}
}

?>