<?php
  include_once dirname( __DIR__ ) .'/bd/conexion_singleton.php';

  class estudianteModel
  {
    private $conexion;
    private $tabla;

    function __construct()
    {
      $this->conexion = conexion::getInstance()->getConnection(); //llama a la clase y se conecta
      $this->tabla = "Estudiantes";
    }

    public function collection()
    {
      try {
        $db = $this->conexion;
        $coleccion = $db->selectCollection($this->tabla);

        return $coleccion;

      } catch (\Exception $exc) {
        echo $exc->getTraceAsString();
      }

    }

    public function get()
    {
      $lista = self::collection();

      if ($lista->count() >  0) {

        $documentos = $lista->find();
        return $documentos;

      } else {

        return null;
      }

    }

    public function count_matricula_id($id)
    {
      $lista = self::collection();
      $condicion = ["Matricula.id" => "$id"];

      $documentos = $lista->count($condicion);

      return $documentos;
    }

    public function count_first($id)
    {
      $lista = self::collection();

      $condicion = array("_id" => new MongoDB\BSON\ObjectId($id));

      $documentos = $lista->count($condicion);
      return $documentos;
    }

    public function first($id)
    {
      $lista = self::collection();

      $condicion = array("_id" => new MongoDB\BSON\ObjectId($id));

      if (self::count_first($id) >  0) {

        $documentos = $lista->findOne($condicion);
        return $documentos;

      } else {

        return null;
      }

    }

    public function insert(estudiante $data)
    {
      try {
        $lista = self::collection();

        $nuevoEstudiante = array(
          "Nombre"=>$data->__GET('nombre'),
          "Apellido"=>$data->__GET('apellido'),
          "Edad"=>$data->__GET('edad'),
          "Genero"=>$data->__GET('genero'),
          "Matricula"=>array(
            "id"=>$data->__GET('matriculaId'),
            "año"=>$data->__GET('matriculaAño'),
            "nueva"=>$data->__GET('matriculaNueva'),
            "Renovada"=>$data->__GET('matriculaRenovada'),
          ),
      	);

        $registro = $lista->insertOne($nuevoEstudiante);

        $res = $registro->getInsertedCount();

        return $res;

      } catch (\Exception $exc) {
        echo $exc->getTraceAsString();
      }

    }

    public function update(estudiante $data, $id)
    {
      try {
        $lista = self::collection();

        $condicion = array("_id" => new MongoDB\BSON\ObjectId($id));

        $modiEstudiante =
      	[
          '$set' => [
        		"Nombre"=>$data->__GET('nombre'),
        		"Apellido"=>$data->__GET('apellido'),
        		"Edad"=>$data->__GET('edad'),
        		"Genero"=>$data->__GET('genero'),
        		"Matricula"=>array(
        			"id"=>$data->__GET('matriculaId'),
        			"año"=>$data->__GET('matriculaAño'),
        			"nueva"=>$data->__GET('matriculaNueva'),
        			"Renovada"=>$data->__GET('matriculaRenovada'),
            ),
          ],
        ];

        $registro = $lista->updateOne($condicion, $modiEstudiante);

        $res = $registro->getModifiedCount();

        return $res;

      } catch (\Exception $exc) {
        echo $exc->getTraceAsString();
      }

    }

    public function delete($id)
    {
      try {
        $lista = self::collection();

        $condicion = array("_id" => new MongoDB\BSON\ObjectId($id));

        if ($lista->count($condicion) ==  1) {

          $registro = $lista->deleteOne($condicion);

          $res = $registro->getDeletedCount();

          return $res;

        } else {

          return null;
        }

      } catch (Exception $exc) {
        echo $exc->getTraceAsString();
      }

    }

    public function remove()
    {
      try {
        $lista = self::collection();

        $registro = $lista->drop();

        return $registro;

      } catch (Exception $exc) {
        echo $exc->getTraceAsString();
      }
    }

    public function reset()
    {
      $this->conexion="";
    }
  }

?>
