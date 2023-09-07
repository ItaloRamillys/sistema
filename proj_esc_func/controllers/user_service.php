<?php
require "autoload.php";

use Helpers\Message;
use Helpers\Log;

class UserService{

	private $conn;
	private $user;
	private $message;
	private $log;

	public function __construct(Connection $conn, User $user){
		$this->conn = $conn->connect();
		$this->user = $user;
	}

	public function change_style(){
		$query = "update user set std_style = " . $this->user->__get('std_style');
		$stmt = $this->conn->prepare($query);

		$this->log = new Log();
		$text_log = "";
    	if($stmt->execute()){
    		$this->log->setLog(
							"Editar Estilo", 
							"Usuario", 
							$this->user->__get('id_author_update'), 
							$this->user->__get('id_author_update'), 
							date("d/m/Y H:m:i"), 
							"S - " . $this->user->__get('std_style') 
						);

    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
    		if(!$bool){
    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor.";
    		}

    		$text = "Estilo alterado." . $text_log;
    		$this->message->success($text);
    	}else{
    		$err = implode("", $stmt->errorInfo());

			$this->log->setLog(
							"Editar", 
							"Usuario", 
							$this->user->__get('id_author_update'), 
							$this->user->__get('id'), 
							date("d/m/Y H:m:i"), 
							"F " . $err
						);

    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
    		if(!$bool){
    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor.";
    		}

    		$text = "Falha ao mudar o estilo." . $text_log;
    		$this->message->error($text . $err);
    	}

		return $this->message->render();
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
			if(!$this->user->__get('img_profile')){
				$erro++;
				$errors .= ' sem imagem.';
			}
			if($checkEmail){
				$erro++;
				$errors .= ' Email duplicado.';
			}
			if($checkLogin){
				$erro++;
				$errors .= ' Login duplicado.';
			}

			$query_verify = "select count(*) from user where type = 2";
	    	$stmt_verify = $this->conn->query($query_verify);
	    	$row_verify = $stmt_verify->fetch(PDO::FETCH_NUM);
	    	$count_adm = $row_verify[0];

			$query = "insert into user(login, pass, name, last_name, birth, blood, genre, document, address, email, type, id_author_insert, status, img_profile) values(:login, :pass, :name, :last_name, :birth, :blood, :genre, :document, :address, :email, :type, :id_author_insert, :status, :img_profile)";

	    	$stmt = $this->conn->prepare($query);

	    	$stmt->bindValue(':login', 		$this->user->__get('login'));
	    	$stmt->bindValue(':pass', 		$this->user->__get('pass'));
	    	$stmt->bindValue(':name', 		$this->user->__get('name'));
	    	$stmt->bindValue(':last_name',  $this->user->__get('last_name'));
	    	$stmt->bindValue(':birth',      $this->user->__get('birth'));
	    	$stmt->bindValue(':blood',      $this->user->__get('blood'));
	    	$stmt->bindValue(':genre',  	$this->user->__get('genre'));
	    	$stmt->bindValue(':document', 	$this->user->__get('document'));
	    	$stmt->bindValue(':address', 	$this->user->__get('address'));
	    	$stmt->bindValue(':email', 		$this->user->__get('email'));
	  	    $stmt->bindValue(':type', 		$this->user->__get('type'));
	  	    $stmt->bindValue(':id_author_insert', 	$this->user->__get('id_author_insert'));
	  	    $stmt->bindValue(':status', 	$this->user->__get('status'));
	  	    $stmt->bindValue(':img_profile',$this->user->__get('img_profile'));

			$this->message = new Message();
			$this->log = new Log();

			$text_log = "";
			if($count_adm >= 3 && $this->user->__get('type') == 2){

				$this->log->setLog(
    							"Cadastro", 
    							"Usuario", 
    							$this->user->__get('id_author_insert'), 
								"Tentativa de inclusao de ADM: " . $this->user->__get('name') . " " . $this->user->__get('last_name'), 
    							date("d/m/Y H:m:i"), 
    							"F - Quantidade maxima de adm já atingida"
    						);

	    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
	    		if(!$bool){
	    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor. ";
	    		}

				$text = 'Quantidade máxima de administradores atingida. Entre em contato com o desenvolvedor.';
				$this->message->warning($text);

			}elseif($erro == 0){
				$stmt->execute();	
				$this->log->setLog(
    							"Cadastro", 
    							"Usuario", 
    							$this->user->__get('id_author_insert'), 
    							$this->user->__get('name') . " " . $this->user->__get('last_name'), 
    							date("d/m/Y H:m:i"), 
    							"S"
    						);

	    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
	    		if(!$bool){
	    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor. ";
	    		}

				$text = 'Usuário cadastrado com sucesso';
				$this->message->success($text . $text_log);
			}else{
				$err = implode("", $stmt->errorInfo());

				$this->log->setLog(
    							"Cadastro", 
    							"Usuario", 
    							$this->user->__get('id_author_insert'), 
    							$this->user->__get('name') . " " . $this->user->__get('last_name'), 
    							date("d/m/Y H:m:i"), 
    							"F " . $err
    						);

	    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
	    		if(!$bool){
	    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor. ";
	    		}

	    		//echo $erro;
				$text = 'Falha ao cadastrar usuário. ' . $errors . $text_log;
				$this->message->error($text . $err);
				if( file_exists("C:/xampp/htdocs/sistema/img/".$this->user->__get('img_profile')) && !is_dir("C:/xampp/htdocs/sistema/img/".$this->user->__get('img_profile')))
					unlink("C:/xampp/htdocs/sistema/img/".$this->user->__get('img_profile'));
			}
			return $this->message->render();
	}
	
