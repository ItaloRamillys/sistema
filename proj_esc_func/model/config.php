<?php

class Config{
	private $title_site;
	private $img_school;
	private $img_featured_1;
	private $img_featured_2;
	private $img_featured_3;
	private $txt_img_featured_1;
	private $txt_img_featured_2;
	private $txt_img_featured_3;
	private $desc_school;
	private $phone_school_1;
	private $phone_school_2;
	private $phone_school_3;
	private $img_local;
	private $style;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>