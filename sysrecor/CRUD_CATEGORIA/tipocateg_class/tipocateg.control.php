<?php
class tipocateg
{
	private $nomCat;
	private $descr_cat;
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}