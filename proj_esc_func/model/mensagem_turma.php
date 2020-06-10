<?php
class MensagemTurma{
	private $id_mt;
	private $tiutlo;
	private $mensagem;
	private $id_dt;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>