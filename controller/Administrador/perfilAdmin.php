<?php
    function usuario(){
        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas -> perfil();
        
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
                <a href="perfilUsuario.php" class="d-block">'.$f['Name'].'</a>
            </div>';
    }
    function cargarPerfil(){
        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas -> perfil();
        
        foreach ($arreglo as $f){
            echo '
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3>'.$f["Name"].' '.$f["Apellido"].'</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>Datos personales</h5>
                            <ul style="list-style: none">
                                <li><strong>Numero celular:  </strong>'.$f["Celular_Corp"].'</li>
                                <li><strong>Email: </strong>'.$f["Email_Usuario"].'</li>
                                <li><strong>Rol: </strong>'.$f["Rol"].'</li>
                                <li><strong>Estado: </strong>'.$f["Estado_User"].'</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-danger" href="perfilUpdate.php">Modificar perfil</a>
                </div>
            </div>
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h5 class="m-0">Cambiar Contraseña</h5>
                </div>
                <form action="../../controller/updateClaveA.php" method="POST">
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
        $objetoConsultas = new consultasA();
        $arreglo = $objetoConsultas->perfil();

        foreach ($arreglo as $f) {
            echo'
            <form action="../../controller/updatePerfilA.php" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6" style="display:none">
                            <label for="idEmpImput">ID del empleado</label>
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
            </div>
            ';
        }

    }
?>