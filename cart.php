<?php
session_start();
include('./php/conexion.php'); 
if(isset($_SESSION['carrito'])){
//Si existe se busca si ya estaba agregado este producto
if(isset($_GET['id'])){
  $arreglo = $_SESSION['carrito'];
  $encontro=false;
  $numero = 0;
  for($i=0;$i<count($arreglo);$i++){
    if($arreglo[$i]['id']==$_GET['id']){
      $encontro=true;
      $numero=$i;
    }
  }
  if($encontro == true){
    $arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
    $_SESSION['carrito']=$arreglo;
  }else{
    //No estaba el registro
    $nombre = "";
     $precio = "";
     $imagen = "";
     $res = $conexion ->query('select * from productos where id='.$_GET['id'])or die($conexion -> error);
     $nombre=$fila[1];
     $precio=$fila[3];
     $imagen=$fila[4];
     $arregloNuevo = array(
       'id' => $_GET['id'],
       'Nombre' => $nombre,
       'Precio' => $precio,
       'Imagen' => $imagen,
       'Cantidad' => 1
     );
     array_push($arreglo, $arregloNuevo);
     $_SESSION['carrito']=$arreglo;
  }
}
}else{
  //Se cre variable de Sesion
   if(isset($_GET['id'])){
     $nombre = "";
     $precio = "";
     $imagen = "";
     $res = $conexion ->query('select * from productos where id='.$_GET['id'])or die($conexion -> error);
     $nombre=$fila[1];
     $precio=$fila[3];
     $imagen=$fila[4];
     $arreglo[] = array(
       'id' => $_GET['id'],
       'Nombre' => $nombre,
       'Precio' => $precio,
       'Imagen' => $imagen,
       'Cantidad' => 1
     );
     $_SESSION['carrito']=$arreglo;
   }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>AlpaxNatural</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" placeholder="Buscar">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="index.php" class="js-logo-clone">Alpax Companic</a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <li><a href="#"><span class="icon icon-person"></span></a></li>
                  <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                  <li>
                    <a href="cart.php" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count">2</span>
                    </a>
                  </li> 
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                </ul>
              </div> 
            </div>

          </div>
        </div>
      </div> 
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li class="has-children">
              <a href="index.php">Inicio</a>
              <ul class="dropdown">
                <li><a href="#">Menu 1</a></li>
                <li><a href="#">Menu 2</a></li>
                <li><a href="#">Menu 3</a></li>
                <li class="has-children">
                  <a href="#">Sub Menu</a>
                  <ul class="dropdown">
                    <li><a href="#">Menu 1</a></li>
                    <li><a href="#">Menu 2</a></li>
                    <li><a href="#">Menu 3</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="has-children">
              <a href="about.php">Sobre nosotros</a>
              <ul class="dropdown">
                <li><a href="#">Menu 1</a></li>
                <li><a href="#">Menu 2</a></li>
                <li><a href="#">Menu 3</a></li>
              </ul>
            </li>
            <li><a href="shop.php">Tienda</a></li>
            <li><a href="#">Catalogo</a></li>
            <li><a href="#">Los recién llegados</a></li>
            <li><a href="contact.php">Contacto</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Inicio</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Imagen</th>
                    <th class="product-name">Producto</th>
                    <th class="product-price">Priecio</th>
                    <th class="product-quantity">Cantidad</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $total=0;
                if(isset($_SESSION['carrito'])){
                  $arregloCarrito[] =$_SESSION['carrito'];
                  for($i=0;$i<count($arregloCarrito); $i++){  
                    $total = $total+( $arregloCarrito['Precio'] * $arregloCarrito['Cantidad']);
                  ?>
                  <tr>
                    <td class="product-thumbnail">
                      <img src="images/<?php echo $arregloCarrito[$i]['Imagen'];?>" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Nombre'];?></h2>
                    </td>
                    <td>$<?php echo $arregloCarrito[$i]['Precio'];?></td>
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-primary js-btn-minus btnIncrementar" type="button">&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center txtCantidad" 
                        data-precio="<?php echo $arregloCarrito[$i]['Precio'];?>"
                        data-id="<?php echo $arregloCarrito[$i]['Id'];?>"
                        value="<?php echo $arregloCarrito[$i]['Cantidad'];?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-append">
                          <button class="btn btn-outline-primary js-btn-plus btnIncrementar" type="button">&plus;</button>
                        </div>
                      </div>

                    </td>
                    <td class="cant<?php echo $arregloCarrito[$i]['Id'];?>">
                    $<?php echo $arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad'];?></td>
                    <td><a href="#" class="btn btn-primary btn-sm btnEliminar" data-id="<?php echo $arregloCarrito[$i]['id'];?>">X</a></td>
                  </tr>

                  <?php } } ?>
                </tbody>
              </table>
            </div>
          </form>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6 mb-3 mb-md-0">
                <button class="btn btn-primary btn-sm btn-block">Actualización de la compra</button>
              </div>
              <div class="col-md-6">
                <button class="btn btn-outline-primary btn-sm btn-block">Seguir comprando</button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon">Cupon</label>
                <p>Ingrese su código de cupón si tiene uno.</p>
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="coupon" placeholder="introduce el cupon aquí">
              </div>
              <div class="col-md-4">
                <button class="btn btn-primary btn-sm">Aplicar cupón</button>
              </div>
            </div>
          </div>
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Total de carrito</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">$230.00</strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">$230.00</strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Pasar por la caja</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="site-footer border-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navegaciones</h3>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="shop.php">Tienda</a></li>
                  <li><a href="#">Catalogo</a></li>
                  <li><a href="#">Nuevos</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Todos los derechos reservado</a></li>
                  <li><a href="#"> Aviso de Privacidad</a></li>
                  <li><a href="#"> Términos y Condiciones</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="contact.php">Contacto</a></li>
                  <li><a href="about.php">Mas Sobre nosotros</a></li>
                  <li><a href="#">Software</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <h3 class="footer-heading mb-4">Alpax Companic</h3>
            <a href="#" class="block-6">
              <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded mb-4">
              <h3 class="font-weight-light  mb-0">Suplementos alimenticios</h3>
              <p>Desde el 15, Enero, 2008</p>
            </a>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Informacion</h3>
              <ul class="list-unstyled">
                <li class="address">De Los Chopos 2164, Tabachines, 45188 Zapopan, Jal. Mexico</li>
                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                <li class="email">alpaxinfo@gmail.com</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p class="copyright">&copy; Paulo Lopez 16300792 &amp; Emilio Curiel 16300651 Trabajo Academico by: <a href="https://r.search.yahoo.com/_ylt=AwrCwCQ110he1zkABRvv8wt.;_ylu=X3oDMTByOHZyb21tBGNvbG8DYmYxBHBvcwMxBHZ0aWQDBHNlYwNzcg--/RV=2/RE=1581860789/RO=10/RU=http%3a%2f%2fwww.tonala.ceti.mx%2f/RK=2/RS=tf2I.6LP00yXTfOkm15_w66uNag-" target="_blank">Ceti Tonala 2020</a>.</p>
          </div>
          
        </div>
      </div>
    </footer>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
  <script>
  $(document).ready(function(){
    $(".btnEliminar").click(function(event){
      event.preventDefault();
      var id =$(this).data('id');
      var boton = $(this);
      $.ajax({
        method: 'POST', 
        url:'./php/eliminarCarrito.php',
        data:{
          id:id
        }
      }).done(function(respuesta){
        boton.parent('td').parent('tr').remove();
      });
    });
    $(".txtCantidad").keyup(function(){
      var cantidad = $(this).val();
      var precio = $(this).data('precio');
      var id = $(this).data('id');
      incrementar(cantidad, precio, id);
    });
    $(".btnIncrementar").click(function(){
      var precio = $(this).parent('div').parent('div').find('input').data('precio');
      var id = $(this).parent('div').parent('div').find('input').data('id');
      var cantidad = $(this).parent('div').parent('div').find('input').val('cantidad');
      incrementar(cantidad, precio, id);

    });
    function incrementar(cantidad, precio, id){
      var mult = parseFloat(cantidad)*parseFloat(precio);
      $(".cant"+id).text("$"+mult);
      $.ajax({
        method: 'POST', 
        url:'./php/actualizar.php',
        data:{
          id:id, 
          cantidad:cantidad
        }
      }).done(function(respuesta){
        boton.parent('td').parent('tr').remove();
      });
    }
  });
  </script>
    
  </body>
</html>