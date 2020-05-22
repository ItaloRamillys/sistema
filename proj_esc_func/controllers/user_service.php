<?php

class UserService{

	private $connection;
	private $user;

	public function __construct(Connection $connection, User $user){
		$this->connection = $connection->connect();
		$this->user = $user;
	}

	public function insert(){

		try{
			$query = "insert into user(id_user, first_name, last_name, login, pass, email, birth, blood, genre, cpf, address, create_at, update_at, type, img_profile, status) values('' ,:user_first_name, :user_last_name, :user_login, :user_pass, :user_email, :user_birth, :user_blood, :user_genre, :user_cpf, :user_address, :user_create_at, :user_update_at, :user_type, :user_img_profile, :user_status)";
						
			if ($this->user->__get('type') == 0 || $this->user->__get('type') == 1) {
				$this->connection->beginTransaction();
			}

	    	$stmt = $this->connection->prepare($query);

	    	$stmt->bindValue(':user_first_name', 	$this->user->__get('first_name'));
	    	$stmt->bindValue(':user_last_name', 	$this->user->__get('last_name'));
	    	$stmt->bindValue(':user_login', 		$this->user->__get('login'));
	    	$stmt->bindValue(':user_pass',  		$this->user->__get('pass'));
	    	$stmt->bindValue(':user_email',  		$this->user->__get('email'));
	    	$stmt->bindValue(':user_birth',			$this->user->__get('birth'));
	    	$stmt->bindValue(':user_blood',  		$this->user->__get('blood'));
	    	$stmt->bindValue(':user_genre', 		$this->user->__get('genre'));
	    	$stmt->bindValue(':user_cpf', 	    	$this->user->__get('cpf'));
	    	$stmt->bindValue(':user_address', 	    $this->user->__get('address'));
	    	$stmt->bindValue(':user_create_at', 	$this->user->__get('create_at')));
	  	    $stmt->bindValue(':user_update_at', 	$this->user->__get('update_at')));
	  	    $stmt->bindValue(':user_type', 			$this->user->__get('type'));
	  	    $stmt->bindValue(':user_img_profile',	$this->user->__get('img_profile'));
	  	    $stmt->bindValue(':user_status', 		$this->user->__get('status')));

	    	if($this->user->__get('type') == 2){
				return $stmt->execute();
			}

			else if($stmt->execute()){

				$last_id = $this->connection->lastInsertId();

				if($this->user->__get('type') == 0){

					$query2 = "insert into adjunct_student(parent1, phone_parent_1, parent2, phone_parent_2, comments, id_user, registration) values(:parent1, :phone_parent_1, :parent2, :phone_parent_2, :comments, :id_user, :registration)";

				    	$stmt2 = $this->connection->prepare($query2);

				    	$stmt2->bindValue(':parent1', 			$this->user->__get('parent1'));
				    	$stmt2->bindValue(':phone_parent_1', 	$this->user->__get('phone_parent_1'));
				    	$stmt2->bindValue(':parent2', 			$this->user->__get('parent2'));
				    	$stmt2->bindValue(':phone_parent_2',	$this->user->__get('phone_parent_2'));
				    	$stmt2->bindValue(':comments', 			$this->user->__get('comments'));
				    	$stmt2->bindValue(':id_user', 			$last_id);
				    	$stmt2->bindValue(':registration', 		$this->user->__get('registration'));

				    	$stmt2->execute();
				    	return $this->connection->commit();
						
				}else if($this->user->__get('type') == 1){

					$query2 = "insert into adjunct_teacher(id_teacher, salary, id_user, graduation, description, validate) values('', :salary, :id_user, :graduation, :description, :validate)";

				    	$stmt2 = $this->connection->prepare($query2);

				    	$stmt2->bindValue(':salary', 		$this->user->__get('salary'));
				    	$stmt2->bindValue(':id_user', 		$last_id);
				    	$stmt2->bindValue(':graduation', 	$this->user->__get('graduation'));
				    	$stmt2->bindValue(':description', 	$this->user->__get('description'));
				    	$stmt2->bindValue(':validate', 		$this->user->__get('validate'));

				    	$stmt2->execute();
				    	return $this->connection->commit();
				}
			}
		}catch(PDOException $e){
			if($this->user->__get('type') == 0){
				$this->connection->rollBack();
				return false;
			}else if($this->user->__get('type') == 1){
				$this->connection->rollBack();
				return false;
			}else if($this->user->__get('type') == 2){
				return false;
			}
		}

	}
	
	public function delete(){

		$id_del = $this->user->__get('id_user');

		$query = "update user SET status=0 where id_user = ".$id_del;

		$stmt = $this->connection->prepare($query);

		return $stmt->execute();	

	}

	public function update(){
		
		try{

			$id_up = $this->user->__get('id');

			$completa_query = "";

			if($this->user->__get('img_profile')!= ''){
				$completa_query = ", img_profile = :img_profile";
			}

			$query = "update user set login = :login, senha = :senha, nome = :nome, sobrenome = :sobrenome, data_nasc = :data_nasc, type_sang = :type_sangue, genero = :genero, rg = :rg, cpf = :cpf, endereco = :end,  update_at = :update_at, email = :email".$completa_query." where id = " . $id_up;
			
						
			if ($this->user->__get('type') == 0 || $this->user->__get('type') == 1) {
				$this->connection->beginTransaction();
			}

	    	$stmt = $this->connection->prepare($query);

	    	$tempo = time('Y-m-d');

	    	$login 		 = $this->user->__get('login');
			$senha 		 = $this->user->__get('senha');
			$nome 		 = $this->user->__get('nome');
			$sobrenome 	 = $this->user->__get('sobrenome');
			$data_nasc   = $this->user->__get('data_nasc');
			$type_sangue = $this->user->__get('type_sangue');
			$genero      = $this->user->__get('genero');
			$rg          = $this->user->__get('rg');
		    $cpf         = $this->user->__get('cpf');
			$end         = $this->user->__get('end');
			$email       = $this->user->__get('email');

	    	$stmt->bindParam(':login', $login, PDO::PARAM_STR); 
	    	$stmt->bindParam(':senha', $senha, PDO::PARAM_STR); 
	    	$stmt->bindParam(':nome', $nome, PDO::PARAM_STR); 
	    	$stmt->bindParam(':sobrenome', $sobrenome, PDO::PARAM_STR); 
	    	$stmt->bindParam(':data_nasc',$data_nasc, PDO::PARAM_STR); 
	    	$stmt->bindParam(':type_sangue', $type_sangue, PDO::PARAM_STR); 
	    	$stmt->bindParam(':genero', $genero, PDO::PARAM_STR); 
	    	$stmt->bindParam(':rg', $rg, PDO::PARAM_STR); 
	    	$stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR); 
	    	$stmt->bindParam(':end', $end, PDO::PARAM_STR); 
	    	$stmt->bindParam(':update_at', $tempo, PDO::PARAM_STR); 
	    	$stmt->bindParam(':email', $email, PDO::PARAM_STR); 

	    	if($this->user->__get('img_profile')!= ''){
	    		$stmt->bindParam(':img_profile', $this->user->__get('img_profile'), PDO::PARAM_STR);
	    	}
			
			if($stmt->execute()){

				if($this->user->__get('type') == 0){

					$query2 =  "update complemento_aluno set matricula = :matricula, resp1 = :resp1, contato_resp1 = :cont_resp1, resp2 = :resp2, contato_resp2 = :cont_resp2, obs = :obs where id_usu = " . $id_up;

				    	$stmt2 = $this->connection->prepare($query2);

				    	$resp1  =  $this->user->__get('resp1');
				    	$resp2  =  $this->user->__get('resp2');
						$cont_resp1  =  $this->user->__get('cont_resp1');
						$cont_resp2  =  $this->user->__get('cont_resp2');
						$obs  =  $this->user->__get('obs');
						$matricula  =  $this->user->__get('matricula');

				    	$stmt2->bindParam(':resp1', $resp1, PDO::PARAM_STR);
				    	$stmt2->bindParam(':resp2', 		 $resp2, PDO::PARAM_STR);
				    	$stmt2->bindParam(':cont_resp1',  $cont_resp1, PDO::PARAM_STR);
				    	$stmt2->bindParam(':cont_resp2', 	 $cont_resp2, PDO::PARAM_STR);
				    	$stmt2->bindParam(':obs', 			 $obs, PDO::PARAM_STR);
				    	$stmt2->bindParam(':matricula', 	 $matricula, PDO::PARAM_STR);

				    	if ($stmt2->execute()) {
				    		$this->connection->commit();
						    header('Location: ../../proj_esc/templates/showData.php?src=aluno&update=1');
				    	}else{
							header('Location: ../../proj_esc/templates/showData.php?src=aluno&update=0&erro2');
				    	}

				}else if($this->user->__get('type') == 1){
					
						$query2 =  "update complemento_prof set salario = :salario, vencimento = :vencimento, descricao = :descricao, formacao = :formacao where id_usu = " . $id_up;

				    	$stmt2 = $this->connection->prepare($query2);

				    	$salario  =  $this->user->__get('salario');
				    	$vencimento  =  $this->user->__get('vencimento');
						$descricao  =  $this->user->__get('descricao');
						$formacao  =  $this->user->__get('formacao');

				    	$stmt2->bindParam(':salario', $salario, PDO::PARAM_STR);
				    	$stmt2->bindParam(':vencimento', 		 $vencimento, PDO::PARAM_STR);
				    	$stmt2->bindParam(':descricao',  $descricao, PDO::PARAM_STR);
				    	$stmt2->bindParam(':formacao', 	 $formacao, PDO::PARAM_STR);

				    	if ($stmt2->execute()) {
				    		$this->connection->commit();
						    header('Location: ../../proj_esc/templates/showData.php?src=prof&update=1');
				    	}else{
							header('Location: ../../proj_esc/templates/showData.php?src=prof&update=0&erro2');
				    	}

				}else if($this->user->__get('type') == 2){
					header('Location: ../../proj_esc/templates/showData.php?src=admin&update=1');
				}
			}

		}


		catch(PDOException $e){

			if($this->user->__get('type') == 0){
				$this->connection->rollBack();
					header('Location: ../../proj_esc/templates/showData.php?src=aluno&update=0');
			}else if($this->user->__get('type') == 1){
				var_dump($e);
				die;

					header('Location: ../../proj_esc/templates/showData.php?src=prof&update=0');
			}else if($this->user->__get('type') == 2){
					header('Location: ../../proj_esc/templates/showData.php?src=admin&update=0');
			}
		}
	}

	public function select(){

	}
}

?>