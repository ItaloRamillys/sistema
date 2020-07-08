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

			$checkdocument   = $this->checkDuplicateData("user", 'document', $this->user->__get('document'));
			$checkEmail = $this->checkDuplicateData("user", 'email', $this->user->__get('email'));
			$checkLogin = $this->checkDuplicateData("user", 'login', $this->user->__get('login'));

			if(strlen($this->user->__get('pass'))<8 || strlen($this->user->__get('pass'))>16){
				$erro++;
				$errors .= ' A pass deve ter entre 8 e 16 caracteres';
			}
			if($checkdocument){
				$erro++;
				$errors .= ' document duplicado.';
			}
			if($checkEmail){
				$erro++;
				$errors .= ' Email duplicado.';
			}
			if($checkLogin){
				$erro++;
				$errors .= ' Login duplicado.';
			}

			$query = "insert into user(login, pass, name, last_name, birth, blood, genre, document, address, email, type, id_author_insert, img_profile) values(:login, :pass, :name, :last_name, :birth, :blood, :genre, :document, :address, :email, :type, :id_author_insert, :img_profile)";

	    	$stmt = $this->connection->prepare($query);

	    	$stmt->bindValue(':login', 		$this->user->__get('login'));
	    	$stmt->bindValue(':pass', 		$this->user->__get('pass'));
	    	$stmt->bindValue(':name', 		$this->user->__get('name'));
	    	$stmt->bindValue(':last_name',  $this->user->__get('last_name'));
	    	$stmt->bindValue(':birth',      $this->user->__get('birth'));
	    	$stmt->bindValue(':blood',      $this->user->__get('blood'));
	    	$stmt->bindValue(':genre',  	$this->user->__get('genre'));
	    	$stmt->bindValue(':document', 	$this->user->__get('document'));
	    	$stmt->bindValue(':address', 	    $this->user->__get('address'));
	    	$stmt->bindValue(':email', 		$this->user->__get('email'));
	  	    $stmt->bindValue(':type', 		$this->user->__get('type'));
	  	    $stmt->bindValue(':id_author_insert', 	$this->user->__get('id_author_insert'));
	  	    $stmt->bindValue(':img_profile',$this->user->__get('img_profile'));

			$this->message = new Message();
			if($stmt->execute() && $erro == 0){
				$text = 'Usuário cadastrado com sucesso';
				$this->message->success($text);
			}else{
				$err = implode("", $stmt->errorInfo());
				$text = 'Falha ao cadastrar usuário. '.$errors;
				$this->message->error($text . " - > " . $err);
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

			if(!is_null($this->user->__get('genre'))){
				array_push($array_inputs, "genre");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " genre = :genre ";
				$has_comma = true;
				$array_post['genre'] = $this->user->__get('genre');
			}

			if(!is_null($this->user->__get('document'))){
				array_push($array_inputs, "document");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " document = :document ";
				$has_comma = true;
				$array_post['document']  = $this->user->__get('document');
			}

			if(!is_null($this->user->__get('address'))){
				array_push($array_inputs, "address");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " address = :address ";
				$has_comma = true;
				$array_post['address'] = $this->user->__get('address');
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
				$query_verify = "select * from subject_class where id_teacher = " . $id_to_del['id'];

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
				$query_verify = "select * from class_student where id_student = " . $id_to_del['id'];

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