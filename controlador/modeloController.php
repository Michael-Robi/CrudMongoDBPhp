<?php
  include_once dirname( __DIR__ ) .'/modelo/estudianteModel.php';
  include_once dirname( __DIR__ ) .'/modelo/estudiante.php';
  include_once dirname( __DIR__ ) .'/vendor/autoload.php';

  class modeloController
  {
    private $model;
    private $faker;
    private $limiteDeRegistro;

    function __construct()
    {
      $this->model = new estudianteModel();
      $this->faker = Faker\Factory::create('es_VE');
      $this->limiteDeRegistro = array_merge(range(120, 1));
    }

    function validarRequest(&$value)
    {
      return isset($value) ? $value : "";
    }

    function data(){

      $idRegistro = self::validarRequest($_REQUEST['idRegistro']);
      $Nombre = self::validarRequest($_REQUEST['nameEst']);
      $Apellido = self::validarRequest($_REQUEST["ApeEst"]);
      $Edad = self::validarRequest($_REQUEST["EdadEst"]);
      $Genero= self::validarRequest($_REQUEST["GeneroEst"]);
      $MatriculaId= self::validarRequest($_REQUEST["idMatri"]);
      $MatriculaAño= self::validarRequest($_REQUEST["añoMatri"]);
      $MatriculaNueva= self::validarRequest($_REQUEST["NuevMatri"]);
      $MatriculaRenovada= self::validarRequest($_REQUEST["RenMatri"]);

      $registro = array(
        0 => $idRegistro,
        1 => $Nombre,
        2 => $Apellido,
        3 => $Edad,
        4 => $Genero,
        5 => $MatriculaId,
        6 => $MatriculaAño,
        7 => $MatriculaNueva,
        8 => $MatriculaRenovada,
      );

      return $registro;
    }

    function tabla()
    {
      $valCollection = $this->model->collection()->count();
      $documentos = $this->model->get();

      require_once("vista/tabla.php");
    }

    public function index(){
      require_once("vista/formulario.php");
      self::tabla();
    }

    public function editar(){
      $registro = $this->model->first(self::data()[0]);

      require_once("vista/formulario.php");
      self::tabla();
    }

    public function actualizar(){
      $estudiante = new estudiante();
      $estudiante->__SET('nombre',self::data()[1]);
      $estudiante->__SET('apellido',self::data()[2]);
      $estudiante->__SET('edad',self::data()[3]);
      $estudiante->__SET('genero',self::data()[4]);
      $estudiante->__SET('matriculaId',self::data()[5]);
      $estudiante->__SET('matriculaAño',self::data()[6]);
      $estudiante->__SET('matriculaNueva',self::data()[7]);
      $estudiante->__SET('matriculaRenovada',self::data()[8]);

      $respuesta = $this->model->update($estudiante, self::data()[0])+2;
      header("Refresh: 0; url=index.php?mensaje=$respuesta");

      $this->model->reset();
    }

    public function registrar(){
      $estudiante = new estudiante();

      $verificarId = $this->model->count_matricula_id(self::data()[5]);

      if($verificarId===0)
      {
        $estudiante->__SET('nombre',self::data()[1]);
        $estudiante->__SET('apellido',self::data()[2]);
        $estudiante->__SET('edad',self::data()[3]);
        $estudiante->__SET('genero',self::data()[4]);
        $estudiante->__SET('matriculaId',self::data()[5]);
        $estudiante->__SET('matriculaAño',self::data()[6]);
        $estudiante->__SET('matriculaNueva',self::data()[7]);
        $estudiante->__SET('matriculaRenovada',self::data()[8]);

        $respuesta =$this->model->insert($estudiante)+1;
        header("Refresh: 0; url=index.php?mensaje=$respuesta");
      }

      else
      {
        if((string)self::generar_id_matricula($this->limiteDeRegistro)!=1)
        {
          $estudiante->__SET('nombre',self::data()[1]);
          $estudiante->__SET('apellido',self::data()[2]);
          $estudiante->__SET('edad',self::data()[3]);
          $estudiante->__SET('genero',self::data()[4]);
          $estudiante->__SET('matriculaId',(string)self::generar_id_matricula($this->limiteDeRegistro));
          $estudiante->__SET('matriculaAño',self::data()[6]);
          $estudiante->__SET('matriculaNueva',self::data()[7]);
          $estudiante->__SET('matriculaRenovada',self::data()[8]);
          $respuesta =$this->model->insert($estudiante)+1;
        }
        else
        {
            $respuesta=4;
        }
        header("Refresh: 0; url=index.php?mensaje=$respuesta");
      }

      $this->model->reset();
    }

    public function eliminar(){
      $respuesta = $this->model->delete(self::data()[0]);
      header("Refresh: 0; url=index.php?mensaje=$respuesta");

      $this->model->reset();
    }

    public function faker(){

      foreach (range(1,50) as $index) {
        $idMatricula=self::generar_datos_aleatorio()[5];
        $verificarId = $this->model->count_matricula_id($idMatricula);

        $estudiante = new estudiante();
        $estudiante->__SET('nombre',self::generar_datos_aleatorio()[1]);
        $estudiante->__SET('apellido',self::generar_datos_aleatorio()[2]);
        $estudiante->__SET('edad',self::generar_datos_aleatorio()[3]);
        $estudiante->__SET('genero',self::generar_datos_aleatorio()[4]);
        $estudiante->__SET('matriculaId',$idMatricula);
        $estudiante->__SET('matriculaAño',self::generar_datos_aleatorio()[6]);
        $estudiante->__SET('matriculaNueva',self::generar_datos_aleatorio()[7]);
        $estudiante->__SET('matriculaRenovada',self::generar_datos_aleatorio()[8]);

        if($verificarId===0){
          $respuesta =$this->model->insert($estudiante)+1;
        }
        else{
          $respuesta = 4;
        }
      }

      header("Refresh: 0; url=index.php?mensaje=$respuesta");
      $this->model->reset();

    }

    function &generar_datos_aleatorio(){

      $edad = ["17","22","20","25","21","18","24","19","26","23","27"];
      $matriculaAño = ["2002","2006","2005","2003","2008","2009","2012","2001","2000","2004","2007","2010","2011"];

      $estudianteFaker = [
        1 => $this->faker->firstName.' '.$this->faker->firstName,
        2 => $this->faker->lastName.' '.$this->faker->lastName,
        3 => $edad[ mt_rand(0, count($edad) -1) ],
        4 => $this->faker->randomElement(["Masculino","Femenino"]),
        5 => (string)self::generar_id_matricula($this->limiteDeRegistro),
        6 => $this->faker->randomElement($matriculaAño),
        7 => $this->faker->randomElement(["1","0"]),
        8 => $this->faker->randomElement(["0","1"]),
      ];

      return $estudianteFaker;
    }

    function &generar_matricula_array(){
      $matriculaArray = array();

      if($this->model->get() != null){
        foreach ($this->model->get() as $doc) {
          $matriculaArray [] = $doc['Matricula']['id'];
        }
      }

      return $matriculaArray;
    }

    function &generar_id_matricula(&$rango){
      $faltaId = array_diff($rango,self::generar_matricula_array());

      $valor = 1;
      foreach ($faltaId as $id) {
        $valor = $id;
      }
      return $valor;
    }

    public function vaciar(){
      $respuesta = $this->model->remove();

      $this->model->reset();

      header("Refresh: 0; url=index.php");
    }
  }

?>
