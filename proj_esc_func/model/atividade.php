<?php

class Atividade{
	private $titulo;
	private $img;
	private $descricao;
	private $referencias;
	private $path_file;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>