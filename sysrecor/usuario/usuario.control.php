<?php
class Usuario
{
	private $correo;
	private $clave;	
	private $nomRol;
	private $Documento;
	
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}