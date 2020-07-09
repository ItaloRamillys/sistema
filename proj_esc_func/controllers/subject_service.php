<?php
require "autoload.php";

use Helpers\Message;

class SubjectService{

	private $conn;
	private $subject;
	private $message;

	public function __construct(Connection $conn, Subject $subject){
		$this->conn = $conn->connect();
		$this->subject = $subject;
	}

	public function insert(){
		$query = "insert into subject(name_subject, code_subject) values(:name_subject, :code_subject)";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindValue(':name_subject', $this->subject->__get('name_subject'));
    	$stmt->bindValue(':code_subject', $this->subject->__get('code_subject'));

    	$this->message = new Message();

		if($stmt->execute()){
			$text = 'Disciplina cadastrada com sucesso.';
			$this->message->success($text);
		}else{
			$text = 'Falha ao cadastrar disciplina. Verifique se o código da disciplina já está em uso.';
			$this->message->error($text);
		}
		return $this->message->render();
	}

	public function delete(){

	}

	public function update(){

	}

	public function select(){

	}
}

?>