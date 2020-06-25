<?php
require "autoload.php";

use Helpers\Message;

class UsuarioService{

	private $conexao;
	private $usuario;
	private $message;

	public function __construct(Conexao $conexao, Usuario $usuario){
		$this->conexao = $conexao->conectar();
		$this->usuario = $usuario;
	}

	public function insert(){

			$erro = 0;
			$errors = 'Erro: ';

			$checkCpf   = $this->checkDuplicateData("usuario", 'cpf', $this->usuario->__get('cpf'));
			$checkEmail = $this->checkDuplicateData("usuario", 'email', $this->usuario->__get('email'));
			$checkLogin = $this->checkDuplicateData("usuario", 'login', $this->usuario->__get('login'));

			if(strlen($this->usuario->__get('senha'))<8 || strlen($this->usuario->__get('senha'))>16){
				$erro++;
				$errors .= ' A senha deve ter entre 8 e 16 caracteres';
			}
			if($checkCpf){
				$erro++;
				$errors .= ' CPF duplicado.';
			}
			if($checkEmail){
				$erro++;
				$errors .= ' Email duplicado.';
			}
			if($checkLogin){
				$erro++;
				$errors .= ' Login duplicado.';
			}

			$query = "insert into usuario(login, senha, nome, sobrenome, data_nasc, tipo_sangue, genero, cpf, endereco, email, tipo, id_resp_insert, img_profile) values(:usuario_login, :usuario_senha, :usuario_nome, :usuario_sobrenome, :usuario_data_nasc, :usuario_tipo_sangue, :usuario_genero, :usuario_cpf, :usuario_end, :usuario_email, :usuario_tipo, :id_resp_insert, :usuario_img_profile)";

	    	$stmt = $this->conexao->prepare($query);

	    	$stmt->bindValue(':usuario_login', 		$this->usuario->__get('login'));
	    	$stmt->bindValue(':usuario_senha', 		$this->usuario->__get('senha'));
	    	$stmt->bindValue(':usuario_nome', 		$this->usuario->__get('nome'));
	    	$stmt->bindValue(':usuario_sobrenome',  $this->usuario->__get('sobrenome'));
	    	$stmt->bindValue(':usuario_data_nasc',  $this->usuario->__get('data_nasc'));
	    	$stmt->bindValue(':usuario_tipo_sangue',$this->usuario->__get('tipo_sangue'));
	    	$stmt->bindValue(':usuario_genero',  	$this->usuario->__get('genero'));
	    	$stmt->bindValue(':usuario_cpf', 	    $this->usuario->__get('cpf'));
	    	$stmt->bindValue(':usuario_end', 	    $this->usuario->__get('end'));
	    	$stmt->bindValue(':usuario_email', 		$this->usuario->__get('email'));
	  	    $stmt->bindValue(':usuario_tipo', 		$this->usuario->__get('tipo'));
	  	    $stmt->bindValue(':id_resp_insert', 	$this->usuario->__get('id_resp_insert'));
	  	    $stmt->bindValue(':usuario_img_profile',$this->usuario->__get('img_profile'));

			$this->message = new Message();
			if($stmt->execute() && $erro == 0){
				$text = 'Usuário cadastrado com sucesso';
				$this->message->success($text);
			}else{
				$text = 'Falha ao cadastrar usuario. '.$errors;
				$this->message->error($text);
				unlink("C:/xampp/htdocs/sistema/img/".$this->usuario->__get('img_profile'));
			}

			return $this->message->render();
	}
	
	public function checkDuplicateData($model, $column, $data){
		$query = "select * from " . $model . " where " . $column . " = '" . $data . "'";
		
		$stmt = $this->conexao->query($query);
		
		$result = $stmt->fetchAll();

		return count($result);
	}

	public function delete(){

		$id_del = $this->usuario->__get('id');
		$email_del = $this->usuario->__get('email');
		$this->message = new Message();
		$id_to_del = $this->findByParam("email", "id");

		if(password_verify($id_to_del['id'], $id_del)){
			$query_update = "update usuario SET status = 0 where id = ".$id_to_del['id'];
			$query_delete = "delete from usuario where id = ".$id_to_del['id'];

			if($stmt->execute()){
					$text = "O usuario foi excluído com sucesso.";
					$this->message->success($text);
				}else {
					$text = "Falha ao excluir usuário";
					$this->message->error($text);
				}
			}
		return $this->message->render();	
	}
	

