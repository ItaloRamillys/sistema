<?php 

class News{
	private $id_news;
	private $title;
	private $description;
	private $img_news;
	private $author;
	private $create_at;
	private $update_at;
	
	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}	

		
?>