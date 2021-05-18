<?php
  include_once dirname( __DIR__ ) ."/vendor/autoload.php";
  // Creo un alias del namespace
  use MongoDB\Client as Mongo;

  class conexion
  {
    //Atributos
    private $conexion;
    private $configuracion = [
      'driver' => 'mongodb',
      'host' => '127.0.0.1',
      'port' => '27017',
      'database' => 'Estudiantes',
      'username' => 'admin',
      'password' => 'pass'
    ];

    //Metodos
    public function __construct()
    {
      $this->conexion;
      $this->configuracion;
    }

    public function conectar()
    {
      try {
        $CONTROLADOR = $this->configuracion['driver'];
        $SERVIDOR = $this->configuracion['host'];
        $PUERTO = $this->configuracion['port'];
        $BASE_DATOS = $this->configuracion['database'];
        $USUARIO = rawurlencode($this->configuracion['username']);
        $CLAVE = rawurlencode($this->configuracion['password']);

        $CADENA_CONEXION = sprintf("%s://%s:%s@%s:%s", $CONTROLADOR, $USUARIO, $CLAVE, $SERVIDOR, $PUERTO);

        //Se crea conexión.
        $this->conexion = new Mongo($CADENA_CONEXION);

        return $this->conexion->selectDatabase($BASE_DATOS);

      } catch (\Exception $exc) {
        echo $exc->getTraceAsString();
      }

    }
  }

?>
