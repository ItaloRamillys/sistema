<?php

class RecorrenciaAula{
	private $dia_da_semana;
	private $horario_de_inicio;
	private $horario_de_termino;
	private $id_TD;	

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>