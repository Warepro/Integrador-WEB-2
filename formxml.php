<?php
    session_start();
        $usuario1 = "alpaxnatural";
        $servidor = "localhost";
        $basededatos = "alpaxnatural";
        if(isset($_POST['enviar'])){
        $usuario=$_POST['usuario'];
        $apellido=$_POST['apellido'];
        $correo=$_POST['correo'];
        $mjs=$_POST['mjs'];
        $conexion = mysqli_connect( $servidor, $usuario1, "dc3be9bbb") or die ("No se ha podido conectar al servidor de Base de datos");
        $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
        //hacemos la sentencia de sql
        $sql="INSERT INTO users(user, password, email)VALUES('$usuario','$contra', '$correo');";
        $resultado = mysqli_query($conexion, $sql)  or die ( "Algo ha ido mal en la consulta a la base de datos");
        if ($resultado==true) {
            echo "Conexion exitosa";
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=index.php">';
        }else{
            echo "Morro pdjo";
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=index.php">';
            
        }
    


	$doc = new domDocument("1.0","utf-8");
	$doc -> formatOutput = true;
	$doc -> load("DatosUs.xml");

		$raiz = $doc -> getElementsByTagName('usuarios') -> item(0);
			$rama = $doc -> createElement('usuario');

				$hoja = $doc -> createElement('nombre');
				$hoja -> appendChild($doc -> createTextNode($usuario));

            $rama -> appendChild($hoja);
            
                $hoja = $doc -> createElement('apellido');
                $hoja -> appendChild($doc -> createTextNode($apellido));

            $rama -> appendChild($hoja);

            $hoja = $doc -> createElement('mjs');
            $hoja -> appendChild($doc -> createTextNode($mjs));

            $rama -> appendChild($hoja);

				$hoja = $doc -> createElement('correo');
				$hoja -> appendChild($doc -> createTextNode($correo));

			$rama -> appendChild($hoja);
		$raiz -> appendChild($rama);

	$doc -> appendChild($raiz);
	$doc -> save("DatosUs.xml");
}

 ?>