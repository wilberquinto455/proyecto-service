<?php

    function cargarPerfil() {
        $objetoConsultas = new consultasOperador();
        $arreglo = $objetoConsultas->perfil();

        foreach ($arreglo as $f) {
            echo '
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3>' . $f["Nombre"] . ' ' . $f["Apellido"] . '</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>Datos personales</h5>
                            <ul style="list-style: none">
                                <li><strong>Número celular:</strong> ' . $f["Celular_Corp"] . '</li>
                                <li><strong>Email:</strong> ' . $f["Email_Usuario"] . '</li>
                                <li><strong>Cargo:</strong> ' . $f["Cargo"] . '</li>
                                <li><strong>Rol:</strong> ' . $f["Rol"] . '</li>
                                <li><strong>Estado:</strong> ' . $f["Estado_User"] . '</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <a class="btn btn-danger" href="perfilUpdate.php">Modificar perfil</a>
            </div>

            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h5 class="m-0">Cambiar Contraseña</h5>
                </div>
                <form action="../../controller/Administrador/updateClaveA.php" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6" style="display: none">
                                <label for="idUserInput">ID User</label>
                                <input type="number" name="id_user" value="' . $f["ID_User"] . '" class="form-control" id="idUserInput" placeholder="ID">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="claveInput">Contraseña Actual</label>
                                <input type="password" class="form-control" name="clave" id="claveInput" placeholder="Contraseña Actual" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="clave1Input">Nueva Contraseña</label>
                                <input type="password" class="form-control" name="clave1" id="clave1Input" placeholder="Nueva Contraseña" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="clave2Input">Confirmar Nueva Contraseña</label>
                                <input type="password" class="form-control" name="clave2" id="clave2Input" placeholder="Confirmar Nueva Contraseña" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Cambiar</button>
                    </div>
                </form>
            </div>';
        }
    }

    function CargarInfoPerfil() {
        $objetoConsultas = new consultasOperador();
        $arreglo = $objetoConsultas->perfil();
    
        foreach ($arreglo as $f) {
            echo '
            <div>
                
                <form action="../../controller/Administrador/updatePerfilA.php" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <!-- ID del Usuario -->
                            <div class="form-group col-md-6" style="display: none">
                                <label for="idUserInput">ID Usuario</label>
                                <input type="number" name="id_user" value="' . $f["ID_User"] . '" class="form-control" id="idUserInput" readonly>
                            </div>
                            <!-- Nombres -->
                            <div class="form-group col-md-6">
                                <label for="nombresInput">Nombres</label>
                                <input type="text" name="nombres" value="' . $f["Nombre"] . '" class="form-control" id="nombresInput" placeholder="Nombres completos" required>
                            </div>
                            <!-- Apellidos -->
                            <div class="form-group col-md-6">
                                <label for="apellidosInput">Apellidos</label>
                                <input type="text" name="apellidos" value="' . $f["Apellido"] . '" class="form-control" id="apellidosInput" placeholder="Apellidos completos" required>
                            </div>
                            <!-- Número Celular -->
                            <div class="form-group col-md-6">
                                <label for="celularInput">Número Celular</label>
                                <input type="number" name="celular" value="' . $f["Celular_Corp"] . '" class="form-control" id="celularInput" placeholder="Número celular" required>
                            </div>
                            <!-- Email -->
                            <div class="form-group col-md-6">
                                <label for="emailInput">Email</label>
                                <input type="email" name="email" value="' . $f["Email_Usuario"] . '" class="form-control" id="emailInput" placeholder="Correo electrónico" required>
                            </div>
                            <!-- Cargo -->
                            <div class="form-group col-md-6">
                                <label for="cargoInput">Cargo</label>
                                <input type="text" name="cargo" value="' . $f["Cargo"] . '" class="form-control" id="cargoInput" placeholder="Cargo" readonly>
                            </div>
                            <!-- Rol -->
                            <div class="form-group col-md-6">
                                <label for="rolInput">Rol</label>
                                <input type="text" name="rol" value="' . $f["Rol"] . '" class="form-control" id="rolInput" placeholder="Rol" readonly>
                            </div>
                            <!-- Estado -->
                            <div class="form-group col-md-6">
                                <label for="estadoInput">Rol</label>
                                <input type="text" name="estado" value="' . $f["Estado_User"] . '" class="form-control" id="estadoInput" placeholder="Estado" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Actualizar Perfil</button>
                    </div>
                </form>
            </div>';
        }
    }
    
?>