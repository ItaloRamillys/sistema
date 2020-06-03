<?php 

class Noticia{


	private $id;
	private $titulo;
	private $slug;
	private $desc;
	private $path;
	private $autor;
	private $create_at;
	private $update_at;
	
	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}	

		
?>