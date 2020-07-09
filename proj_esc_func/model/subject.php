<?php

class Subject{
	private $id_subject;
	private $name_subject;
	private $code_subject;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>