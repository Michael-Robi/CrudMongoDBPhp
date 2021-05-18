<?php
  require_once("controlador/modeloController.php");

  $controlador = new modeloController();

  $metodo =  $controlador->validarRequest($_REQUEST['action']);

  if(method_exists($controlador,$metodo)){
    $controlador->{$metodo}();
  }

  else{
    $controlador->index();
  }
?>
