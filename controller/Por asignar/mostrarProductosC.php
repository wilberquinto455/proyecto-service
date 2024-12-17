<?php
  function CatalogoProductos(){
    $objetoConsultas = new consultasE();
    $arreglo = $objetoConsultas->mostrarProductosC();

    if (!isset($arreglo)) {
      echo '<h2>No hay productos destacados.</h2>';
    } else {
      //ciclo para repetir los registros del arreglo f
      foreach($arreglo as $f){
        echo '
        <div class="col-lg-4 col-md-6 card-view" style="padding-bottom: 20px;">
        <a href="detallesProducto.php?Cod_producto='.$f["Cod_producto"].'" class="text-white"> 
          <div class="card my-3 my-lg-0 bg-dark">
            <img class="card-img-top img-view2" src="../'.$f["Foto_producto"].'"
            class="img-fluid w-100" alt="Foto Producto">
              <div class="card-body text-center" style="background-color: #1A191E;">
                <h5 class="card-title text-danger">'.$f["Nombre_producto"].'</h5>  
                <h5 class="card-title">$'.$f["Precio_producto"].'</h5>
              </div>
          </div>
          </a>
        </div>';
      }
    }
  }

  function cargarDetallesProducto(){
    $objetoConsultas = new consultasE();
    $Cod_producto = $_GET['Cod_producto'];
    $result = $objetoConsultas->buscarProducto($Cod_producto);

    foreach ($result as $f){
      echo '
        <div class="col-lg-12">
          <div class="detalles-productos">
            <div class="row">
              <div class="col-md-6" style="display: inline-grid; align-items: center;">
                <h2 class="text-black add-letter-space my-5" style="text-align: center;">'.$f["Nombre_producto"].'</h2>';
      if (strlen($f["Marca"]) > 0) {
        echo '
                        <p class="text-black" style="text-align: center;">Marca: '.$f["Marca"].'</p>
                        <br>';
      }
      echo '
                <p class="text-black" style="text-align: center;">Descripcion: '.$f["Descripcion_producto"].'</p>
                <br>
                <p class="text-black" style="text-align: center;">Disponibles: '.$f["Existencias_producto"].'</p>
                <br>
                <h3 class="card-title text-danger" style="text-align: center;">Precio: $ '.$f["Precio_producto"].'</h3>
              </div>
              <div class="col-md-6" style="display: grid; place-items: center;">
                <img class="img-view1" src="../'.$f["Foto_producto"].'" class="img-fluid w-100" alt="Foto Producto">
              </div>
            </div>
          </div>
        </div>';
    }
  }

?>