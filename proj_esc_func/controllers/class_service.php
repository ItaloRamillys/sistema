<?php
require "autoload.php";

use Helpers\Message;

class ClassService{
	private $conn;
	private $class;
	private $message;

	public function __construct(Connection $conn, ClassSchool $class){
		$this->conn = $conn->connect();
		$this->class = $class;
	}

	public function insert(){
		$query = "insert into class(name_class, room, year) values(:name_class, :room, :year)";
	    $stmt = $this->conn->prepare($query);

		$stmt->bindValue(':name_class', $this->class->__get('name_class'));
		$stmt->bindValue(':room', $this->class->__get('room'));
		$stmt->bindValue(':year', $this->class->__get('year'));

		$this->message = new Message();

		if($stmt->execute()){
			$text = 'Turma cadastrada com sucesso';
			$this->message->success($text);
		}else{
			$text = 'Falha ao cadastrar turma. Já existe uma turma com o nome cadastrado ou o nome inserido não segue o padrão.';
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