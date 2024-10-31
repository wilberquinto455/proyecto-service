<?php

    function cargarEmpleados(){

        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas->mostrarEmpleadosA();

        //isset es para saber si existe algun dato en result
        if (!isset($arreglo)) {
            echo '<h2>No hay empleados registrados en el sistema</h2>';
        } else {
            // el nombre de los campos de la tabla
            echo '
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id en el sistema</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>No. de documento</th>
                      <th>Email</th>
                      <th>Celular</th>
                      <th>Rol</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

            ';
            //ciclo para repetir los registros del arreglo f
            foreach ($arreglo as $f){
              // los datos de la tabla traidos de consultasA con la funcion mostrarEmpleadosA
                echo '
                <tr>
                    <td> '.$f["ID_empleado"].' </td>
                    <td> '.$f["Nombres_empleado"].' </td>
                    <td> '.$f["Apellidos_empleado"].' </td>
                    <td> '.$f["No_documento_empleado"].' </td>
                    <td> '.$f["Correo_empleado"].' </td>
                    <td> '.$f["Celular_empleado"].' </td>
                    <td> '.$f["Rol"].' </td>
                    <td> '.$f["Nombre_estado"].' </td>
                    <td style="width: 90px; min-width: 90px"> 
                      <a href="verInfoEmpleado.php?id_empleado='.$f["ID_empleado"].'" class="btn btn-success"><i class="fas fa-edit"></i></a>
                      <button class="btn btn-danger" onclick="confirmarBorrar()"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                <script type="text/javascript">
                  function confirmarBorrar(){
                    Swal.fire({
                      title: "Seguro que quieres eliminar este empleado?",
                      text: "No podrás revertir esta acción!",
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#dc3545",
                      confirmButtonText: "Aceptar",
                      cancelButtonText: "Cancelar"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.href="../../controller/eliminarEmpleadoA.php?id_empleado='.$f["ID_empleado"].'";
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
                    <th>Id en el sistema</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>No. de documento</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    </tr>
                  </tfoot>
                </table>
            ';

        }
    }

    function cargarInfoEmpleado(){

      $objetoConsultas = new consultasA();
      $id_empleado = $_GET['id_empleado'];
      $result = $objetoConsultas->buscarEmpleado($id_empleado);

      foreach ($result as $f){
        echo'
        <form action="../../controller/updateEmpleadoA.php" method="POST">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="idEmpImput">Id en el sistema</label>
                      <input type="number" name="id_empleado" value="'.$f["ID_empleado"].'" class="form-control" id="idEmpImput" placeholder="" readonly="readonly">
                    </div>
                    <!-- a la opcion de "selciones una opcion" se le pone un valor vacio para que haga 
                    la comparacion en insertarUserA y no de error -->
                    <div class="form-group col-md-6">
                      <label for="tipoDocImput">Tipo de documento</label>
                      <select class="form-control" name="tipoDoc"  id="tipoDocImput" required>
                        <option value="'.$f["Tipo_documento"].'">'.$f["Tipo_documento"].' </option>
                        <option value="CC">CC</option>
                        <option value="CE">CE</option>
                        <option value="Pasaporte">Pasaporte</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="documentoimput">No. de Documento</label>
                      <input type="number" name="numDoc" readonly="readonly" value="'.$f["No_documento_empleado"].'" class="form-control" id="documentoimput" placeholder="No. de docuemento" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nombresImput">Nombres</label>
                      <input type="text" name="nombres" value="'.$f["Nombres_empleado"].'" class="form-control" id="nombresImput" placeholder="Nombres completos" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="apellidosImput">Apellidos</label>
                      <input type="text" name="apellidos" value="'.$f["Apellidos_empleado"].'" class="form-control" id="apellidosImput" placeholder="Apellidos completos" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="celularImput">Celular</label>
                      <input type="number" name="celular" value="'.$f["Celular_empleado"].'" class="form-control" id="celularImput" placeholder="No. de celular" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="telefonoImput">Teléfono</label> 
                      <input type="number" name="telefono" value="'.$f["Telefono_fijo_empleado"].'" class="form-control" id="telefonoImput" placeholder="No. teléfono fijo (opcional)">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="direccionImput">Dirección</label>
                      <input type="text" name="direccion" value="'.$f["Direccion_empleado"].'" class="form-control" id="direccionImput" placeholder="Dirección de residencia" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="emailImput">Email</label>
                      <input type="email" class="form-control" name="email" value="'.$f["Correo_empleado"].'" id="emailImput" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="epsImput">Eps</label>
                      <select class="form-control" name="eps" id="epsImput" required>
                        <option value="'.$f["Eps"].'">'.$f["Eps"].'</option>
                        <option value="Alian salud">Alian salud</option>
                        <option value="Cafam">Cafam</option>
                        <option value="Compensar">Compensar</option>
                        <option value="Confandi">Confandi</option>
                        <option value="Famisanar">Famisanar</option>
                        <option value="Nueva Eps">Nueva Eps</option>
                        <option value="Salud total">Salud total</option>
                        <option value="Sanitas">Sanitas</option>
                        <option value="Servicio ocidental">Servicio ocidental</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cajaCompensacionImput">Caja Compensación</label>
                      <select class="form-control" name="cajaCompensacion" id="cajaCompensacionImput" required>
                        <option value="'.$f["Caja_compensacion"].'" >'.$f["Caja_compensacion"].'</option>
                        <option value="Cafam">Cafam</option>
                        <option value="Cajasan">Cajasan</option>
                        <option value="Colsubsidio">Colsubsidio</option>
                        <option value="Concaja">Concaja</option>
                        <option value="Confacundi">Confacundi</option>
                        <option value="Compensar">Compensar</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="arlImput">ARL</label>
                      <select class="form-control" name="arl" id="arlImput" required>
                        <option value="'.$f["Arl"].'" >'.$f["Arl"].'</option>
                        <option value="Aurora">Aurora</option>
                        <option value="Axa colpatria">Axa colpatria</option>
                        <option value="Colmena">Colmena</option>
                        <option value="La equidad">La equidad</option>
                        <option value="Liberty seguros">Liberty seguros</option>
                        <option value="Mapfre">Mapfre</option>
                        <option value="Positiva">Positiva</option>
                        <option value="Seguros alfa">Seguros alfa</option>
                        <option value="Seguros bolivar">Seguros bolivar</option>
                        <option value="Sura">Sura</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="fondoImput">Fondo de pensiones</label>
                      <select class="form-control" name="fondoPension" id="fondoImput" required>
                        <option value="'.$f["Fondo_pension"].'" >'.$f["Fondo_pension"].'</option>
                        <option value="Colfondos">Colfondos</option>
                        <option value="Colpensiones">Colpensiones</option>
                        <option value="Old mutual">Old mutual</option>
                        <option value="Porvenir">Porvenir</option>
                        <option value="Protección">Protección</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="generoImput">Genero</label>
                      <select class="form-control" name="genero" id="generoImput" required>
                        <option value="'.$f["Genero"].'" >'.$f["Genero"].'</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="rolImput">Rol</label>
                      <select class="form-control" name="rol" id="rolImput" required>
                        <option value="'.$f["Rol"].'" >'.$f["Rol"].'</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Vendedor">Vendedor</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cargoImput">Estado</label>
                      <select class="form-control" name="estado" id="cargoImput" required>
                        <option value="'.$f["ID_estado"].'" >'.$f["Nombre_estado"].'</option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                        <option value="3">Bloqueado</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="sueldoImput">Sueldo</label>
                      <input type="number" class="form-control" name="sueldo" value="'.$f["Sueldo"].'" id="sueldoImput" placeholder="Sueldo mesual" required>
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