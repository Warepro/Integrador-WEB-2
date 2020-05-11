<?php
    $servidor="localhost";
    $nombreBd="alpaxnatural";
    $usuario="alpaxnatural";
    $pass="dc3be9bbb";
    $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
    if($conexion -> connect_error){
        die("No se pudo conectar");
        
    }
?>