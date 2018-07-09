<?php
class Abono
{
	private $idabonos;
	private $valorAbono;
	private $saldo;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}