<?php

class Frequencia{
	private $id_aluno;
	private $tipo_falta;
	private $data;
	private $id_DT;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>