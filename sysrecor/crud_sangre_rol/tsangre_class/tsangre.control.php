<?php
class tsangre
{
	private $codTsangre;
	private $nombreCompleto;


	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}