<?php
class Pension
{
	private $idpension;
	private $mes;
	private $valor;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}