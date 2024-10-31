<?php

    function cargarProductos(){

        $objetoConsultas = new consultasVendedor();
        $arreglo = $objetoConsultas->mostrarProductosVendedor();

        //isset es para saber si existe algun dato en result
        if (!isset($arreglo)) {
            echo '<h2>No hay productos registrados en el sistema</h2>';
        } else {
            echo '
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Código del producto</th>
                      <th>Nombre del producto</th>
                      <th>Descripción</th>
                      <th>Marca</th>
                      <th>Existencias</th>
                      <th>Precio</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

            ';
            //ciclo para repetir los registros del arreglo f
            foreach ($arreglo as $f){
                echo '
                <tr>
                  <td> '.$f["Cod_producto"].' </td>
                  <td> '.$f["Nombre_producto"].' </td>
                  <td> '.$f["Descripcion_producto"].' </td>
                  <td> '.$f["Marca"].' </td>
                  <td> '.$f["Existencias_producto"].' </td>
                  <td> '.$f["Precio_producto"].' </td>
                  <td>
                    <a href="verInfoProducto.php?Cod_producto='.$f["Cod_producto"].'" class="btn btn-success" style="margin-left: 20%"><i class="fas fa-edit"></i></a> 
                  </td>
                </tr>';
            }
            echo '
            </tbody>
                  <tfoot>
                    <tr>
                      <th>Código del producto</th>
                      <th>Nombre del producto</th>
                      <th>Descripción</th>
                      <th>Marca</th>
                      <th>Existencias</th>
                      <th>Precio</th>
                      <th>Acciones</th>
                    </tr>
                  </tfoot>
                </table>
            ';

        }
    }
    function cargarInfoProducto(){
      $objetoConsultas = new consultasVendedor();
      $cod_producto = $_GET['Cod_producto'];
      $result = $objetoConsultas->buscarProductoVendedor($cod_producto);

      foreach ($result as $f){
        echo '
        <form action="../../controller/updateProductoVendedor.php" method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 update-prod">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="" class="form-label">Imagen actual</label> <br>
                    <div><img class="view-prod" src="../'.$f["Foto_producto"].'" alt="Foto del producto"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-9">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="CodproductoImput">Código del producto</label>
                    <input type="number" name="Cod_producto" value="'.$f["Cod_producto"].'" class="form-control" id="CodproductoImput" placeholder="Código del producto" required readonly="readonly">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="nombreProductoImput">Nombre del producto</label>
                    <input type="text" name="Nombre_producto" value="'.$f["Nombre_producto"].'" class="form-control" id="nombreProductoImput" placeholder="Nombre del producto" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="nitproveedorImput">Nit del proveedor</label>
                    <input type="number" name="Nit_proveedor" value="'.$f["Nit_proveedor"].'" class="form-control" id="nitproveedorImput" placeholder="Nit de la empresa del proveedor" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="nombreproveedorImput">Nombre del proveedor</label>
                    <input type="text" name="NombreProveedor" value="'.$f["Nombre_proveedor"].'" class="form-control" id="nombreproveedorImput" placeholder="Nombre de la empresa del proveedor" readonly="readonly">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="idmarcaImput">Marca</label>
                    <input type="text" name="Marca" value="'.$f["Marca"].'" class="form-control" id="idmarcaImput" placeholder="Nombre de la marca del producto (opcional)">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="precioImput">Precio del producto</label>
                    <input type="number" name="Precio_producto" value="'.$f["Precio_producto"].'" class="form-control" id="precioImput" placeholder="Valor del producto" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="fotoproductoinput" class="form-label">Imagen del producto</label>
                    <input type="file" accept=".jpg, .png, .gif, .jpeg" name="Foto_producto" class="form-control" id="fotoproductoinput">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="descripcionProductoimput">Descripción del producto</label>
                    <textarea class="form-control" name="Descripcion_producto" id="descripcionProductoimput" cols="30" rows="3" placeholder="Descipción breve de como es el producto" required>'.$f["Descripcion_producto"].'</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-danger">Actualizar</button>
          </div>
        </form>
        ';
      }

    }

?>