	public function checkDuplicateData($model, $column, $data){
		$query = "select * from " . $model . " where " . $column . " = '" . $data . "'";
		
		$stmt = $this->conn->query($query);
		
		$result = $stmt->fetchAll();

		return count($result);
	}

	public function delete(){
		$id_del = $this->user->__get('id');
		$email_del = $this->user->__get('email');
		$this->message = new Message();
		$id_to_del = $this->findByParam("id", "email");

		$id_adm = $_SESSION['user_id'];

		if(!empty($id_to_del)){
			$query_data_user = "select name, last_name from user where id = " . $id_to_del['id'];
			$stmt_data_user = $this->conn->query($query_data_user);
			$row_data_user = $stmt_data_user->fetch(PDO::FETCH_ASSOC);

			$this->log = new Log();
			$text_log = "";

			if($id_to_del['id'] == $id_del){
				$query_delete = "delete from user where id = ".$id_to_del['id'];
				$stmt = $this->conn->prepare($query_delete);

				try{
					$stmt->execute();
					$this->log->setLog(
	    							"Delete", 
	    							"Usuario",
	    							$id_adm, 
	    							$row_data_user['name'] . " " . $row_data_user['last_name'], 
	    							date("d/m/Y H:m:i"), 
	    							"S"
	    						);

		    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
		    		if(!$bool){
		    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor.";
		    		}
					$text = "O usuário foi excluído com sucesso.";
					$this->message->success($text . $text_log);
				}catch(PDOException $e) {
					$err = implode("", $stmt->errorInfo());
					$this->log->setLog(
	    							"Delete", 
	    							"Usuario", 
	    							$id_adm, 
	    							$this->user->__get('name') . " " . $this->user->__get('last_name'), 
	    							date("d/m/Y H:m:i"), 
	    							"F " . $err
	    						);

		    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
		    		if(!$bool){
		    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor.";
		    		}

					$text = "Falha ao excluir usuário. ";
					$this->message->error($text . $err . $e);
				}
			}else{
				$text = "O usuário não existe";
				$this->log->setLog(
	    							"Delete", 
	    							"Usuario",
	    							$id_adm, 
	    							"Busca invalida - id: " . $id_del . " - " . $text, 
	    							date("d/m/Y H:m:i"), 
	    							"S"
	    						);
				$this->message->error($text);
			}

			return $this->message->render();
		}
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

			if(!is_null($this->user->__get('blood'))){
				array_push($array_inputs, "blood");
				if($has_comma){
					$completa_query .= ", ";
				}
				$completa_query .= " blood = :blood ";
				$has_comma = true;
				$array_post['blood'] =$this->user->__get('blood');
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

			array_push($array_inputs, "id_author_update");
			if($has_comma){
				$completa_query .= ", ";
			}
			$completa_query .= " id_author_update = :id_author_update ";
			$array_post['id_author_update'] = $this->user->__get('id_author_update');

			$query = "update user set " . $completa_query . " where id = " . $id_up;
							
			$stmt = $this->conn->prepare($query);

			$erro = "";

			foreach ($array_inputs as $key => $value) {
	    		$stmt->bindParam(':'.$value, $array_post[$value], PDO::PARAM_STR); 
			}
			$this->log = new Log();
			$text_log = "";
	    	if($stmt->execute()){
	    		$this->log->setLog(
    							"Editar", 
    							"Usuario", 
    							$this->user->__get('id_author_update'), 
    							$this->user->__get('id'), 
    							date("d/m/Y H:m:i"), 
    							"S"
    						);

	    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
	    		if(!$bool){
	    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor.";
	    		}

	    		$text = "Editado com sucesso. Caso você tenha alterado o login ou a senha será necessário realizar o login novamente para utilizar o sistema na conta editada.";
	    		$this->message->success($text);
	    	}else{
	    		$err = implode("", $stmt->errorInfo());

				$this->log->setLog(
    							"Editar", 
    							"Usuario", 
    							$this->user->__get('id_author_update'), 
    							$this->user->__get('id'), 
    							date("d/m/Y H:m:i"), 
    							"F " . $err
    						);

	    		$bool = $this->log->writeLog(__DIR__ . "/../log.txt");
	    		if(!$bool){
	    			$text_log = " Seu log não está funcionando corretamente. Contate o desenvolvedor.";
	    		}

	    		$text = "Falha ao editar. ";
	    		$this->message->error($text . $err);
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
				$query_verify = "select * from user_class where id_teacher = " . $id_to_del['id'];

				$stmt_verify = $this->conn->query($query_verify);

				$result_verify = $stmt_verify->fetchAll();

				$count_result = count($result_verify);
				
				$stmt = $this->conn->prepare($query_update);
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

				$stmt_verify = $this->conn->query($query_verify);

				$result_verify = $stmt_verify->fetchAll();

				$count_result = count($result_verify);
				
				$stmt = $this->conn->prepare($query_update);
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
			$stmt = $this->conn->prepare($query_update);
			if($stmt->execute()){
				$text = "O usuário foi reativado com sucesso.";
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
        $stmt = $this->conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
        	return $result;
        }
        return false;
	}

	public function findByParam($fields, $string_param){
		$query = "select " . $fields . " from user where " . $string_param . " = '" . $this->user->__get($string_param) . "'";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
        	return $result;
        }
        return false;
	}
}

?>