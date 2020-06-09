<?php
require "autoload.php";

use Helpers\Message;

class AtividadeService{

	private $conexao;
	private $atividade;
	private $message;

	public function __construct(Conexao $conexao, Atividade $atividade){
		$this->conexao = $conexao->conectar();
		$this->atividade = $atividade;
	}

	public function insert(){

		$query = "insert into atividade(titulo_atv, desc_atv, path_file, referencias, id_resp, id_DT) values(:titulo_atv, :desc_atv, :path_file, :referencias, :id_resp, :id_DT)";
			
	    	$stmt = $this->conexao->prepare($query);

	    	$stmt->bindValue(':titulo_atv', $this->atividade->__get('titulo'));
	    	$stmt->bindValue(':desc_atv', $this->atividade->__get('descricao'));
	    	$stmt->bindValue(':path_file', $this->atividade->__get('arquivo'));
	    	$stmt->bindValue(':referencias', $this->atividade->__get('referencias'));
	    	$stmt->bindValue(':id_resp', $this->atividade->__get('id_resp'));
	    	$stmt->bindValue(':id_DT', $this->atividade->__get('id_DT'));

	    	$this->message = new Message();

			if($stmt->execute()){
				$text = 'Atividade cadastrada com sucesso.';
				$this->message->success($text);
			}else{
				$text = 'Falha ao cadastrar atividade.';
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