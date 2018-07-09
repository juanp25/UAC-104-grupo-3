<?php
class Grafico
{
	private $idgrafico;
	private $nomGragico;
	private $imagen;
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}