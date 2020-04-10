<?php

class Nota{
	private $id_DT;
	private $id_aluno;
	private $nota;
	private $periodo;
	private $create_at;


	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>