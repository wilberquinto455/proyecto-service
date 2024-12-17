<?php

  function PreguntasQuejasReclamos(){

    $objetoConsultas = new consultasA();
    // Como en la public funtion mostrarPqr del consultas a se retornarosn dos variables
    // se crea una lista con dos variables para las dos que se retornaron
    // la primerea para todos los datos y la segunda para el contador
    list($arreglo, $arreglo1) = $objetoConsultas->mostrarPqr();

    foreach ($arreglo1 as $f1){
      if ($f1["COUNT(Vista_pqr)"] == 0) {
        echo '
          <div class="nav-link" data-toggle="dropdown" >
            <i class="far fa-bell"></i>
          </div>';
          echo '
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-width: 400px; min-width: 400px">
              <h3  class="media dropdown-header">Notificaciones</h3>
              <div class="dropdown-item">
                <div class="media">
                  <div class="media-body">
                    <div class="text-danger"><h4 style="text-align: center;">No hay nuevas notificaciones</h4></div>
                  </div>
                </div>
              </div>
              <a href="notificaciones.php" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
            </div>';
      } else {
        //ciclo para repetir los registros del arreglo f
        foreach ($arreglo1 as $f1){
          echo '
            <div class="nav-link" data-toggle="dropdown" >
              <i class="far fa-bell"></i>
              <span class="badge badge-danger navbar-badge">'.$f1["COUNT(Vista_pqr)"].'</span>
            </div>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-width: 400px; min-width: 400px">
              <h3 style="border-bottom: 0.5px solid #d3d3d3;" class="media dropdown-header">Notificaciones</h3>
            <div style="overflow-y:scroll; max-height:400px;">';
        }
        foreach($arreglo as $f){
          if ($f["Vista_pqr"] == "No") {
            echo '
              <div class="dropdown-item" style="border-bottom: 0.5px solid #d3d3d3;">
                <div class="media">
                  <div class="media-body">
                    <h3 class="dropdown-item-title"><strong>'.$f["Motivo_pqr"].'</strong> - '.$f["Nombres_pqr"].' '.$f["Apellidos_pqr"].' 
                      <span class="float-right text-sm text-danger">
                        <a class="Visto" href="../../controller/marcarVisto.php?id='.$f["ID_pqr"].'" style="padding: 10px;">
                        <i class="fas fa-check-circle"></i>
                        </a>
                      </span>
                    </h3>
                    <h2 class="dropdown-item-title">'.$f["Email_pqr"].'</h2>
                    <p class="text-sm" style="margin-top: 10px">'.$f["Mensaje_pqr"].'</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '.$f["Fecha_pqr"].'</p>
                  </div>
                </div>
              </div>';
          }
        }
        echo '
            </div>
              <a href="notificaciones.php" class="dropdown-item dropdown-footer" style="border-bottom: 0.5px solid #d3d3d3;">Ver todas las notificaciones</a>
              <a href="../../controller/marcarVisto.php?id=todo" class="dropdown-item dropdown-footer">Marcar todo como leído</a>
            </div>';
      }
    }
  }

  function PreguntasQuejas(){

    $objetoConsultas = new consultasA();
    list($arreglo, $arreglo1) = $objetoConsultas->mostrarPqr();

    if (!isset($arreglo)) {
      echo '<div class="text-danger"><h4 style="text-align: center;">No hay notificaciones.</h4></div>';
    } else {
      foreach($arreglo as $f){
        echo '
          <div class="col-lg-6">
            <form action="../../controller/updateViewPqr.php" method="POST">
              <div class="card card-danger card-outline" style="max-heigt">
                <div class="card-header">
                  <h5 class="m-0"> <strong>'.$f["Motivo_pqr"].'</strong> - '.$f["Fecha_pqr"].'</h5>
                </div>
                <div class="card-body">
                  <h6 class="card-title"><strong>'.$f["Nombres_pqr"].' '.$f["Apellidos_pqr"].'</strong> - '.$f["Email_pqr"].'</h6>
                  <br>
                  <p class="card-text">'.$f["Mensaje_pqr"].'</p>
                </div>
                <div class="card-footer">
                  <input style="display: none;" name="ID_pqr" value="'.$f["ID_pqr"].'"></input>';
        if ($f["Vista_pqr"] == "Si") {
          echo '
                  <button disabled type="submit" class="btn btn-danger">leída</button>
                </div>
              </div>
            </form>
          </div>';
        } else {
          echo '
                  <button type="submit" class="btn btn-danger">Marcar como leída</button>
                </div>
              </div>
            </form>
          </div>';
        }
      }
    }
  }
?>