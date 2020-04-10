<?php

class Turma{

	//private int $id_turma;
	private $nome_turma;
	private $ano;
	private $sala;
	private $dir_turma;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>