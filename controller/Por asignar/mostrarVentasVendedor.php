<?php
  function cargarVenta(){
      $objetoConsultas = new consultasVendedor ();
      $arreglo = $objetoConsultas->mostrarVentasVendedor();

      //isset es para saber si existe algun dato en result
      if (!isset($arreglo)) {
        echo '<h2>No hay ventas registradas en el sistema</h2>';
      } else {
          echo '
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id de la factura</th>
                    <th>Fecha y hora</th>
                    <th>Nombres del empleado</th>
                    <th>Nombres del cliente</th>
                    <th>Método de pago</th>
                    <th>Total de venta</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>

          ';
          //ciclo para repetir los registros del arreglo f
          foreach ($arreglo as $f){
            echo '
              <tr>
                  <td> '.$f["ID_factura"].' </td>
                  <td> '.$f["Fecha_compra"].' </td>
                  <td> '.$f["Nombres_empleado"].' </td>
                  <td> '.$f["Nombres_cliente"].' </td>
                  <td> '.$f["Nombre_forma_pago"].' </td>
                  <td> $'.$f["Total_venta"].' </td>
                  <td style="width: 92px; min-width:92px">
                    <a href="facturaViewVendedor.php?ID_factura='.$f["ID_factura"].'" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="verInfoVenta.php?ID_factura='.$f["ID_factura"].'" class="btn btn-success"><i class="fas fa-edit"></i></a>
                  </td>
              </tr>';
          }
          echo '
          </tbody>
                <tfoot>
                  <tr>
                    <th>Id de la factura</th>
                    <th>Fecha y hora</th>
                    <th>Nombres del empleado</th>
                    <th>Nombres del cliente</th>
                    <th>Método de pago</th>
                    <th>Total de venta</th>
                    <th>Acciones</th>
                  </tr>
                </tfoot>
              </table>
          ';
      }
  }

  function cargarInfoVentaVendedor(){
    $objetoConsultas = new consultasVendedor();
    $ID_factura = $_GET['ID_factura'];
    $result = $objetoConsultas->buscarVentaVendedor($ID_factura);

    foreach ($result as $f){
      echo'
      <form action="../../controller/updateVentaVendedor.php" method="POST">
              <div class="card-body">
                <div class="row">
                  <!-- a la opcion de "selciones una opcion" se le pone un valor vacio para que haga 
                  la comparacion en el controlador y no de error -->
                  <div class="form-group col-md-6">
                    <label for="idFacturaImput">Id de la factura</label> 
                    <input type="number" class="form-control" value="'.$f["ID_factura"].'" name="ID_factura" readonly="readonly" id="idFacturaImput" placeholder="Id de la factura" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="FechaImput">Fecha de la factura</label> 
                    <input type="datetime" class="form-control" value="'.$f["Fecha_compra"].'" name="fecha" readonly="readonly"  id="FechaImput" placeholder="Fecha" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="IdEmpleadoImput">Id del empleado</label> 
                    <input type="number" class="form-control" value="'.$f["ID_empleado"].'" name="ID_empleado" id="IdEmpleadoImput" placeholder="Id del empleado" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="NombresEmpImput">Nombres del empleado</label> 
                    <input type="text" class="form-control" value="'.$f["Nombres_empleado"].'" name="NombresEmp" readonly="readonly"  id="NombresEmpImput" placeholder="Nombres del empleado" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="IdclienteImput">No. de documento del cliente</label>
                    <input type="number" class="form-control" value="'.$f["ID_cliente"].'" name="ID_cliente" id="IdclienteImput" placeholder="Id del cliente" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="NombreCliImput">Nombres del cliente</label>
                    <input type="text" class="form-control" value="'.$f["Nombres_cliente"].'" readonly="readonly" name="NombresCli" id="NombreCliImput" placeholder="Nombres del cliente" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="codigoImput">Código del producto</label>
                    <input type="number" class="form-control" value="'.$f["Cod_producto"].'" name="Cod_producto" id="codigoImput" placeholder="Código del producto" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="NombreProdImput">Nombre del producto</label>
                    <input type="text" class="form-control" value="'.$f["Nombre_producto"].'" readonly="readonly" name="NombreProd" id="NombreProdImput" placeholder="Nombre del producto" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="cantidadImput">Cantidad del producto</label>
                    <input type="number" class="form-control" value="'.$f["Cantidad_producto"].'" name="Cantidad_producto" id="cantidadImput" placeholder="Cantidad del producto" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="ValorImput">Valor unitario del producto</label>
                    <input type="number" class="form-control" value="'.$f["Valor_producto"].'" readonly="readonly" name="valorUni" id="ValorImput" placeholder="Precio del producto" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="metodoImput">Método de pago</label>
                    <select class="form-control" name="id_forma_pago" id="metodoImput" required>
                      <option value="'.$f["ID_forma_pago"].'" selected>'.$f["Nombre_forma_pago"].'</option>
                      <option value="1">Efectivo</option>
                      <option value="2">Daviplata</option>
                      <option value="3">Nequi</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="garantiaImput">Garantía</label>
                    <input type="number" class="form-control" value="'.$f["Garantia"].'" name="garantia" id="garantiaImput" placeholder="Garantía en días (opcional)">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="SubtotalImput">Subtotal</label>
                    <input type="number" class="form-control" value="'.$f["Subtotal"].'" readonly="readonly" name="subtotal" id="SubtotalImput" placeholder="Subtotal de la venta (sin iva)" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="IvaImput">Iva</label>
                    <input type="number" class="form-control" value="'.$f["Iva"].'" readonly="readonly" name="iva" id="IvaImput" placeholder="Iva aplicado" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="totalImput">Total</label>
                    <input type="number" class="form-control" value="'.$f["Total_venta"].'" readonly="readonly" name="total" id="totalImput" placeholder="Valor total (iva incluido)" required>
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

  function verFactura(){
    $objetoConsultas = new consultasVendedor();
    $ID_factura = $_GET['ID_factura'];
    $result = $objetoConsultas->buscarVentaVendedor($ID_factura);

    foreach ($result as $f) ;
    echo'
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-3 invoice-col">
            <strong>Empleado</strong>
            <address>
              <p>'.$f["Nombres_empleado"].'</p>
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-3 invoice-col">
            <strong>Cliente</strong>
            <address>
              <p>'.$f["Nombres_cliente"].'</p>
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-3 invoice-col">
            <strong>No. de factura</strong> <br>
            <p>'.$f["ID_factura"].'</p>
          </div>
          <div class="col-sm-3 invoice-col">
            <strong>Fecha y hora</strong> <br>
            <p>'.$f["Fecha_compra"].'</p>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio (c/u)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>'.$f["Cod_producto"].'</td>
                  <td>'.$f["Nombre_producto"].'</td>
                  <td>'.$f["Cantidad_producto"].'</td>
                  <td>$'.$f["Valor_producto"].'</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <!-- accepted payments column -->
      ';
      switch ($f["ID_forma_pago"]) {
        case 1:
          echo '
            <div class="col-6">
              <strong>Metodo de pago</strong> <br>
                <section style="display: flex; align-items: baseline;">
                  <div style="margin-left: 5%"> <img src="../img/metodos/efectivo.png" alt="Logo de efectivo"> </div>
                  <!-- <div> <p>'.$f["Nombre_forma_pago"].'</p> </div> -->
                </section>
            </div>';
        break;
        case 2:
          echo '
            <div class="col-6">
              <strong>Metodo de pago</strong> <br>
                <section style="display: flex; align-items: baseline;">
                  <div> <img src="../img/metodos/daviplata.png" alt="Logo de daviplata"> </div>
                  <!-- <div> <p>'.$f["Nombre_forma_pago"].'</p> </div> -->
                </section>
            </div>';
        break;
        case 3:
          echo '
            <div class="col-6">
              <strong>Metodo de pago</strong> <br>
                <section style="display: flex; align-items: baseline;">
                  <div style="margin-left: 2%"> <img src="../img/metodos/nequi.png" alt="Logo de nequi"> </div>
                  <!-- <div> <p>'.$f["Nombre_forma_pago"].'</p> </div> -->
                </section>
            </div>';
        break;
      }
      echo '
          <!-- /.col -->
          <div style="border-top: 1px solid #dee2e6;" class="col-6">

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>$'.$f["Subtotal"].'</td>
                </tr>
                <tr>
                  <th>Iva:</th>
                  <td>$'.$f["Iva"].'</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>$'.$f["Total_venta"].'</td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-12">
            <a href="factura-print.php?ID_factura='.$f["ID_factura"].'" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i>Imprimir</a>
          </div>
        </div>
      </div>
    ';
  }
?>