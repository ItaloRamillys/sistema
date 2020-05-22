<?php

class Activity{
	private $title;
	private $image;
	private $description;
	private $comments;
	private $path_file;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>