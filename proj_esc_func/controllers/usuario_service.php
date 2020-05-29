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

		try{

			$erro = 0;
			$errors = 'Erro: ';

			$checkCpf   = $this->checkDuplicateData('cpf', $this->usuario->__get('cpf'));
			$checkEmail = $this->checkDuplicateData('email', $this->usuario->__get('email'));
			$checkLogin = $this->checkDuplicateData('login', $this->usuario->__get('login'));

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

			$query = "insert into usuario(login, senha, nome, sobrenome, data_nasc, tipo_sang, genero, cpf, endereco, email, tipo, img_profile) values(:usuario_login, :usuario_senha, :usuario_nome, :usuario_sobrenome, :usuario_data_nasc, :usuario_tipo_sangue, :usuario_genero, :usuario_cpf, :usuario_end, :usuario_email, :usuario_tipo, :usuario_img_profile)";

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
	
	public function checkDuplicateData($column, $data){
		$query = "select * from usuario where ".$column." = '".$data."'";
		
		$stmt = $this->conexao->query($query);
		
		$result = $stmt->fetchAll();

		return count($result);
	}

	public function delete(){

		$id_del = $this->usuario->__get('id');

		$this->message = new Message();

		$query_update = "update usuario SET status=0 where id = ".$id_del;
		$query_delete = "delete from usuario where id = ".$id_del;

		$msg_error = "Falha ao excluir usuário. Verifique sua conexão e se o usuário ainda está cadastrado no sistema.";

		if($this->usuario->__get('tipo') == 1){
			$query_verify = "select * from disc_turma where id_prof = " . $id_del;

			$stmt_verify = $this->conexao->query($query_verify);

			$result_verify = $stmt_verify->fetchAll();

			$count_result = count($result_verify);
			
			if($count_result){
				$stmt = $this->conexao->prepare($query_update);
				if($stmt->execute()){
					$text = "O usuario foi inativado do sistema, mas seus dados não foram apagados ainda, pois ele está cadastrado em uma turma como professor. Para excluir permanentemente é necessário excluí-lo novamente. Todos os dados serão apagados e o professor não conseguirá logar no sistema.";
					$this->message->warning($text);
				}else{
					$text = $msg_error;
					$this->message->error($text . " Dados encontrados.");
				}
			}else{
				$stmt = $this->conexao->prepare($query_delete);
				if($stmt->execute()){
					$text = "O usuario foi excluído com sucesso.";
					$this->message->success($text);
				}else {
					$text = $msg_error;
					$this->message->error($text . " Dados não encontrados.");
				}
			}

		}elseif($this->usuario->__get('tipo') == 0){
			$query_verify = "select * from turma_aluno where id_aluno = " . $id_del;

			$stmt_verify = $this->conexao->query($query_verify);

			$result_verify = $stmt_verify->fetchAll();

			$count_result = count($result_verify);
			
			if($count_result){
				$stmt = $this->conexao->prepare($query_update);
				if($stmt->execute()){
					$text = "O usuario foi inativado do sistema, mas seus dados não foram apagados ainda, pois ele está cadastrado em pelo menos uma turma como aluno. Para excluir permanentemente é necessário excluí-lo novamente. Todos os dados serão apagados e o aluno não conseguirá logar no sistema.";
					$this->message->warning($text);
				}else{
					$text = $msg_error;
					$this->message->error($text);
				}
			}else{
				$stmt = $this->conexao->prepare($query_delete);
				if($stmt->execute()){
					$text = "O usuario foi excluído com sucesso.";
					$this->message->success($text);
				}else {
					$text = $msg_error;
					$this->message->error($text);
				}
			}
		}elseif($this->usuario->__get('tipo') == 2){
			$stmt = $this->conexao->prepare($query_update);
			if($stmt->execute()){
				$text = "O usuario foi excluído com sucesso.";
				$this->message->success($text);
			}else {
				$text = $msg_error;
				$this->message->error($text);
			}
		}

		return $this->message->render();	

	}

	public function update(){
		
		try{

			$id_up = $this->usuario->__get('id');

			$completa_query = "";

			if($this->usuario->__get('img_profile')!= ''){
				$completa_query = ", img_profile = :img_profile";
			}

			$query = "update usuario set login = :login, senha = :senha, nome = :nome, sobrenome = :sobrenome, data_nasc = :data_nasc, tipo_sang = :tipo_sangue, genero = :genero, rg = :rg, cpf = :cpf, endereco = :end,  update_at = :update_at, email = :email".$completa_query." where id = " . $id_up;
			
						
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

	    	$stmt->execute();
			
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