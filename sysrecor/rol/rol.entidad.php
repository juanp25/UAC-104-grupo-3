<?php
class Rol
{
	private $nomRol;
	private $descrRol;
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}