<?php
require "autoload.php";

use Helpers\Message;

class NoticiaService{

	private $conexao;
	private $noticia;
	private $message;

	public function __construct(Conexao $conexao, Noticia $noticia){
		$this->conexao = $conexao->conectar();
		$this->noticia = $noticia;
	}

	public function insert(){

		$erro = 0;
		$errors = 'Erro: ';

		$checkTitle  = $this->checkDuplicateData("noticia", "titulo_ntc", $this->noticia->__get('titulo'));
		$checkSlug   = $this->checkDuplicateData("noticia", "slug", $this->noticia->__get('slug'));
		
		if($checkTitle){
			$erro++;
			$errors .= ' Titulo duplicado.';
		}
		if($checkSlug){
			$erro++;
			$errors .= ' Slug duplicado.';
		}

		$query = "insert into noticia(titulo_ntc, slug, desc_ntc, id_resp, path_img) values(:titulo, :slug, :desc, :autor, :path)";
			
	    	$stmt = $this->conexao->prepare($query);

	    	$stmt->bindValue(':titulo', $this->noticia->__get('titulo'));
	    	$stmt->bindValue(':slug', $this->noticia->__get('slug'));
	    	$stmt->bindValue(':desc', $this->noticia->__get('desc'));
	    	$stmt->bindValue(':autor', $this->noticia->__get('autor'));
	    	$stmt->bindValue(':path', $this->noticia->__get('path'));

	    	$this->message = New Message();

	    	if($stmt->execute() && $erro == 0){
				$text = 'Notícia cadastrada com sucesso';
				$this->message->success($text);
			}else{
				$text = 'Falha ao cadastrar notícia. '.$errors;
				$this->message->error($text);
				unlink("C:/xampp/htdocs/sistema/img/".$this->noticia->__get('path'));
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
			
			$id_del = $this->noticia->__get('id');

			$query = "delete from noticia where id_ntc = " . $id_del;

			$stmt = $this->conexao->prepare($query);

			if($stmt->execute()){
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=1');
			}else{
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=0');
			} 
	}

	public function update(){
		try{

			$id_up = $this->noticia->__get('id');

			$completa_query = "";

			
			if($this->noticia->__get('path') != ''){

				$completa_query = ", path_img = :path_img";
				$path_img 	 	= $this->noticia->__get('path');
			}

			$query = "update noticia set titulo_ntc = :titulo_ntc, desc_ntc = :desc_ntc , update_at = :update_at " .$completa_query. " where id_ntc = " . $id_up;

	    	$stmt = $this->conexao->prepare($query);

	    	$tempo = time('d/m/Y');

	    	$titulo_ntc 	= $this->noticia->__get('titulo');
			$desc_ntc 		= $this->noticia->__get('desc');
			$update_at 	 	= $this->noticia->__get('update_at');

	    	$stmt->bindParam(':titulo_ntc', $titulo_ntc, PDO::PARAM_STR); 
	    	$stmt->bindParam(':desc_ntc', $desc_ntc, PDO::PARAM_STR); 
			$stmt->bindParam(':update_at', $update_at, PDO::PARAM_STR);

	    	if($this->noticia->__get('path') != ''){
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