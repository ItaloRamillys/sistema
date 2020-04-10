<?php

class Configuracao{
	private $titulo;
	private $img_esc;
	private $img1;
	private $img2;
	private $img3;
	private $txt_img1;
	private $txt_img2;
	private $txt_img3;
	private $desc_esc;
	private $contato;
	private $local;


	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>