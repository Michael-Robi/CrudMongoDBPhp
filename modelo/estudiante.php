<?php
  class estudiante
  {
    private $nombre;
    private $apellido;
    private $edad;
    private $genero;
    // private $matricula;
    private $matriculaId;
    private $matriculaAño;
    private $matriculaNueva;
    private $matriculaRenovada;

    //MÉTODOS MÁGICOS EN PHP

    public function __GET($valor)
    {
      return $this->$valor;
    }

    public function __SET($vari,$nue)
    {
      $this->$vari=$nue;
    }

  }
?>
