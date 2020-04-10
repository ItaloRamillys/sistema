<?php

class TurmaAluno{

	//private int $id_turma;
	private $id_ta;
	private $id_turma;
	private $id_aluno;
	private $ano;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>