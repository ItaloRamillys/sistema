<?php

class TurmaDisc{

	private $id_td;
	private $id_turma;
	private $id_disc;
	private $id_prof;
	private $ano;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>