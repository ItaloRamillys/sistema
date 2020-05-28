<?php
require "autoload.php";

use Helpers\Message;

class RecorrenciaAulaService{

	private $conexao;
	private $rec_aula;
	private $message;

	public function __construct(Conexao $conexao, ReccorrenciaAula $rec_aula){
		$this->conexao = $conexao->conectar();
		$this->rec_aula = $rec_aula;
	}

	public function insert(){

		$query = "insert into rec_aula(dia_da_semana,horario_de_inicio,horario_de_termino,id_DT) values(:dia_da_semana,:horario_de_inicio,:horario_de_termino,:id_DT)";
			
	    	$stmt = $this->conexao->prepare($query);

	    	$stmt->bindValue(':dia_da_semana', $this->rec_aula->__get('dia_da_semana'));
	    	$stmt->bindValue(':horario_de_inicio', $this->rec_aula->__get('horario_de_inicio'));
	    	$stmt->bindValue(':horario_de_termino', $this->rec_aula->__get('horario_de_termino'));
	    	$stmt->bindValue(':id_DT', $this->rec_aula->__get('id_DT'));

	    	$this->message = new Message();

			if($stmt->execute()){
				$text = "Aula cadastrada com sucesso";	
				$this->message->success($text);			
			}else{
				$text = "Falha ao cadastrar aula";
				$this->message->error($text);
			}

			return $this->message->render();
	}

	public function delete(){
			
			$id_del = $this->rec_aula->__get('id');

			$query = "delete from rec_aula where id_rec_aula = " . $id_del;

			$stmt = $this->conexao->prepare($query);

			if($stmt->execute()){
				header('Location: ../../proj_esc/templates/showData.php?src=rec_aula&delete=1');
			}else{
				header('Location: ../../proj_esc/templates/showData.php?src=rec_aula&delete=0');
			} 
	}

	public function update(){
		try{

			$id_up = $this->rec_aula->__get('id');

			$adjunct_query = "";

			if($this->rec_aula->__get('path') != ''){
				$adjunct_query = ", path_img = :path_img";
				$path_img 	 	= $this->rec_aula->__get('path');
			}

			$query = "update rec_aula set title_rec_aula = :title_rec_aula, desc_rec_aula = :desc_rec_aula , update_at = :update_at " .$adjunct_query. " where id_rec_aula = " . $id_up;

	    	$stmt = $this->conexao->prepare($query);

	    	$title_rec_aula 	= $this->rec_aula->__get('title');
			$desc_rec_aula 		= $this->rec_aula->__get('desc');
			$update_at 	 	= $this->rec_aula->__get('update_at');

	    	$stmt->bindParam(':title_rec_aula', $title_rec_aula, PDO::PARAM_STR); 
	    	$stmt->bindParam(':desc_rec_aula', $desc_rec_aula, PDO::PARAM_STR); 
			$stmt->bindParam(':update_at', $update_at, PDO::PARAM_STR);

	    	if($this->rec_aula->__get('path') != ''){
	    		$stmt->bindParam(':path_img', $path_img, PDO::PARAM_STR); 
			}

	    	if($stmt->execute()){

			    header('Location: ../../proj_esc/templates/showData.php?src=rec_aula&update=1');
	    	}
		}catch(PDOException $e){
			 header('Location: ../../proj_esc/templates/showData.php?src=rec_aula&update=0');
		}
	}

	public function select(){

	}
}

?>