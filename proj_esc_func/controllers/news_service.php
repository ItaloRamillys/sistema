<?php

class NewsService{

	private $conexao;
	private $news;

	public function __construct(Conexao $conexao, news $news){
		$this->conexao = $conexao->conectar();
		$this->news = $news;
	}

	public function insert(){

		$query = "insert into news(title_news, desc_news, id_author, path_img, create_at, update_at) values(:title, :desc, :author, :path_img, :create_at, :update_at)";
			
	    	$stmt = $this->conexao->prepare($query);

	    	$stmt->bindValue(':title', $this->news->__get('title'));
	    	$stmt->bindValue(':desc', $this->news->__get('desc'));
	    	$stmt->bindValue(':author', $this->news->__get('author'));
	    	$stmt->bindValue(':path_img', $this->news->__get('path'));
	    	$stmt->bindValue(':create_at', $this->news->__get('create_at'));
	    	$stmt->bindValue(':update_at', $this->news->__get('update_at'));

			return $stmt->execute();
	}

	public function delete(){
			
			$id_del = $this->news->__get('id');

			$query = "delete from news where id_news = " . $id_del;

			$stmt = $this->conexao->prepare($query);

			if($stmt->execute()){
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=1');
			}else{
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=0');
			} 
	}

	public function update(){
		try{

			$id_up = $this->news->__get('id');

			$adjunct_query = "";

			if($this->news->__get('path') != ''){
				$adjunct_query = ", path_img = :path_img";
				$path_img 	 	= $this->news->__get('path');
			}

			$query = "update news set title_news = :title_news, desc_news = :desc_news , update_at = :update_at " .$adjunct_query. " where id_news = " . $id_up;

	    	$stmt = $this->conexao->prepare($query);

	    	$title_news 	= $this->news->__get('title');
			$desc_news 		= $this->news->__get('desc');
			$update_at 	 	= $this->news->__get('update_at');

	    	$stmt->bindParam(':title_news', $title_news, PDO::PARAM_STR); 
	    	$stmt->bindParam(':desc_news', $desc_news, PDO::PARAM_STR); 
			$stmt->bindParam(':update_at', $update_at, PDO::PARAM_STR);

	    	if($this->news->__get('path') != ''){
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