	public function update(){
		
			$id_up = $this->usuario->__get('id');

			$this->message = new Message();

			$has_comma = false;

			$array_inputs = [];

			$completa_query = "";

			if(!is_null($this->usuario->__get('img_profile'))){
				array_push($array_inputs, "img_profile");
				$completa_query .= " img_profile = :img_profile ";
				$has_comma = true;
				$array_post['img_profile'] = $this->usuario->__get('img_profile');
			}

			if(!is_null($this->usuario->__get('login'))){
				array_push($array_inputs, "login");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " login = :login ";
				$has_comma = true;
				$array_post['login'] = $this->usuario->__get('login');
			}

			if(!is_null($this->usuario->__get('senha'))){
				array_push($array_inputs, "senha");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " senha = :senha ";
				$has_comma = true;
				$array_post['senha'] = $this->usuario->__get('senha');
			}

			if(!is_null($this->usuario->__get('nome'))){
				array_push($array_inputs, "nome");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " nome = :nome ";
				$has_comma = true;
				$array_post['nome'] = $this->usuario->__get('nome');
			}

			if(!is_null($this->usuario->__get('sobrenome'))){
				array_push($array_inputs, "sobrenome");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " sobrenome = :sobrenome ";
				$has_comma = true;
				$array_post['sobrenome'] = $this->usuario->__get('sobrenome');
			}

			if(!is_null($this->usuario->__get('data_nasc'))){
				array_push($array_inputs, "data_nasc");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " data_nasc = :data_nasc ";
				$has_comma = true;
				$array_post['data_nasc'] = $this->usuario->__get('data_nasc');
			}

			if(!is_null($this->usuario->__get('tipo_sangue'))){
				array_push($array_inputs, "tipo_sangue");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " tipo_sangue = :tipo_sangue ";
				$has_comma = true;
				$array_post['tipo_sangue'] =$this->usuario->__get('tipo_sangue');
			}

			if(!is_null($this->usuario->__get('genero'))){
				array_push($array_inputs, "genero");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " genero = :genero ";
				$has_comma = true;
				$array_post['genero'] = $this->usuario->__get('genero');
			}

			if(!is_null($this->usuario->__get('cpf'))){
				array_push($array_inputs, "cpf");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " cpf = :cpf ";
				$has_comma = true;
				$array_post['cpf']  = $this->usuario->__get('cpf');
			}

			if(!is_null($this->usuario->__get('endereco'))){
				array_push($array_inputs, "endereco");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " endereco = :endereco ";
				$has_comma = true;
				$array_post['endereco'] = $this->usuario->__get('endereco');
			}

			if(!is_null($this->usuario->__get('email'))){
				array_push($array_inputs, "email");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " email = :email ";
				$has_comma = true;
				$array_post['email'] = $this->usuario->__get('email');
			}

			array_push($array_inputs, "id_resp_update");
			$completa_query .= ", id_resp_update = :id_resp_update ";
			$array_post['id_resp_update'] = $this->usuario->__get('id_resp_update');

			$query = "update usuario set " . $completa_query . " where id = " . $id_up;
							
			$stmt = $this->conexao->prepare($query);

			$erro = "";

			foreach ($array_inputs as $key => $value) {
	    		$stmt->bindParam(':'.$value, $array_post[$value], PDO::PARAM_STR); 
			}

	    	if($stmt->execute()){
	    		$text = "Editado com sucesso. Caso você tenha alterado o login ou a senha será necessário realizar o login novamente para utilizar o sistema novamente.";
	    		$this->message->success($text);
	    	}else{
	    		$text = "Falha ao editar.";
	    		$this->message->error($text);
	    	}

			return $this->message->render();
	}

	public function disable(){

		$id_del = $this->usuario->__get('id');
		$email_del = $this->usuario->__get('email');
		$id_to_del = $this->findByParam("email", "id");

		if(password_verify($id_to_del['id'], $id_del)){
			$query_update = "update usuario SET status = 0 where id = ".$id_to_del['id'];
			$this->message = new Message();

			if($this->usuario->__get('tipo') == 1){
				$query_verify = "select * from disc_turma where id_prof = " . $id_to_del['id'];

				$stmt_verify = $this->conexao->query($query_verify);

				$result_verify = $stmt_verify->fetchAll();

				$count_result = count($result_verify);
				
				$stmt = $this->conexao->prepare($query_update);
				$text = "";
				if($stmt->execute()){
					$text .= "O usuário foi desativado com sucesso.";
					if($count_result){
						$text .= " Este usuário possui registro em nosso sistema como professor. Isto implica que ele pode ter atividades, frequências e notas já cadastradas.";
					}
					$this->message->warning($text);
				}else{
					$text = "Falha ao desativar usuário";
					$error = implode("", $stmt->errorInfo());
					$this->message->error($text . " -> " . $error);
				}
			}elseif($this->usuario->__get('tipo') == 0){
				$query_verify = "select * from turma_aluno where id_aluno = " . $id_to_del['id'];

				$stmt_verify = $this->conexao->query($query_verify);

				$result_verify = $stmt_verify->fetchAll();

				$count_result = count($result_verify);
				
				$stmt = $this->conexao->prepare($query_update);
					$text = "";
					if($stmt->execute()){
						$text .= "O usuário foi desativado com sucesso.";
						if($count_result){
							$text .= " Este usuário possui registro em nosso sistema como aluno. Isto implica que ele pode ter frequência e notas já cadastradas.";
						}
						$this->message->success($text);
					}else{
						$text = "Falha ao desativar usuário";
						$error = implode("", $stmt->errorInfo());
						$this->message->error($text . " -> " . $error);
					}
			}
		return $this->message->render();
		}
	}
	

	public function reactivate(){
		$id_del = $this->usuario->__get('id');
		$email_del = $this->usuario->__get('email');

		$this->message = new Message();

		$id_to_del = $this->findByParam("email", "id");

		if(password_verify($id_to_del['id'], $id_del)){
			$query_update = "update usuario SET status = 1 where id = ".$id_to_del['id'];
			$stmt = $this->conexao->prepare($query_update);
			if($stmt->execute()){
				$text = "O usuario foi reativado com sucesso.";
				$this->message->success($text);
			}else {
				$text = "Falha ao reativar usuário.";
				$error = implode("", $stmt->errorInfo());
				$this->message->error($text . " -> " . $error);
			}
		}
		return $this->message->render();
	}

	public function findById($fields){
		$query = "select " . $fields . " from usuario where id = " . $this->usuario->__get('id');
        $stmt = $this->conexao->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
	}

	public function findByParam($string_param, $fields){
		$query = "select " . $fields . " from usuario where " . $string_param . " = '" . $this->usuario->__get($string_param) . "'";
        $stmt = $this->conexao->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
	}
}

?>