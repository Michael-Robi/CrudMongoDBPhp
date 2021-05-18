<!DOCTYPE html>
<html lang="es-CL">
  <head>

    <?php
    	include_once dirname( __DIR__ ) .'/head.php';
    ?>

  </head>

  <body>

    <div class="container">
      <h3>Tabla de Estudiantes almacenados</h3>

      <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive">
          <table class="table table-striped table-bordered" id="MyTable">

            <thead>
              <tr class="tr-head">
                <th class="text-center">Estudiante</th>
                <th class="text-center">Edad</th>
                <th class="text-center">Genero</th>
                <th class="text-center">Id matricula</th>
                <th class="text-center">Año</th>
                <th class="text-center">Matricula nuevo</th>
                <th class="text-center">Matricula renovada</th>
                <th class="text-center" style="width: 100px;">Acciones</th>
              </tr>
            </thead>

            <tbody>
              <?php

                if ($valCollection > 0)
                {
                  foreach ($documentos as $documento) {
              ?>
              <tr>
                <td><?= $documento["Nombre"]." ".$documento["Apellido"] ?></td>
                <td><?= $documento["Edad"]; ?></td>
                <td><?= $documento["Genero"]; ?></td>
                <td><?= $documento["Matricula"]["id"]; ?></td>
                <td><?= $documento["Matricula"]["año"]; ?></td>
                <td><?= $documento["Matricula"]["nueva"]; ?></td>
                <td><?= $documento["Matricula"]["Renovada"]; ?></td>
                <td>
                  <a href="?action=editar&idRegistro=<?php echo $documento['_id']; ?>" class="btn btn-warning btn-xs" title="Actualizar"><i class="fas fa-user-edit"></i></a>
                  <a href="?action=eliminar&idRegistro=<?php echo $documento['_id'] ?>" class="btn btn-danger btn-xs" title="Eliminar"><i class="fas fa-user-times"></i></a>
                </td>
              </tr>
              <?php
                  }
                  $this->model->reset();
                }else{
              ?>
                <tr>
                  <td colspan="4"><h4><i class="icon-info-sign"></i> Sin registros en la Base de Datos</h4></td>
                </tr>
              <?php } ?>
            </tbody>

          </table>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="public/jquery/jquery-3.3.1.min.js"></script>

    <script type="text/javascript" src="public/popper/popper.min.js"></script>

    <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/datatables/datatables.min.js"></script>

    <script>
			$(document).ready(function() {
			 $('#MyTable').DataTable({
			    //para cambiar el lenguaje a español
			  "language": {
			    "lengthMenu": "Mostrar _MENU_ registros",
			    "zeroRecords": "No se encontraron resultados",
			    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
			    "sSearch": "Buscar:",
			    "oPaginate": {
			     "sFirst": "Primero",
			     "sLast":"Último",
			     "sNext":"Siguiente",
			     "sPrevious": "Anterior"
					},
				  "sProcessing":"Procesando...",
			  }
			 });
			});
		</script>

  </body>
</html>
