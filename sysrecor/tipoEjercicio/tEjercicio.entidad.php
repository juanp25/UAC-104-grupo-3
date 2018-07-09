<?php
class TEjercicio
{
	private $nom_tip;
	private $descrEjer;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}