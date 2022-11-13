<?php
namespace Helpers;

class Message{

	private $text;
	private $type;

	public function getText(){
		return $this->text;
	}

	public function getType(){
		return $this->type;
	}

	public function success(string $message): Message
	{
		$this->type = 'success';
		$this->text = $message;
		return $this;
	}

	public function warning(string $message): Message
	{
		$this->type = 'warn';
		$this->text = $message;
		return $this;
	}

	public function error(string $message): Message
	{
		$this->type = 'error';
		$this->text = $message;
		return $this;
	}

	public function render(): string
	{
		return "<p class='msg msg-{$this->getType()}'>{$this->getText()}<i class='fas fa-times-circle icon-close'></i></p>";
	}

	public function filter(string $message): string
	{
		return filter_var($messagem, FILTER_SANITIZE_SPECIAL_CHARS);
	}
}

?>