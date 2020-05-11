
                <!--
                Esto es del carrito
                -->
<?php
session_start();
$arreglo = $_SESSION['carrito'];
for($i=0; $i<count($arreglo);$i++){
    if($arreglo[$i]['id']==$_POST['id']){
        $arregloNuevo = array(
            'id' => $arreglo[$i]['id'],
            'Nombre' => $arreglo[$i]['Nombre'],
            'Precio' => $arreglo[$i]['Precio'],
            'Imagen' => $arreglo[$i]['Imagen'],
            'Cantidad' =>$arreglo[$i]['Cantidad']
          );
    }
  }
  if(isset($arregloNuevo)){
      $_SESSION['carrito']=$arregloNuevo;
  }else{
      //El registro a eliminar es el unico que habia
      unset($_SESSION['carrito']);
  }
  echo "Listo";
?>

                <!--
                Esto es del carrito
                -->