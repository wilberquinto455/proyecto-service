<?php
    function usuario(){
        $objetoConsultas = new consultasVendedor();
        $arreglo = $objetoConsultas->perfilVendedor();
        
        foreach ($arreglo as $f) {
            switch ($f['Genero']) {
                case 'Masculino':
                    echo '
                        <div class="image">
                            <a href="perfilUsuario.php"><img src="../img/perfil/Masculino.png" class="img-circle" alt="User Image" style="box-shadow: 0px 3px 5px #ffffffb3;"></a>
                        </div>';
                    break;
                case 'Femenino':
                    echo '
                        <div class="image">
                            <a href="perfilUsuario.php"><img src="../img/perfil/Femenino.png" class="img-circle" alt="User Image" style="box-shadow: 0px 3px 5px #ffffffb3;"></a>
                        </div>';
                    break;
                case 'Otro':
                    echo '
                        <div class="image">
                            <a href="perfilUsuario.php"><img src="../img/perfil/Otro.png" class="img-circle" alt="User Image" style="box-shadow: 0px 3px 5px #ffffffb3;"></a>
                        </div>';
                    break;
            }
        }
        echo '<div class="info">
                <a href="perfilUsuario.php" class="d-block">'.$f['Nombres_empleado'].'</a>
            </div>';
    }
    function cargarPerfil(){
        $objetoConsultas = new consultasVendedor();
        $arreglo = $objetoConsultas->perfilVendedor();
        
        foreach ($arreglo as $f){
            echo '
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3>'.$f["Nombres_empleado"].' '.$f["Apellidos_empleado"].'</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Datos personales</h5>
                            <ul style="list-style: none">
                                <li><strong>Documento de identidad: </strong>'.$f["Tipo_documento"].' - '.$f["No_documento_empleado"].'</li>
                                <li><strong>Numero celular:  </strong>'.$f["Celular_empleado"].'</li>
                                <li><strong>Numero telefono fijo: </strong>'.$f["Telefono_fijo_empleado"].'</li>
                                <li><strong>Dirección: </strong>'.$f["Direccion_empleado"].'</li>
                                <li><strong>Email: </strong>'.$f["Correo_empleado"].'</li>
                                <li><strong>Genero: </strong>'.$f["Genero"].'</li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <h5>Datos Laborales</h5>
                            <ul style="list-style: none">
                                <li><strong>Id en el sistema: </strong>'.$f["ID_empleado"].'</li>    
                                <li><strong>EPS: </strong>'.$f["Eps"].'</li>
                                <li><strong>Caja de compensación: </strong>'.$f["Caja_compensacion"].'</li>
                                <li><strong>ARL: </strong>'.$f["Arl"].'</li>
                                <li><strong>Fondo de pensiones: </strong>'.$f["Fondo_pension"].'</li>
                                <li><strong>Rol: </strong>'.$f["Rol"].'</li>
                                <li><strong>Estado: </strong>'.$f["Nombre_estado"].'</li>
                                <li><strong>Sueldo: </strong>$'.$f["Sueldo"].'</li>
                            </ul>
                        </div>                   
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-danger" href="perfilUpdateVendedor.php">Modificar perfil</a>
                </div>
            </div>
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h5 class="m-0">Cambiar Contraseña</h5>
                </div>
                <form action="../../controller/updateClaveVendedor.php" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6" style="display: none">
                                <label for="idEmpImput">ID_empleado</label>
                                <input type="number" name="id_empleado" value="'.$f["ID_empleado"].'" class="form-control" id="idEmpImput" placeholder="No. de docuemento">
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
    function CargarInfoPerfil(){
        $objetoConsultas = new consultasVendedor();
        $arreglo = $objetoConsultas->perfilVendedor();

        foreach ($arreglo as $f) {
            echo'
            <form action="../../controller/updatePerfilVendedor.php" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6" style="display:none">
                            <label for="idEmpImput">Id en el sistema</label>
                            <input type="number" name="id_empleado" value="'.$f["ID_empleado"].'" class="form-control" id="idEmpImput" placeholder="No. de docuemento" readonly="readonly">
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
                            <label for="documentoimput">No. Documento</label>
                            <input type="number" name="numDoc" readonly value="'.$f["No_documento_empleado"].'" class="form-control" id="documentoimput" placeholder="No. de docuemento" required>
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
                            <label for="generoImput">Genero</label>
                            <select class="form-control" name="genero" id="generoImput" required>
                                <option value="'.$f["Genero"].'" >'.$f["Genero"].'</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
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