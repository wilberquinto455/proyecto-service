<?php
  function cargarVentaC(){

      $objetoConsultas = new consultasE();
      $arreglo = $objetoConsultas->mostrarVentasC();

      //isset es para saber si existe algun dato en result
      if (!isset($arreglo)) {
        echo '<h2>No hay facturas registradas en el sistema</h2>';
      } else {
          echo '
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID factura</th>
                    <th>Fecha / Hora</th>
                    <th>Nombres del empleado</th>
                    <th>Nombres del cliente</th>
                    <th>Forma de pago</th>
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
                  <td>
                  <a href="factura.php?ID_factura='.$f["ID_factura"].'" class="btn btn-info"><i class="fas fa-eye"></i></a>
                  </td>
              </tr>';
          }
          echo '
          </tbody>
                <tfoot>
                  <tr>
                    <th>ID factura</th>
                    <th>Fecha / Hora</th>
                    <th>Nombres empleado</th>
                    <th>Nombres cliente</th>
                    <th>Forma de pago</th>
                    <th>Total de venta</th>
                    <th>Acciones</th>
                  </tr>
                </tfoot>
              </table>
          ';
      }
  }

  function verFacturaC(){
    $objetoConsultas = new consultasE();
    $ID_factura = $_GET['ID_factura'];
    $result = $objetoConsultas->buscarVentaC($ID_factura);

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
            <strong>No. factura</strong> <br>
            <p>'.$f["ID_factura"].'</p>
          </div>
          <div class="col-sm-3 invoice-col">
            <strong>Fecha y Hora</strong> <br>
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
                  <th>ID</th>
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