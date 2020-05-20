<?php

class UsuarioService{

	private $conexao;
	private $usuario;

	public function __construct(Conexao $conexao, usuario $usuario){
		$this->conexao = $conexao->conectar();
		$this->usuario = $usuario;
	}

	public function insert(){

		try{
			$query = "insert into usuario(id, login, senha, nome, sobrenome, data_nasc, tipo_sang, genero, rg, cpf, endereco, email, id_esc, tipo, img_profile) values('' ,:usuario_login, :usuario_senha, :usuario_nome, :usuario_sobrenome, :usuario_data_nasc, :usuario_tipo_sangue, :usuario_genero, :usuario_rg, :usuario_cpf, :usuario_end, :usuario_email, :usuario_id_esc, :usuario_tipo, :usuario_img_profile)";
						
			if ($this->usuario->__get('tipo') == 0 || $this->usuario->__get('tipo') == 1) {
				$this->conexao->beginTransaction();
			}

	    	$stmt = $this->conexao->prepare($query);

	    	$stmt->bindValue(':usuario_login', 		$this->usuario->__get('login'));
	    	$stmt->bindValue(':usuario_senha', 		$this->usuario->__get('senha'));
	    	$stmt->bindValue(':usuario_nome', 		$this->usuario->__get('nome'));
	    	$stmt->bindValue(':usuario_sobrenome',  $this->usuario->__get('sobrenome'));
	    	$stmt->bindValue(':usuario_data_nasc',  $this->usuario->__get('data_nasc'));
	    	$stmt->bindValue(':usuario_tipo_sangue',$this->usuario->__get('tipo_sangue'));
	    	$stmt->bindValue(':usuario_genero',  	$this->usuario->__get('genero'));
	    	$stmt->bindValue(':usuario_rg', 		$this->usuario->__get('rg'));
	    	$stmt->bindValue(':usuario_cpf', 	    $this->usuario->__get('cpf'));
	    	$stmt->bindValue(':usuario_end', 	    $this->usuario->__get('end'));
	    	$stmt->bindValue(':usuario_email', 		$this->usuario->__get('email'));
	  	    $stmt->bindValue(':usuario_id_esc', 	$this->usuario->__get('id_esc'));
	  	    $stmt->bindValue(':usuario_tipo', 		$this->usuario->__get('tipo'));
	  	    $stmt->bindValue(':usuario_img_profile',$this->usuario->__get('img_profile'));

	    	if($this->usuario->__get('tipo') == 2){
				return $stmt->execute();
			}

			else if($stmt->execute()){

				$last_id = $this->conexao->lastInsertId();

				if($this->usuario->__get('tipo') == 0){

					$query2 = "insert into complemento_aluno(resp1, contato_resp1, resp2, contato_resp2, obs, alergia, id_usu, matricula) values(:resp1,	:cont_resp1, :resp2, :cont_resp2, :obs, :alergia, :id_usu, :matricula)";

				    	$stmt2 = $this->conexao->prepare($query2);

				    	$stmt2->bindValue(':resp1', 		$this->usuario->__get('resp1'));
				    	$stmt2->bindValue(':resp2', 		$this->usuario->__get('resp2'));
				    	$stmt2->bindValue(':cont_resp1', 	$this->usuario->__get('cont_resp1'));
				    	$stmt2->bindValue(':cont_resp2', 	$this->usuario->__get('cont_resp2'));
				    	$stmt2->bindValue(':alergia', 		$this->usuario->__get('alergia'));
				    	$stmt2->bindValue(':obs', 			$this->usuario->__get('obs'));
				    	$stmt2->bindValue(':matricula', 	$this->usuario->__get('matricula'));
				    	$stmt2->bindValue(':id_usu', 		$last_id);

				    	$stmt2->execute();
				    	return $this->conexao->commit();
						
				}else if($this->usuario->__get('tipo') == 1){

					$query2 = "insert into complemento_prof(salario, vencimento, formacao, descricao, id_usu) values(:salario,	:vencimento, :formacao, :descricao, :id_usu)";

				    	$stmt2 = $this->conexao->prepare($query2);

				    	$stmt2->bindValue(':salario', 		$this->usuario->__get('salario'));
				    	$stmt2->bindValue(':vencimento', 	$this->usuario->__get('vencimento'));
				    	$stmt2->bindValue(':formacao', 		$this->usuario->__get('formacao'));
				    	$stmt2->bindValue(':descricao', 	$this->usuario->__get('descricao'));
				    	$stmt2->bindValue(':id_usu', 		$last_id);

				    	$stmt2->execute();
				    	return $this->conexao->commit();
				}
			}
		}catch(PDOException $e){
			if($this->usuario->__get('tipo') == 0){
				$this->conexao->rollBack();
				return false;
			}else if($this->usuario->__get('tipo') == 1){
				$this->conexao->rollBack();
				return false;
			}else if($this->usuario->__get('tipo') == 2){
				return false;
			}
		}

	}
	
	public function delete(){

		$id_del = $this->usuario->__get('id');

		$query = "update usuario SET status=0 where id = ".$id_del;

		$stmt = $this->conexao->prepare($query);

		return $stmt->execute();	

	}

