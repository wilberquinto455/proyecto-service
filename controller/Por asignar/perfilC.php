<?php
    function usuarioC(){
        $objetoConsultas = new consultasE();
        $arreglo = $objetoConsultas->perfilC();
        
        foreach ($arreglo as $f) {
            echo '
                <div class="image">
                    <a href="perfilUsuario.php"><img src="../img/perfil/user.png" class="img-circle" alt="User Image" style="box-shadow: 0px 3px 5px #ffffffb3;"></a>
                </div>
                <div class="info">
                    <a href="perfilCliente.php" class="d-block">'.$f['Nombres_cliente'].'</a>
                </div>';
        }
        
    }
    function cargarPerfilC(){
        $objetoConsultas = new consultasE();
        $arreglo = $objetoConsultas->perfilC();
        
        foreach ($arreglo as $f){
            echo '
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3>'.$f["Nombres_cliente"].' '.$f["Apellidos_cliente"].'</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Datos personales</h5>
                            <ul style="list-style: none">
                                <li><strong>No. de documento: </strong>'.$f["ID_cliente"].'</li>
                                <li><strong>Dirección: </strong>'.$f["Direccion_cliente"].'</li>
                                <li><strong>Numero celular:  </strong>'.$f["Celular_cliente"].'</li>
                                <li><strong>Numero telefono fijo: </strong>'.$f["Telefono_fijo_cliente"].'</li>
                                <li><strong>Email: </strong>'.$f["Correo_cliente"].'</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-danger" href="perfilUpdateC.php">Modificar perfil</a>
                </div>
            </div>
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h5 class="m-0">Cambiar Contraseña</h5>
                </div>
                <form action="../../controller/updateClaveC.php" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6" style="display: none">
                                <label for="idEmpImput">ID_cliente</label>
                                <input type="number" name="id_cliente" value="'.$f["ID_cliente"].'" class="form-control" id="idEmpImput" placeholder="No. de docuemento">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="claveImput">Contraseña Actual</label>
                                <input type="Password" class="form-control" name="clave" id="claveImput" placeholder="Contraseña Actual" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="clave1Imput">Nueva Contraseña</label>
                                <input type="Password" class="form-control" name="clave1" id="clave1Imput" placeholder="Nueva Contraseña" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="clave2Imput">Confirmar Nueva Contraseña</label>
                                <input type="Password" class="form-control" name="clave2" id="clave2Imput" placeholder="Confirmar NuevaContraseña" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Cambiar</button>
                    </div>
                </form>
            </div>';
        }
    }
    function CargarInfoPerfilC(){
        $objetoConsultas = new consultasE();
        $arreglo = $objetoConsultas->perfilC();

        foreach ($arreglo as $f) {
            echo'
            <form action="../../controller/updatePerfilC.php" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="idEmpImput">No. de documento</label>
                            <input type="number" name="documento" value="'.$f["ID_cliente"].'" class="form-control" id="idEmpImput" placeholder="No. de docuemento" required readonly="readonly">
                        </div>
                        <!-- a la opcion de "selciones una opcion" se le pone un valor vacio para que haga 
                        la comparacion en insertarUserA y no de error -->
                        <div class="form-group col-md-6">
                            <label for="nombresImput">Nombres</label>
                            <input type="text" name="nombres" value="'.$f["Nombres_cliente"].'" class="form-control" id="nombresImput" placeholder="Nombres completos" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellidosImput">Apellidos</label>
                            <input type="text" name="apellidos" value="'.$f["Apellidos_cliente"].'" class="form-control" id="apellidosImput" placeholder="Apellidos completos" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="celularImput">Celular</label>
                            <input type="number" name="celular" value="'.$f["Celular_cliente"].'" class="form-control" id="celularImput" placeholder="No. de celular" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefonoImput">Teléfono</label> 
                            <input type="number" name="telefono" value="'.$f["Telefono_fijo_cliente"].'" class="form-control" id="telefonoImput" placeholder="No. teléfono fijo (opcional)">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="direccionImput">Dirección</label>
                            <input type="text" name="direccion" value="'.$f["Direccion_cliente"].'" class="form-control" id="direccionImput" placeholder="Dirección de residencia" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="emailImput">Email</label>
                            <input type="email" class="form-control" name="email" value="'.$f["Correo_cliente"].'" id="emailImput" placeholder="Email" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger">Actualizar</button>
                </div>
            </form>
            </div>
            ';
        }

    }
?>