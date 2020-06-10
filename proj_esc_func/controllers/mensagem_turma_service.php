<?php
require "autoload.php";

use Helpers\Message;

class MensagemTurmaService{

	private $conexao;
	private $mensagem_turma;
	private $message;

	public function __construct(Conexao $conexao, MensagemTurma $mensagem_turma){
		$this->conexao = $conexao->conectar();
		$this->mensagem_turma = $mensagem_turma;
	}

	public function insert(){

		$query = "insert into mensagem_turma(titulo, mensagem, id_DT) values(:titulo, :mensagem, :id_DT)";
			
	    	$stmt = $this->conexao->prepare($query);

	    	$stmt->bindValue(':titulo', $this->mensagem_turma->__get('titulo'));
	    	$stmt->bindValue(':mensagem', $this->mensagem_turma->__get('mensagem'));
	    	$stmt->bindValue(':id_DT', $this->mensagem_turma->__get('id_DT'));

	    	$this->message = new Message();

			if($stmt->execute()){
				$text = 'Mensagem cadastrada com sucesso.';
				$this->message->success($text);
			}else{
				$text = 'Falha ao cadastrar mensagem.';
				$this->message->error($text . implode("",$stmt->errorInfo()));
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