	public function update(){
		
		try{

			$id_up = $this->usuario->__get('id');

			$completa_query = "";

			if($this->usuario->__get('img_profile')!= ''){
				$completa_query = ", img_profile = :img_profile";
			}

			$query = "update usuario set login = :login, senha = :senha, nome = :nome, sobrenome = :sobrenome, data_nasc = :data_nasc, tipo_sang = :tipo_sangue, genero = :genero, rg = :rg, cpf = :cpf, endereco = :end,  update_at = :update_at, email = :email".$completa_query." where id = " . $id_up;
			
						
			if ($this->usuario->__get('tipo') == 0 || $this->usuario->__get('tipo') == 1) {
				$this->conexao->beginTransaction();
			}

	    	$stmt = $this->conexao->prepare($query);

	    	$tempo = time('Y-m-d');

	    	$login 		 = $this->usuario->__get('login');
			$senha 		 = $this->usuario->__get('senha');
			$nome 		 = $this->usuario->__get('nome');
			$sobrenome 	 = $this->usuario->__get('sobrenome');
			$data_nasc   = $this->usuario->__get('data_nasc');
			$tipo_sangue = $this->usuario->__get('tipo_sangue');
			$genero      = $this->usuario->__get('genero');
			$rg          = $this->usuario->__get('rg');
		    $cpf         = $this->usuario->__get('cpf');
			$end         = $this->usuario->__get('end');
			$email       = $this->usuario->__get('email');

	    	$stmt->bindParam(':login', $login, PDO::PARAM_STR); 
	    	$stmt->bindParam(':senha', $senha, PDO::PARAM_STR); 
	    	$stmt->bindParam(':nome', $nome, PDO::PARAM_STR); 
	    	$stmt->bindParam(':sobrenome', $sobrenome, PDO::PARAM_STR); 
	    	$stmt->bindParam(':data_nasc',$data_nasc, PDO::PARAM_STR); 
	    	$stmt->bindParam(':tipo_sangue', $tipo_sangue, PDO::PARAM_STR); 
	    	$stmt->bindParam(':genero', $genero, PDO::PARAM_STR); 
	    	$stmt->bindParam(':rg', $rg, PDO::PARAM_STR); 
	    	$stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR); 
	    	$stmt->bindParam(':end', $end, PDO::PARAM_STR); 
	    	$stmt->bindParam(':update_at', $tempo, PDO::PARAM_STR); 
	    	$stmt->bindParam(':email', $email, PDO::PARAM_STR); 

	    	if($this->usuario->__get('img_profile')!= ''){
	    		$stmt->bindParam(':img_profile', $this->usuario->__get('img_profile'), PDO::PARAM_STR);
	    	}
			
			if($stmt->execute()){

				if($this->usuario->__get('tipo') == 0){

					$query2 =  "update complemento_aluno set matricula = :matricula, resp1 = :resp1, contato_resp1 = :cont_resp1, resp2 = :resp2, contato_resp2 = :cont_resp2, obs = :obs where id_usu = " . $id_up;

				    	$stmt2 = $this->conexao->prepare($query2);

				    	$resp1  =  $this->usuario->__get('resp1');
				    	$resp2  =  $this->usuario->__get('resp2');
						$cont_resp1  =  $this->usuario->__get('cont_resp1');
						$cont_resp2  =  $this->usuario->__get('cont_resp2');
						$obs  =  $this->usuario->__get('obs');
						$matricula  =  $this->usuario->__get('matricula');

				    	$stmt2->bindParam(':resp1', $resp1, PDO::PARAM_STR);
				    	$stmt2->bindParam(':resp2', 		 $resp2, PDO::PARAM_STR);
				    	$stmt2->bindParam(':cont_resp1',  $cont_resp1, PDO::PARAM_STR);
				    	$stmt2->bindParam(':cont_resp2', 	 $cont_resp2, PDO::PARAM_STR);
				    	$stmt2->bindParam(':obs', 			 $obs, PDO::PARAM_STR);
				    	$stmt2->bindParam(':matricula', 	 $matricula, PDO::PARAM_STR);

				    	if ($stmt2->execute()) {
				    		$this->conexao->commit();
						    header('Location: ../../proj_esc/templates/showData.php?src=aluno&update=1');
				    	}else{
							header('Location: ../../proj_esc/templates/showData.php?src=aluno&update=0&erro2');
				    	}

				}else if($this->usuario->__get('tipo') == 1){
					
						$query2 =  "update complemento_prof set salario = :salario, vencimento = :vencimento, descricao = :descricao, formacao = :formacao where id_usu = " . $id_up;

				    	$stmt2 = $this->conexao->prepare($query2);

				    	$salario  =  $this->usuario->__get('salario');
				    	$vencimento  =  $this->usuario->__get('vencimento');
						$descricao  =  $this->usuario->__get('descricao');
						$formacao  =  $this->usuario->__get('formacao');

				    	$stmt2->bindParam(':salario', $salario, PDO::PARAM_STR);
				    	$stmt2->bindParam(':vencimento', 		 $vencimento, PDO::PARAM_STR);
				    	$stmt2->bindParam(':descricao',  $descricao, PDO::PARAM_STR);
				    	$stmt2->bindParam(':formacao', 	 $formacao, PDO::PARAM_STR);

				    	if ($stmt2->execute()) {
				    		$this->conexao->commit();
						    header('Location: ../../proj_esc/templates/showData.php?src=prof&update=1');
				    	}else{
							header('Location: ../../proj_esc/templates/showData.php?src=prof&update=0&erro2');
				    	}

				}else if($this->usuario->__get('tipo') == 2){
					header('Location: ../../proj_esc/templates/showData.php?src=admin&update=1');
				}
			}

		}


		catch(PDOException $e){

			if($this->usuario->__get('tipo') == 0){
				$this->conexao->rollBack();
					header('Location: ../../proj_esc/templates/showData.php?src=aluno&update=0');
			}else if($this->usuario->__get('tipo') == 1){
				var_dump($e);
				die;

					header('Location: ../../proj_esc/templates/showData.php?src=prof&update=0');
			}else if($this->usuario->__get('tipo') == 2){
					header('Location: ../../proj_esc/templates/showData.php?src=admin&update=0');
			}
		}
	}

	public function select(){

	}
}

?>