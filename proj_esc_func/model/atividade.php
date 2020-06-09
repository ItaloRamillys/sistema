<?php

class Atividade{
	private $titulo;
	private $descricao;
	private $referencias;
	private $id_resp;
	private $id_DT;
	private $arquivo;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>