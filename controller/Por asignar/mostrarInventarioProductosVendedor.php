<?php

  function cargarInventario(){

    $objetoConsultas = new consultasVendedor();
    $arreglo = $objetoConsultas->mostrarInventarioProductosVendedor();

    //isset es para saber si existe algun dato en result
    if (!isset($arreglo)) {
        echo '<h2>No hay registros de inventario en el sistema</h2>';
    } else {
        echo '
        <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id del inventario</th>
                  <th>Fecha y hora</th>
                  <th>Nombre del Producto</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Causa</th>
                  <th>Observaciones</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>

        ';
        //ciclo para repetir los registros del arreglo f
        foreach ($arreglo as $f){
            echo '
            <tr>
                <td> '.$f["ID_inventario"].' </td>
                <td> '.$f["Fecha_inventario"].' </td>
                <td> '.$f["Nombre_producto"].' </td>
                <td> '.$f["Cantidad_inventario"].' </td>
                <td> '.$f["Precio_inventario"].' </td>
                <td> '.$f["Causa"].' </td>
                <td> '.$f["Observaciones"].' </td>
                <td> 
                  <a href="verInfoInventario.php?Id_inv='.$f["ID_inventario"].'" class="btn btn-success" style="margin-left: 20%"><i class="fas fa-edit"></i></a>
                </td>
            </tr>';
        }
        echo '
        </tbody>
              <tfoot>
                <tr>
                  <th>Id del inventario</th>
                  <th>Fecha y hora</th>
                  <th>Nombre del Producto</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Causa</th>
                  <th>Observaciones</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
            </table>
        ';
    }
  }

  function cargarInfoInventario(){
    $objetoConsultas = new consultasVendedor();
    $Id_inventario = $_GET['Id_inv'];
    $result = $objetoConsultas->buscarInventarioVendedor($Id_inventario);

    foreach ($result as $f) {
      echo '
      <form action="../../controller/UpdateInventarioVendedor.php" method="POST">
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="IdImput">Id del inventario</label>
              <input type="number" name="ID_inventario" value="'.$f["ID_inventario"].'" class="form-control" id="IdImput" placeholder="Nit de la empresa del proveedor" readonly="readonly" required>
            </div>
            <div class="form-group col-md-6">
              <label for="Fechaimput">Fecha de creación</label>
              <input type="datetime" name="fechaInv" value="'.$f["Fecha_inventario"].'"class="form-control" id="Fechaimput" placeholder="Identificador del producto" readonly="readonly" required>
            </div>
            <div class="form-group col-md-6">
              <label for="nitproveedorImput">Nit del proveedor</label>
              <input type="number" name="nitproveedor" value="'.$f["Nit_proveedor"].'" class="form-control" id="nitproveedorImput" placeholder="Nit de la empresa del proveedor" required>
            </div>
            <div class="form-group col-md-6">
              <label for="NombreProImput">Nombre del Proveedor</label>
              <input type="text" name="nombrePro" value="'.$f["Nombre_proveedor"].'" class="form-control" id="NombreProImput" placeholder="Nit de la empresa del proveedor" readonly="readonly" required>
            </div>
            <div class="form-group col-md-6">
              <label for="codigoimput">Código del Producto</label>
              <input type="number" name="codproducto" value="'.$f["Cod_producto"].'"class="form-control" id="codigoimput" placeholder="Código del producto" required>
            </div>
            <div class="form-group col-md-6">
              <label for="NombreProdimput">Nombre del Producto</label>
              <input type="text" name="NombreProd" value="'.$f["Nombre_producto"].'"class="form-control" id="NombreProdimput" placeholder="Identificador del producto" readonly="readonly" required>
            </div>
            <div class="form-group col-md-6">
              <label for="cantidadImput">Cantidad del producto</label>
              <input type="number" name="cantidad" value="'.$f["Cantidad_inventario"].'" class="form-control" id="cantidadImput" placeholder="Cantidad del producto" required>
            </div>
            <div class="form-group col-md-6">
              <label for="precioImput">Precio del producto</label>
              <input type="number" name="precio" value="'.$f["Precio_inventario"].'" class="form-control" id="precioImput" placeholder="Valor del producto" required>
            </div>
            <div class="form-group col-md-6">
              <label for="causaImput">Causa</label>
              <select class="form-control" name="causa" id="causaImput" required>
                <option value="'.$f["Causa"].'">'.$f["Causa"].'</option>
                <option value="Ingreso">Ingreso</option>
                <option value="Salida">Salida</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="observacionImput">Observaciones</label>
              <textarea name="observacion" class="form-control" id="observacionImput" cols="30" rows="3" placeholder="Descripción breve del estado de los productos (opcional)">'.$f["Observaciones"].'</textarea>
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