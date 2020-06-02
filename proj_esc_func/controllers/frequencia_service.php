<?php
require "autoload.php";

use Helpers\Message;


class FrequenciaService{

	private $conexao;
	private $frequencia;
	private $message;

	public function __construct(Conexao $conexao, Frequencia $frequencia){
		$this->conexao = $conexao->conectar();
		$this->frequencia = $frequencia;
	}

	public function insert(){

		$query = "";
		$this->message = new Message();

		$array_ids = $this->frequencia->id_aluno;
		$array_tipos = $this->frequencia->tipo_falta;

		$id_DT = $this->frequencia->id_DT;
		$data = $this->frequencia->data;

		foreach ($array_ids[0] as $key => $value) {
			$query .= "insert into frequencia2(id_aluno, data, tipo_falta, id_DT) values(:id_aluno".$key.", :data".$key.", :tipo_falta".$key.",  :id_DT".$key.");";
		}

		if ($query == "") {
			$text = "Frequência cadastrada com sucesso.";
			$this->message->success($text);
		}
			
    	$stmt = $this->conexao->prepare($query);

    	foreach ($array_ids[0] as $key => $value) {
			$stmt->bindValue(":id_aluno".$key, $value);
			$stmt->bindValue(":data".$key, $data);
			$stmt->bindValue(":id_DT".$key, $id_DT);
		}

		foreach ($array_tipos[0] as $key => $value) {
			$stmt->bindValue(":tipo_falta".$key, $value);
		}

		if($stmt->execute()){
			$text = "Frequência cadastrada com sucesso.";
			$this->message->success($text);
		}else{
			$text = "Falha ao cadastrar frequência";
			$this->message->error($text);
		}
	}

	public function delete(){
			
			$id_del = $this->frequencia->__get('id');

			$query = "delete from frequencia where id_ntc = " . $id_del;

			$stmt = $this->conexao->prepare($query);

			if($stmt->execute()){
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=1');
			}else{
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=0');
			} 
	}

	public function update(){
		try{

			$id_up = $this->frequencia->__get('id');

			$completa_query = "";

			
			if($this->frequencia->__get('path') != ''){

				$completa_query = ", path_img = :path_img";
				$path_img 	 	= $this->frequencia->__get('path');
			}

			$query = "update frequencia set titulo_ntc = :titulo_ntc, desc_ntc = :desc_ntc , update_at = :update_at " .$completa_query. " where id_ntc = " . $id_up;

	    	$stmt = $this->conexao->prepare($query);

	    	$tempo = time('d/m/Y');

	    	$titulo_ntc 	= $this->frequencia->__get('titulo');
			$desc_ntc 		= $this->frequencia->__get('desc');
			$update_at 	 	= $this->frequencia->__get('update_at');

	    	$stmt->bindParam(':titulo_ntc', $titulo_ntc, PDO::PARAM_STR); 
	    	$stmt->bindParam(':desc_ntc', $desc_ntc, PDO::PARAM_STR); 
			$stmt->bindParam(':update_at', $update_at, PDO::PARAM_STR);

	    	if($this->frequencia->__get('path') != ''){
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