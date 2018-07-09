<?php
class Tdocumento
{
	private $cod_doc;
	private $nomDoc;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}