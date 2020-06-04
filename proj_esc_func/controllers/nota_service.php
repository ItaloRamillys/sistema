<?php
require "autoload.php";

use Helpers\Message;

class NotaService{

	private $conexao;
	private $nota;
	private $message;

	public function __construct(Conexao $conexao, Nota $nota){
		$this->conexao = $conexao->conectar();
		$this->nota = $nota;
	}

	public function insert(){

		$query = "";
			
		$array_ids = $this->nota->id_aluno;
		$array_notas = $this->nota->nota;

		$id_DT = $this->nota->id_DT;
		$periodo = $this->nota->periodo;

		foreach ($array_ids as $key => $value) {
			$query .= "insert into disc_alu_turma(id_DT, id_aluno, periodo, nota) values(:id_DT".$key.", :id_aluno".$key.", :periodo".$key.", :nota".$key.");";
		}

		if ($query == "") {
			header('Location: ../../proj_esc/templates/cad_nota.php?cadastro=1');
			die;
		}

		$stmt = $this->conexao->prepare($query);

    	foreach ($array_ids as $key => $value) {
			$stmt->bindValue(":id_aluno".$key, $value);
			$stmt->bindValue(":periodo".$key, $periodo);
			$stmt->bindValue(":id_DT".$key, $id_DT);
		}
		foreach ($array_notas as $key => $value) {
			$stmt->bindValue(":nota".$key, $value);
		}

		$this->message = new Message();

		if($stmt->execute()){
			$text = "Nota cadastrada com sucesso.";
			$this->message->success($text);
		}else{
			$text = "Falha ao cadastrar nota.";
			$this->message->error($text);
		}

		return $this->message->render();
	}

	public function delete(){
			
			$id_del = $this->nota->__get('id');

			$query = "delete from nota where id_ntc = " . $id_del;

			$stmt = $this->conexao->prepare($query);

			if($stmt->execute()){
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=1');
			}else{
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=0');
			} 
	}

	public function update(){
		try{

			$id_up = $this->nota->__get('id');

			$completa_query = "";

			
			if($this->nota->__get('path') != ''){

				$completa_query = ", path_img = :path_img";
				$path_img 	 	= $this->nota->__get('path');
			}

			$query = "update nota set titulo_ntc = :titulo_ntc, desc_ntc = :desc_ntc , update_at = :update_at " .$completa_query. " where id_ntc = " . $id_up;

	    	$stmt = $this->conexao->prepare($query);

	    	$tempo = time('d/m/Y');

	    	$titulo_ntc 	= $this->nota->__get('titulo');
			$desc_ntc 		= $this->nota->__get('desc');
			$update_at 	 	= $this->nota->__get('update_at');

	    	$stmt->bindParam(':titulo_ntc', $titulo_ntc, PDO::PARAM_STR); 
	    	$stmt->bindParam(':desc_ntc', $desc_ntc, PDO::PARAM_STR); 
			$stmt->bindParam(':update_at', $update_at, PDO::PARAM_STR);

	    	if($this->nota->__get('path') != ''){
	    		$stmt->bindParam(':path_img', $path_img, PDO::PARAM_STR); 
			}

	    	if($stmt->execute()){

			    header('Location: ../../proj_esc/templates/showData.php?src=news&update=1');
	    	}
		}catch(PDOException $e){
			 header('Location: ../../proj_esc/templates/showData.php?src=news&update=0');
		}
	}

	public function select(){

	}
}

?>