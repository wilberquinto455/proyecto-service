<?php 
  require_once("../../model/conexion.php");
  require_once("../../model/consultasA.php");
  require_once("../../controller/mostrarVentasA.php");
  
  require_once("../../controller/seguridadE.php");
  require_once("../../model/validarSesion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Factura | Uruz</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
              <div class="row">
                <div style="margin-bottom: 10px; border-bottom: 1px solid #dee2e6;" class="col-12">
                  <h3>
                    Comunicate SG &nbsp;<img style="min-width: 5%; max-width: 5%" src="../client-side/images/favicon.png" alt="Logo de la empresa/proyecto">
                  </h3>
                  <p style="font-size: 17px">Carrera 72 No. 63 A Sur, Barrio Perdomo<br>Nit: 4378845-9</p>
                </div>
                <!-- /.col -->
              </div>
            <!-- funcion para ver la factura -->
            <?php verFactura()?>


        <!-- /.invoice -->
      </div><!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
