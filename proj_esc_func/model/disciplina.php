<?php

class Disciplina{
	private $nome_disc;
	private $cod_disc;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>