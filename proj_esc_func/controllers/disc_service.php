<?php
require "autoload.php";

use Helpers\Message;

class DisciplinaService{

	private $conexao;
	private $disc;
	private $message;

	public function __construct(Conexao $conexao, Disciplina $disc){
		$this->conexao = $conexao->conectar();
		$this->disc = $disc;
	}

	public function insert(){

		$query = "insert into disciplina(nome_disc, cod_disc, id_esc) values(:nome_disc, :cod_disc, :id_esc)";
			
	    	$stmt = $this->conexao->prepare($query);

	    	session_start();
			$id_escola = $_SESSION['escola'];

	    	$stmt->bindValue(':nome_disc', $this->disc->__get('nome_disc'));
	    	$stmt->bindValue(':cod_disc', $this->disc->__get('cod_disc'));
	    	$stmt->bindValue(':id_esc', $id_escola);

	    	$this->message = new Message();

			if($stmt->execute()){
				$text = 'Disciplina cadastrada com sucesso';
				$this->message->success($text);
			}else{
				$text = 'Falha ao cadastrar disciplina';
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