<?php 

class User{
	private $id;
	//Caso seja aluno;
	private $matricula;
	private $resp1;
	private $resp2;
	private $cont_resp1;
	private $cont_resp2;
	private $obs;
	//----------------

	//Caso seja professor;
	private $salario;
	private $vencimento;
	private $formacao;
	private $descricao;
	//----------------
	
	private $login;
	private $senha;

	private $nome;
	private $sobrenome;
	private $data_nasc;
	private $tipo_sangue;
	private $genero;
	private $rg;
	private $cpf;
	private $email;
	private $id_resp_insert;
	private $id_resp_update;
	private $endereco;
	private $create_at;
	private $update_at;
	private $tipo;
	private $id_esc;
	private $img_profile;
	
	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}	

		
?>