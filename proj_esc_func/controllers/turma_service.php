<?php
require "autoload.php";

use Helpers\Message;

class TurmaService{

	private $conexao;
	private $turma;
	private $message;

	public function __construct(Conexao $conexao, Turma $tur){
		$this->conexao = $conexao->conectar();
		$this->turma = $tur;
	}

	public function insert(){

		$query = "insert into turma(nome_turma) values(:nome_turma)";
			
	    $stmt = $this->conexao->prepare($query);

		$stmt->bindValue(':nome_turma', $this->turma->__get('nome_turma'));

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