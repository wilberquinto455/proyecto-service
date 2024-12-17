<?php
// Empresas
  function cargarEmpresas(){

    $objetoConsultas = new consultasOperador();
    $arreglo = $objetoConsultas->mostrarEmpresas();

    if (!isset($arreglo)) {
      echo '<h2>No hay clientes registrados en el sistema</h2>';
    } else {
      echo '
        <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID Empresa</th>
            <th>Nombre Empresa</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        ';

      foreach ($arreglo as $f) {
        if ($f["ID_Empresa"]) {

          echo'
          <tr>
            <td> '.$f["ID_Empresa"].' </td>
            <td> '.$f["Nombre"].' </td>

            <td style="width: 90px; min-width: 90px"> 
              <a href="verEmpresa.php?id_Empresa='.$f["ID_Empresa"].'" class="btn btn-success"><i class="fas fa-edit"></i></a>
              <button class="btn btn-danger" onclick="confirmarBorrar()"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          <script type="text/javascript">
            function confirmarBorrar(){
                Swal.fire({
                title: "Seguro que quieres eliminar este cliente?",
                text: "No podrás revertir esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#dc3545",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar"
              }).then((result) => {
                if (result.isConfirmed) {
                  location.href="../../controller/Administrador/eliminarEmpresaA.php?id_Empresa='.$f["ID_Empresa"].'";
                }
              })
            }
          </script>';
        }
      }

      echo '
      </tbody>
      <tfoot>
          <tr>
            <th>ID Empresa</th>
            <th>Nombre Empresa</th>
            <th>Acciones</th>
          </tr>
      </tfoot>
      </table>
      ';
    }
  }

  function cargarInfoEmpresa(){

    $objetoConsultas = new consultasOperador();
    $Id_Empresa = $_GET['id_Empresa'];
    $result = $objetoConsultas->buscarEmpresa($Id_Empresa);

    foreach ($result as $f){
      echo'
      <form action="../../controller/Administrador/updateEmpresa.php" method="POST">
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="idEmp">ID Empresa</label>
              <input type="number" name="idEmpresa" readonly="readonly" value="'.$f["ID_Empresa"].'" class="form-control" id="idEmp" placeholder="ID Empresa" required>
            </div>
            <div class="form-group col-md-6">
              <label for="nombreEmp">Nombre empresa</label>
              <input type="text" name="nombreEmp" value="'.$f["Nombre"].'" class="form-control" id="nombreEmpR" placeholder="Nombre empresa" required>
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

  // Clientes
  function cargarCliente(){

    $objetoConsultas = new consultasOperador();
    $arreglo = $objetoConsultas->mostrarClientes();

    if (!isset($arreglo)) {
      echo '<h2>No hay clientes registrados en el sistema</h2>';
    } else {
      echo '
        <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID Cliente</th>
            <th>Empresa</th>
            <th>Nombre Contacto</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        ';

      foreach ($arreglo as $f) {
        if ($f["ID_Cliente"]) {

          echo'
          <tr>
            <td> '.$f["ID_Cliente"].' </td>
            <td> '.$f["Nombre_Empresa"].' </td>
            <td> '.$f["Nombre_Contacto"].' </td>
            <td> '.$f["Email"].' </td>
            <td> '.$f["Celular_Contacto"].' </td>
            <td style="width: 90px; min-width: 90px"> 
              <a href="verInfoCliente.php?ID_Cliente='.$f["ID_Cliente"].'" class="btn btn-success"><i class="fas fa-edit"></i></a>
              <button class="btn btn-danger" onclick="confirmarBorrar()"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          <script type="text/javascript">
            function confirmarBorrar(){
                Swal.fire({
                title: "Seguro que quieres eliminar este cliente?",
                text: "No podrás revertir esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#dc3545",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar"
              }).then((result) => {
                if (result.isConfirmed) {
                  location.href="../../controller/Administrador/eliminarClienteA.php?Id_Cliente='.$f["ID_Cliente"].'";
                }
              })
            }
          </script>';
        }
      }

      echo '
      </tbody>
      <tfoot>
        <tr>
            <th>ID Cliente</th>
            <th>Empresa</th>
            <th>Nombre Contacto</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Acciones</th>
        </tr>
      </tfoot>
      </table>
      ';
    }
  }

  function cargarInfoCliente(){
      // Crear objeto de consultas y obtener ID del cliente desde GET
      $objetoConsultas = new consultasOperador();
      $id_cliente = $_GET['ID_Cliente'];
      $result = $objetoConsultas->buscarCliente($id_cliente);

      // Conexión y consulta de las empresas
      $modelo = new conexion();
      $conexion = $modelo->get_conexion();
      
      // Consultar todas las empresas
      $consultaEmpresas= "SELECT * FROM empresas_cliente";
      $stmtEmpresas = $conexion->query($consultaEmpresas);
      $Empresas = $stmtEmpresas->fetchAll(PDO::FETCH_ASSOC);

      // Recorrer los resultados del cliente
      foreach ($result as $f) {
          echo '
          <form action="../../controller/Administrador/updateClienteA.php" method="POST">
              <div class="card-body">
                  <div class="row">
                      <!-- ID Cliente (solo lectura) -->
                      <div class="form-group col-md-12">
                          <label for="idCli">ID Cliente</label>
                          <input type="number" name="idCliente" readonly="readonly" value="'.$f["ID_Cliente"].'" class="form-control" id="idCliR" placeholder="ID Cliente" required>
                      </div>
                      <!-- Selección de Empresa -->
                      <div class="form-group col-md-6">
                          <label for="empresaInput">Empresa</label>
                          <select class="form-control" name="empresa" id="empresaInputR" required>
                              <option value="'.$f["empID"].'">'.$f["empNombre"].'</option>';
                              // Mostrar las opciones de empresas desde la base de datos
                              foreach ($Empresas as $Empresa) {
                                  $selected = ($f["ID_Empresa"] == $Empresa["ID_Empresa"]) ? 'selected' : '';
                                  echo '<option value="'.$Empresa["ID_Empresa"].'" '.$selected.'>'.$Empresa["Nombre"].'</option>';
                              }
                          echo '</select>
                      </div>
                      <!-- Nombre del contacto -->
                      <div class="form-group col-md-6">
                          <label for="nombresInput">Nombre Contacto</label>
                          <input type="text" name="nombreContacto" value="'.$f["Nombre_Contacto"].'" class="form-control" id="nombresInputR" placeholder="Nombres completos" required>
                      </div>

                      <!-- Email del contacto -->
                      <div class="form-group col-md-6">
                          <label for="emailInput">Correo</label>
                          <input type="email" name="correo" value="'.$f["Email"].'" class="form-control" id="emailInput" placeholder="Email" required>
                      </div>

                      <!-- Celular del contacto -->
                      <div class="form-group col-md-6">
                          <label for="celularImput">Celular Contacto</label>
                          <input type="text" name="celularCon" value="'.$f["Celular_Contacto"].'" class="form-control" id="celularImput" placeholder="No. de celular" required>
                      </div>
                  </div>
              </div>
              <!-- /.card-body -->

              <!-- Botón de actualización -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-danger">Actualizar</button>
              </div>
          </form>
          ';
      }
  }

?>