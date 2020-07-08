<?php 

class News{
	private $id_news;
	private $title_news;
	private $slug_news;
	private $desc_news;
	private $img_news;
	private $author_news;
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