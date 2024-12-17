<?php

    function cargarUsuarios(){

        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas->mostrarUsuariosA();

        //isset es para saber si existe algun dato en result
        if (!isset($arreglo)) {
            echo '<h2>No hay Usuarios registrados en el sistema</h2>';
        } else {
            // el nombre de los campos de la tabla
            echo '
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID Usuario</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Celular</th>
                      <th>Email</th>
                      <th>Cargo</th>
                      <th>Rol</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

            ';
            //ciclo para repetir los registros del arreglo f
            foreach ($arreglo as $f){
              // los datos de la tabla traidos de consultasA con la funcion mostrarUsuariosA
                echo '
                <tr>
                    <td> '.$f["ID_User"].' </td>
                    <td> '.$f["Nombre"].' </td>
                    <td> '.$f["Apellido"].' </td>
                    <td> '.$f["Celular_Corp"].' </td>
                    <td> '.$f["Email_Usuario"].' </td>
                    <td> '.$f["Cargo"].' </td>
                    <td> '.$f["Rol"].' </td>
                    <td> '.$f["Estado_User"].' </td>
                    <td style="width: 90px; min-width: 90px"> 
                      <a href="verInfoUsuario.php?Id_User='.$f["ID_User"].'" class="btn btn-success"><i class="fas fa-edit"></i></a>
                      <button class="btn btn-danger" onclick="confirmarBorrar()"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                <script type="text/javascript">
                  function confirmarBorrar(){
                    Swal.fire({
                      title: "Seguro que quieres eliminar este usuario?",
                      text: "No podrás revertir esta acción!",
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#dc3545",
                      confirmButtonText: "Aceptar",
                      cancelButtonText: "Cancelar"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.href="../../controller/Administrador/eliminarUsuarioA.php?Id_User='.$f["ID_User"].'";
                      }
                    })
                  }
              </script>';
            }
            // el nombre de los campos de la tabla
            echo '
            </tbody>
                  <tfoot>
                    <tr>
                      <th>ID Usuario</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Celular</th>
                      <th>Email</th>
                      <th>Cargo</th>
                      <th>Rol</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </tfoot>
                </table>
            ';

        }
    }

    function cargarInfoUsuario() {
      $objetoConsultas = new consultasA();
      $ID_User = $_GET['Id_User'];
      $result = $objetoConsultas->buscarUsuario($ID_User);
  
      // Conexión y consulta de los cargos, roles y estados
      $modelo = new conexion;
      $conexion = $modelo->get_conexion();
      
      // Consultas para obtener los cargos, roles y estados
      $consultaCargos = "SELECT * FROM cargos";
      $stmtCargos = $conexion->query($consultaCargos);
      $cargos = $stmtCargos->fetchAll(PDO::FETCH_ASSOC);
  
      $consultaRoles = "SELECT * FROM roles";
      $stmtRoles = $conexion->query($consultaRoles);
      $roles = $stmtRoles->fetchAll(PDO::FETCH_ASSOC);
  
      $consultaEstados = "SELECT * FROM estados_users";
      $stmtEstados = $conexion->query($consultaEstados);
      $estados = $stmtEstados->fetchAll(PDO::FETCH_ASSOC);
  
      // Iteramos sobre los resultados de la consulta de usuarios
      foreach ($result as $f) {
          echo '
          <form action="../../controller/administrador/updateUsuarioA.php" method="POST">
              <div class="card-body">
                  <div class="row">
                      <div class="form-group col-md-12">
                          <label for="idUserInput">Id en el sistema</label>
                          <input type="number" name="ID_User" value="'.$f["ID_User"].'" class="form-control" id="idUserInput" placeholder="" readonly="readonly">
                      </div>
  
                      <div class="form-group col-md-6">
                          <label for="nombreInput">Nombres</label>
                          <input type="text" name="nameIng" value="'.$f["Nombre"].'" class="form-control" id="nameUser" placeholder="Nombre completo del ingeniero" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="apellidoInput">Apellidos</label>
                          <input type="text" name="apellidoIng" value="'.$f["Apellido"].'" class="form-control" id="apellidoUser" placeholder="Apellido completo del ingeniero" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="celularInput">Celular Corporativo</label>
                          <input type="number" name="celularIng" value="'.$f["Celular_Corp"].'" class="form-control" id="celularUser" placeholder="No. de celular" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="emailInput">Correo Corporativo</label>
                          <input type="email" class="form-control" name="emailIng" value="'.$f["Email_Usuario"].'" id="emailUser" placeholder="Email" required>
                      </div>
  
                      <!-- Selección de Cargo -->
                      <div class="form-group col-md-4">
                          <label for="cargoInput">Cargo</label>
                          <select class="form-control" name="cargoIng" id="cargoUser" required>
                          <option value="'.$f["idCargo"].'">'.$f["Cargo"].'</option>';
                              // Mostrar las opciones de cargos desde la base de datos
                              foreach ($cargos as $cargo) {
                                  $selected = ($f["ID_Cargo"] == $cargo["ID_Cargo"]) ? 'selected' : '';
                                  echo '<option value="'.$cargo["ID_Cargo"].'" '.$selected.'>'.$cargo["Cargo"].'</option>';
                              }
                          echo '</select>
                      </div>
  
                      <!-- Selección de Rol -->
                      <div class="form-group col-md-4">
                          <label for="rolInput">Rol</label>
                          <select class="form-control" name="rolIng" id="rolUser" required>
                          <option value="'.$f["idRol"].'">'.$f["Rol"].'</option>';
                              // Mostrar las opciones de roles desde la base de datos
                              foreach ($roles as $rol) {
                                  $selected = ($f["ID_Rol"] == $rol["ID_Rol"]) ? 'selected' : '';
                                  echo '<option value="'.$rol["ID_Rol"].'" '.$selected.'>'.$rol["Rol"].'</option>';
                              }
                          echo '</select>
                      </div>
  
                      <!-- Selección de Estado -->
                      <div class="form-group col-md-4">
                          <label for="estadoInput">Estado</label>
                          <select class="form-control" name="estadoIng" id="estadoUser" required>
                          <option value="'.$f["idEstadoUser"].'">'.$f["estadoUser"].'</option>';
                              // Mostrar las opciones de estados desde la base de datos
                              foreach ($estados as $estado) {
                                  $selected = ($f["ID_Estado_Usuario"] == $estado["ID_Estado_Usuario"]) ? 'selected' : '';
                                  echo '<option value="'.$estado["ID_Estado_Usuario"].'" '.$selected.'>'.$estado["Estado_User"].'</option>';
                              }
                          echo '</select>
                      </div>
  
                  </div>
              </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-danger">Actualizar</button>
              </div>
          </form>';
      }
  }

?>