<?php
class DatosPersonales
{
	private $Documento;
	private $PrimerNombre;
	private $SegundoNombre;
	private $P_apellido;
	private $S_apellido;
	private $direccion;
	private $telefono;
	private $cod_doc;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}