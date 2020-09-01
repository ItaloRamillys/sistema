<?php
require "autoload.php";

use Helpers\Message;
use Helpers\Log;

class SubjectService{

	private $conn;
	private $subject;
	private $message;
	private $log;

	public function __construct(Connection $conn, Subject $subject){
		$this->conn = $conn->connect();
		$this->subject = $subject;
	}

	public function insert(){
		$query = "insert into subject(name_subject, code_subject, id_author_insert) values(:name_subject, :code_subject, :id_author_insert)";
    	$stmt = $this->conn->prepare($query);

    	$stmt->bindValue(':name_subject', $this->subject->__get('name_subject'));
    	$stmt->bindValue(':code_subject', $this->subject->__get('code_subject'));
    	$stmt->bindValue(':id_author_insert', $this->subject->__get('id_author_insert'));

    	$this->message = new Message();
    	$text_log = "";

    	$this->log = new Log();
		if($stmt->execute()){

    		$this->log->setLog(
    							"i", 
    							"Disciplina", 
    							$this->subject->__get('id_author_insert'),
    							$this->subject->__get('name_subject'), 
    							date("d/m/Y H:m:i"), 
    							"s"
    						);
    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
    		if(!$bool){
    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor.";
    		}

			$text = 'Disciplina cadastrada com sucesso.' . $text_log;
			$this->message->success($text);
		}else{
			
			$this->log->setLog(
    							"i", 
    							"Disciplina", 
    							$this->subject->__get('id_author_insert'),
    							$this->subject->__get('name_subject'), 
    							date("d/m/Y H:m:i"), 
    							"f"
    						);
    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
    		if(!$bool){
    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor.";
    		}

			$text = 'Falha ao cadastrar disciplina. Verifique se o código da disciplina já está em uso.' . $text_log;
			$this->message->error($text);
		}
		return $this->message->render();
	}

	public function delete(){

	}

	public function update(){
		$id_up = $this->subject->__get('id_subject');

		$query = "update subject set name_subject = :name_subject, code_subject = :code_subject, id_author_update = :id_author_update where id_subject = " . $id_up;

    	$stmt = $this->conn->prepare($query);

    	$name_subject 	= $this->subject->__get('name_subject');
		$code_subject 		= $this->subject->__get('code_subject');
		$id_author_insert 		= $this->subject->__get('id_author_insert');

    	$stmt->bindParam(':name_subject', $name_subject, PDO::PARAM_STR); 
    	$stmt->bindParam(':code_subject', $code_subject, PDO::PARAM_STR); 
    	$stmt->bindParam(':id_author_update', $id_author_update, PDO::PARAM_INT); 

		$this->message = New Message();

    	if($stmt->execute()){
			$text = 'Disciplina editada com sucesso';
			$this->message->success($text);
		}else{
			$err = implode("", $stmt->errorInfo());
			$text = 'Falha ao editar Disciplina.';
			$this->message->error($text . " -> " . $err);
		}
		
		return $this->message->render();
	}

	public function select(){

	}
}

?>