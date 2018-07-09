<?php
class Matricula
{
	private $idmatricula;
	private $fecha;
	private $valorMatr;
	private $NomAcudiente;
	private $telAcudiente;
	private $edadAlumno;
	private $estado;
	private $idabonos;
	private $Documento;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}