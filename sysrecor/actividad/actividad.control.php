<?php
class Actividad
{
	private $idactividad;
	private $fecha;
	private $Comentario;
	private $duracion;
	private $nomCat;
	private $idgrafico;
	private $Documento;
	private $idobjetivo;
	private $idejercicio;


	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}