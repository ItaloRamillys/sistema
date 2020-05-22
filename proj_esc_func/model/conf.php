<?php

class Conf{
	private $title;
	private $img_school;
	private $img_featured_1;
	private $img_featured_2;
	private $img_featured_3;
	private $txt_img_1;
	private $txt_img_2;
	private $txt_img_3;
	private $description;
	private $phone;
	private $local;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>