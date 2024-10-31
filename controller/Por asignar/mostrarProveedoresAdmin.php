<?php
  function cargarProveedores(){
    //Se llaman los datos
    $objetoConsultas = new consultasA();
    $arreglo = $objetoConsultas->mostrarProveedores();

    //isset = Establecido
    //Lo que existe en result esta establecido?
    if (!isset($arreglo)) {
        echo '<h2>No hay proveedores registrados en el sistema</h2>';
    } else {
      //Vista resumen
      echo '
      <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nit</th>
              <th>Nombre empresa</th>
              <th>Teléfono empresa</th>
              <th>Direccion empresa</th>
              <th>Nombre contacto</th>
              <th>Teléfono contacto</th>
              <th>Email contacto</th>
              <th>Ver/Editar</th>
            </tr>
            </thead>
            <tbody>
      ';
      //Se repiten los registros del arreglo f en las filas y columnas
      foreach ($arreglo as $f){
        echo '
        <tr>
            <td> '.$f["Nit_proveedor"].'  </td>
            <td> '.$f["Nombre_proveedor"].' </td>
            <td> '.$f["Telefono_proveedor"].'  </td>
            <td> '.$f["Direccion_proveedor"].'  </td>
            <td> '.$f["Nombre_contacto"].'  </td>
            <td> '.$f["Telefono_contacto"].'  </td>
            <td> '.$f["Correo_contacto"].'  </td>
            <td style="width: 90px; min-width: 90px">
              <a href="verInfoProveedor.php?nit_proveedor='.$f["Nit_proveedor"].'" class="btn btn-success"><i class="fas fa-edit"></i></a>
              <button class="btn btn-danger" onclick="confirmarBorrar()"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
          <script type="text/javascript">
            function confirmarBorrar(){
              Swal.fire({
                title: "Seguro que quieres eliminar este proveedor?",
                text: "No podrás revertir esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#dc3545",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar"
              }).then((result) => {
                if (result.isConfirmed) {
                  location.href="../../controller/eliminarProveedorA.php?nit_proveedor='.$f["Nit_proveedor"].'";
                }
              })
            }
          </script>';
      }
      //Se trae la parte faltante de la tabla
      echo '
      </tbody>
            <tfoot>
            <tr>
              <th>Nit</th>
              <th>Nombre empresa</th>
              <th>Teléfono empresa</th>
              <th>Direccion empresa</th>
              <th>Nombre contacto</th>
              <th>Teléfono contacto</th>
              <th>Email contacto</th>
              <th>Ver/Editar</th>
            </tr>
            </tfoot>
          </table>
      ';
    }
  }
  //Formulario de modificacion
  function cargarInfoProveedores(){

    $objetoConsultas = new consultasA();
    //Capturamos la variable
    $nit_proveedor = $_GET['nit_proveedor'];
    //Enviamos la variable como argumento
    $result = $objetoConsultas -> buscarProveedor($nit_proveedor);
    //Llenamos la información en el formulario de edición
    foreach($result as $f){

      echo'
        <form action="../../controller/updateProveA.php" method="POST">
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="nitProvee">Nit del proveedor</label>
              <input type="number" name="nitProveedor" readonly="readonly" value="'.$f["Nit_proveedor"].'" class="form-control" id="nitProvee" placeholder="Nit de la empresa del proveedor" required>
            </div>
            <div class="form-group col-md-6">
              <label for="nombreEmpresa">Nombre de la empresa del proveedor</label>
              <input type="text" name="nombreEmpreProvee" value="'.$f["Nombre_proveedor"].'" class="form-control" id="nombresImput" placeholder="Nombre de la empresa" required>
            </div>
            <div class="form-group col-md-6">
              <label for="telefonoEmpreProv">Teléfono de la empresa del proveedor</label>
              <input type="number" name="telefonoEmpreProvee" value="'.$f["Telefono_proveedor"].'" class="form-control" id="telefonoEmpreProv" placeholder="Teléfono directo a la empresa" required>
            </div>
            <div class="form-group col-md-6">
              <label for="direccionProvee">Dirección de la empresa del proveedor</label>
              <input type="text" name="direccionEmpreProvee" value="'.$f["Direccion_proveedor"].'" class="form-control" id="direccionProvee" placeholder="Direccion principal de la empresa" required>
            </div>
            <div class="form-group col-md-6">
              <label for="nombreContacProvee">Nombre del contacto</label>
              <input type="text" name="nombreContProvee" value="'.$f["Nombre_contacto"].'" class="form-control" id="nombreContacProvee" placeholder="Nombre del principal contacto" required>
            </div>
            <div class="form-group col-md-6">
              <label for="telefonoInput">Teléfono del contacto</label>
              <input type="number" class="form-control" name="telefonoContProvee" value="'.$f["Telefono_contacto"].'" id="telefonoInput" placeholder="No. de teléfono del contacto" required>
            </div>
            <div class="form-group col-md-6">
              <label for="correoInput">Email del contacto</label>
              <input type="email" class="form-control" name="correoContProvee" value="'.$f["Correo_contacto"].'" id="correoInput" placeholder="email del contacto" required>
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