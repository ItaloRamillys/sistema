<?php

class Subject{
	private $id_subject;
	private $name_subject;
	private $code_subject;
	private $id_author_insert;
	private $id_author_update;
	private $created_at;
	private $updated_at;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>