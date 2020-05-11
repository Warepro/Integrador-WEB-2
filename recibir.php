<?php
session_start();
    $usuario1 = "alpaxnatural";
	$servidor = "localhost";
	$basededatos = "alpaxnatural";
	if(isset($_POST['enviar'])){
	$usuario=$_POST['usuario'];
	$contra=$_POST['contra'];
	$correo=$_POST['correo'];
	$conexion = mysqli_connect( $servidor, $usuario1, "dc3be9bbb") or die ("No se ha podido conectar al servidor de Base de datos");
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
	//hacemos la sentencia de sql
	$sql="INSERT INTO users(user, password, email)VALUES('$usuario','$contra', '$correo');";
	$resultado = mysqli_query($conexion, $sql)  or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($resultado==true) {
		echo "Conexion exitosa";
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=index.php">';
	}else{
		echo "No se pudo conectar";
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=index.php">';
		}	
	}
?>