<?php
require "autoload.php";

use Helpers\Message;

class UserService{

	private $connection;
	private $user;
	private $message;

	public function __construct(Connection $connection, User $user){
		$this->connection = $connection->connect();
		$this->user = $user;
	}

	public function insert(){

			$erro = 0;
			$errors = 'Erro: ';

			$checkCpf   = $this->checkDuplicateData("user", 'cpf', $this->user->__get('cpf'));
			$checkEmail = $this->checkDuplicateData("user", 'email', $this->user->__get('email'));
			$checkLogin = $this->checkDuplicateData("user", 'login', $this->user->__get('login'));

			if(strlen($this->user->__get('pass'))<8 || strlen($this->user->__get('pass'))>16){
				$erro++;
				$errors .= ' A pass deve ter entre 8 e 16 caracteres';
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

			$query = "insert into user(login, pass, name, last_name, birth, type_sangue, genero, cpf, endereco, email, type, id_resp_insert, img_profile) values(:user_login, :user_pass, :user_name, :user_last_name, :user_birth, :user_type_sangue, :user_genero, :user_cpf, :user_end, :user_email, :user_type, :id_resp_insert, :user_img_profile)";

	    	$stmt = $this->connection->prepare($query);

	    	$stmt->bindValue(':user_login', 		$this->user->__get('login'));
	    	$stmt->bindValue(':user_pass', 		$this->user->__get('pass'));
	    	$stmt->bindValue(':user_name', 		$this->user->__get('name'));
	    	$stmt->bindValue(':user_last_name',  $this->user->__get('last_name'));
	    	$stmt->bindValue(':user_birth',  $this->user->__get('birth'));
	    	$stmt->bindValue(':user_type_sangue',$this->user->__get('type_sangue'));
	    	$stmt->bindValue(':user_genero',  	$this->user->__get('genero'));
	    	$stmt->bindValue(':user_cpf', 	    $this->user->__get('cpf'));
	    	$stmt->bindValue(':user_end', 	    $this->user->__get('end'));
	    	$stmt->bindValue(':user_email', 		$this->user->__get('email'));
	  	    $stmt->bindValue(':user_type', 		$this->user->__get('type'));
	  	    $stmt->bindValue(':id_resp_insert', 	$this->user->__get('id_resp_insert'));
	  	    $stmt->bindValue(':user_img_profile',$this->user->__get('img_profile'));

			$this->message = new Message();
			if($stmt->execute() && $erro == 0){
				$text = 'Usuário cadastrado com sucesso';
				$this->message->success($text);
			}else{
				$text = 'Falha ao cadastrar user. '.$errors;
				$this->message->error($text);
				unlink("C:/xampp/htdocs/sistema/img/".$this->user->__get('img_profile'));
			}

			return $this->message->render();
	}
	
	public function checkDuplicateData($model, $column, $data){
		$query = "select * from " . $model . " where " . $column . " = '" . $data . "'";
		
		$stmt = $this->connection->query($query);
		
		$result = $stmt->fetchAll();

		return count($result);
	}

	public function delete(){

		$id_del = $this->user->__get('id');
		$email_del = $this->user->__get('email');
		$this->message = new Message();
		$id_to_del = $this->findByParam("email", "id");

		if(password_verify($id_to_del['id'], $id_del)){
			$query_update = "update user SET status = 0 where id = ".$id_to_del['id'];
			$query_delete = "delete from user where id = ".$id_to_del['id'];

			if($stmt->execute()){
					$text = "O user foi excluído com sucesso.";
					$this->message->success($text);
				}else {
					$text = "Falha ao excluir usuário";
					$this->message->error($text);
				}
			}
		return $this->message->render();	
	}
	

	public function update(){
		
			$id_up = $this->user->__get('id');

			$this->message = new Message();

			$has_comma = false;

			$array_inputs = [];

			$completa_query = "";

			if(!is_null($this->user->__get('img_profile'))){
				array_push($array_inputs, "img_profile");
				$completa_query .= " img_profile = :img_profile ";
				$has_comma = true;
				$array_post['img_profile'] = $this->user->__get('img_profile');
			}

			if(!is_null($this->user->__get('login'))){
				array_push($array_inputs, "login");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " login = :login ";
				$has_comma = true;
				$array_post['login'] = $this->user->__get('login');
			}

			if(!is_null($this->user->__get('pass'))){
				array_push($array_inputs, "pass");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " pass = :pass ";
				$has_comma = true;
				$array_post['pass'] = $this->user->__get('pass');
			}

			if(!is_null($this->user->__get('name'))){
				array_push($array_inputs, "name");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " name = :name ";
				$has_comma = true;
				$array_post['name'] = $this->user->__get('name');
			}

			if(!is_null($this->user->__get('last_name'))){
				array_push($array_inputs, "last_name");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " last_name = :last_name ";
				$has_comma = true;
				$array_post['last_name'] = $this->user->__get('last_name');
			}

			if(!is_null($this->user->__get('birth'))){
				array_push($array_inputs, "birth");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " birth = :birth ";
				$has_comma = true;
				$array_post['birth'] = $this->user->__get('birth');
			}

			if(!is_null($this->user->__get('type_sangue'))){
				array_push($array_inputs, "type_sangue");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " type_sangue = :type_sangue ";
				$has_comma = true;
				$array_post['type_sangue'] =$this->user->__get('type_sangue');
			}

			if(!is_null($this->user->__get('genero'))){
				array_push($array_inputs, "genero");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " genero = :genero ";
				$has_comma = true;
				$array_post['genero'] = $this->user->__get('genero');
			}

			if(!is_null($this->user->__get('cpf'))){
				array_push($array_inputs, "cpf");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " cpf = :cpf ";
				$has_comma = true;
				$array_post['cpf']  = $this->user->__get('cpf');
			}

			if(!is_null($this->user->__get('endereco'))){
				array_push($array_inputs, "endereco");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " endereco = :endereco ";
				$has_comma = true;
				$array_post['endereco'] = $this->user->__get('endereco');
			}

			if(!is_null($this->user->__get('email'))){
				array_push($array_inputs, "email");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " email = :email ";
				$has_comma = true;
				$array_post['email'] = $this->user->__get('email');
			}

			array_push($array_inputs, "id_resp_update");
			$completa_query .= ", id_resp_update = :id_resp_update ";
			$array_post['id_resp_update'] = $this->user->__get('id_resp_update');

			$query = "update user set " . $completa_query . " where id = " . $id_up;
							
			$stmt = $this->connection->prepare($query);

			$erro = "";

			foreach ($array_inputs as $key => $value) {
	    		$stmt->bindParam(':'.$value, $array_post[$value], PDO::PARAM_STR); 
			}

	    	if($stmt->execute()){
	    		$text = "Editado com sucesso. Caso você tenha alterado o login ou a pass será necessário realizar o login novamente para utilizar o sistema novamente.";
	    		$this->message->success($text);
	    	}else{
	    		$text = "Falha ao editar.";
	    		$this->message->error($text);
	    	}

			return $this->message->render();
	}

	public function disable(){

		$id_del = $this->user->__get('id');
		$email_del = $this->user->__get('email');
		$id_to_del = $this->findByParam("email", "id");

		if(password_verify($id_to_del['id'], $id_del)){
			$query_update = "update user SET status = 0 where id = ".$id_to_del['id'];
			$this->message = new Message();

			if($this->user->__get('type') == 1){
				$query_verify = "select * from disc_turma where id_prof = " . $id_to_del['id'];

				$stmt_verify = $this->connection->query($query_verify);

				$result_verify = $stmt_verify->fetchAll();

				$count_result = count($result_verify);
				
				$stmt = $this->connection->prepare($query_update);
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
			}elseif($this->user->__get('type') == 0){
				$query_verify = "select * from turma_aluno where id_aluno = " . $id_to_del['id'];

				$stmt_verify = $this->connection->query($query_verify);

				$result_verify = $stmt_verify->fetchAll();

				$count_result = count($result_verify);
				
				$stmt = $this->connection->prepare($query_update);
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
		$id_del = $this->user->__get('id');
		$email_del = $this->user->__get('email');

		$this->message = new Message();

		$id_to_del = $this->findByParam("email", "id");

		if(password_verify($id_to_del['id'], $id_del)){
			$query_update = "update user SET status = 1 where id = ".$id_to_del['id'];
			$stmt = $this->connection->prepare($query_update);
			if($stmt->execute()){
				$text = "O user foi reativado com sucesso.";
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
		$query = "select " . $fields . " from user where id = " . $this->user->__get('id');
        $stmt = $this->connection->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
        	return $result;
        }
        return $stmt->errorInfo();
	}

	public function findByParam($string_param, $fields){
		$query = "select " . $fields . " from user where " . $string_param . " = '" . $this->user->__get($string_param) . "'";
        $stmt = $this->connection->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
        	return $result;
        }
        return $stmt->errorInfo();
	}
}

?>