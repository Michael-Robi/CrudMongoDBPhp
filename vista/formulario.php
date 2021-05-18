<!DOCTYPE html>
<html lang="es-CL">
  <head>

    <?php
    	include_once dirname( __DIR__ ) .'/vista/head.php';
    ?>

  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    	<?php
    		include_once dirname( __DIR__ ) .'/vista/nav.php';
    	?>

    </nav>

    <div class="container">
     <div class="pt-4 pb-1 mt-auto">
      <div class="col-md-10 col-md-offset-1">

      <?php
        error_reporting(0);
        if (isset($_REQUEST['mensaje']))
        {
          $mensaje = $_GET["mensaje"];
          if ($mensaje == 1) {
              echo "<p class='btn btn-danger'><i class='fas fa-user-slash'></i> El Estudiante fue eliminado con éxito.</p><br>";
          }
          if ($mensaje == 2) {
              echo "<p class='btn btn-success'><i class='fas fa-user'></i> El Estudiante fue guardado con éxito.</p><br>";
          }
          if ($mensaje == 3) {
              echo "<p class='btn btn-warning'><i class='fas fa-user-cog'></i> El Estudiante fue modificado con éxito.</p><br>";
          }
          if ($mensaje == 4) {
              echo "<p class='btn btn-info'><i class='fas fa-users'></i> Estudiantes faker generados</p><br>";
          }
        }
      ?>

      <?php
        require_once("validarFormulario.php");

        if (isset($_REQUEST['action']))
        {
          $idRegistro = $_REQUEST['idRegistro'];
        }
      ?>

      <form class="form-group" action="?action=<?php echo $this->model->count_first($idRegistro) > 0 ? 'actualizar' : 'registrar'; ?>" method="post">

        <input type="hidden" name="idRegistro" id="idRegistro" class="form-control" value="<?= $registro["_id"]; ?>" placeholder="Id Estudiante" required/>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="inputNEst">Nombre</label>
          <div class="col-sm-10">
            <input type="text" name="nameEst" id="inputNEst" class="form-control" value="<?= $registro["Nombre"]; ?>" placeholder="Nombre del Estudiante" required/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="inputAEst">Apellidos</label>
          <div class="col-sm-10">
            <input type="text" name="ApeEst" id="inputAEst" class="form-control" value="<?= $registro["Apellido"]; ?>" placeholder="Apellido del Estudiante" required/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="inputEEst">Edad</label>
          <div class="col-sm-10">
            <input type="text" name="EdadEst" id="inputEEst" class="form-control" value="<?= $registro["Edad"]; ?>" placeholder="Edad del Estudiante" required/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="inputSEst">Genero</label>
          <div class="col-sm-10">
            <select name="GeneroEst" id="inputSEst" class="form-control" required>
              <option value="" disabled selected>Elige el genero...</option>
              <option value="Femenino" <?=selectorHTML($registro["Genero"],"Femenino");?>>Femenino</option>
              <option value="Masculino" <?=selectorHTML($registro["Genero"],"Masculino");?>>Masculino</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="inputMid">Id Matricula</label>
          <div class="col-sm-10">
            <input type="text" name="idMatri" id="inputMid" class="form-control" value="<?= $registro["Matricula"]["id"]; ?>" placeholder="Id de la Matricula" required/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="inputMaño">Año Matricula</label>
          <div class="col-sm-10">
            <input type="text" name="añoMatri" id="inputMaño" class="form-control" value="<?= $registro["Matricula"]["año"]; ?>" placeholder="Año de la Matricula" required/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="inputMNu">Nueva Matricula</label>
          <div class="col-sm-10">
            <input type="text" name="NuevMatri" id="inputMNu" class="form-control" value="<?= $registro["Matricula"]["nueva"]; ?>" placeholder="Id de la Nueva Matricula" required/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="inputMR">Matricula Renovada</label>
          <div class="col-sm-10">
            <input type="text" name="RenMatri" id="inputMR" class="form-control" value="<?= $registro["Matricula"]["Renovada"]; ?>" placeholder="Id de la Matricula Renovada" required/>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-default btn-primary">Guardar <i class="far fa-play-circle"></i></button>
            <button type="reset" class="btn btn-defaul btn-success">Limpiar <i class="fas fa-user-circle"></i></button>
          </div>
        </div>

      </form>

      </div>
     </div>
    </div>

  </body>
</html>
