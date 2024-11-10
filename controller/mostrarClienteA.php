<?php
  function cargarCliente(){

    $objetoConsultas = new ConsultasA();
    $arreglo = $objetoConsultas->mostrarClientes();

    if (!isset($arreglo)) {
      echo '<h2>No hay clientes registrados en el sistema</h2>';
    } else {
      echo '
        <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No. de documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Email</th>
            <th>Celular</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        ';

      foreach ($arreglo as $f) {
        if ($f["ID_cliente"] != 1) {

          echo'
          <tr>
            <td> '.$f["ID_cliente"].' </td>
            <td> '.$f["Nombres_cliente"].' </td>
            <td> '.$f["Apellidos_cliente"].' </td>
            <td> '.$f["Direccion_cliente"].' </td>
            <td> '.$f["Correo_cliente"].' </td>
            <td> '.$f["Celular_cliente"].' </td>
            <td> '.$f["Nombre_estado"].' </td>
            <td style="width: 90px; min-width: 90px"> 
              <a href="verInfoCliente.php?id_cliente='.$f["ID_cliente"].'" class="btn btn-success"><i class="fas fa-edit"></i></a>
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
                  location.href="../../controller/eliminarClienteA.php?id_cliente='.$f["ID_cliente"].'";
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
          <th>No. de documento</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Dirección</th>
          <th>Email</th>
          <th>Celular</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </tfoot>
      </table>
      ';
    }
  }
  function cargarInfoCliente(){

    $objetoConsultas = new consultasA();
    $id_cliente = $_GET['id_cliente'];
    $result = $objetoConsultas->buscarCliente($id_cliente);

    foreach ($result as $f){
      echo'
      <form action="../../controller/updateClienteA.php" method="POST">
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="docImput">No. De documento</label>
              <input type="number" name="documento" readonly="readonly" value="'.$f["ID_cliente"].'" class="form-control" id="docImput" placeholder="No. de documento" required>
            </div>
            <div class="form-group col-md-6">
              <label for="nombresImput">Nombres</label>
              <input type="text" name="nombres" value="'.$f["Nombres_cliente"].'" class="form-control" id="nombresImput" placeholder="Nombres completos" required>
            </div>
            <div class="form-group col-md-6">
              <label for="apellidosImput">Apellidos</label>
              <input type="text" name="apellidos" value="'.$f["Apellidos_cliente"].'" class="form-control" id="apellidosImput" placeholder="Apellidos completos" required>
            </div>
            <div class="form-group col-md-6">
              <label for="direccionImput">Dirección</label>
              <input type="text" name="direccion" value="'.$f["Direccion_cliente"].'" class="form-control" id="direccionImput" placeholder="Direccion de residencia" required>
            </div>
            <div class="form-group col-md-6">
              <label for="emailImput">Email</label>
              <input type="email" name="email" value="'.$f["Correo_cliente"].'" class="form-control" id="emailImput" placeholder="Email" required>
            </div>
            <div class="form-group col-md-6">
              <label for="telefonoImput">Celular</label>
              <input type="number" name="celular" value="'.$f["Celular_cliente"].'" class="form-control" id="celularImput" placeholder="No. de celular" required>
            </div>
            <div class="form-group col-md-6">
              <label for="telefonoImput">Teléfono</label>
              <input type="number" name="telefono" value="'.$f["Telefono_fijo_cliente"].'" class="form-control" id="telefonoImput" placeholder="No. de teléfono fijo (opcional)">
            </div>
            <div class="form-group col-md-6">
              <label for="estadoImput">Estado</label>
              <select class="form-control" name="estado"  id="estadoImput" required>
                <option value="'.$f["ID_estado"].'" >'.$f["Nombre_estado"].'</option>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
                <option value="3">Bloqueado</option>
              </select>
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