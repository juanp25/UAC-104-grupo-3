<?php
class Objetivos
{
	private $idobjetivo;
	private $objetivo;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}