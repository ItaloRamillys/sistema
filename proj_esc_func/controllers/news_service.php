<?php
require "autoload.php";

use Helpers\Message;

class NewsService{

	private $conn;
	private $news;
	private $message;

	public function __construct(Connection $conn, news $news){
		$this->conn = $conn->connect();
		$this->news = $news;
	}

	public function insert(){

		$erro = 0;
		$errors = 'Erro: ';

		$checkTitle  = $this->checkDuplicateData("news", "title_news", $this->news->__get('title_news'));
		$checkSlug   = $this->checkDuplicateData("news", "slug_news", $this->news->__get('slug_news'));
		
		if($checkTitle){
			$erro++;
			$errors .= ' Titulo duplicado.';
		}
		if($checkSlug){
			$erro++;
			$errors .= ' Slug duplicado.';
		}

		$query = "insert into news(title_news, slug_news, desc_news, id_author, img_news) values(:title_news, :slug_news, :desc_news, :author_news, :img_news)";
			
	    	$stmt = $this->conn->prepare($query);

	    	$stmt->bindValue(':title_news', $this->news->__get('title_news'));
	    	$stmt->bindValue(':slug_news', $this->news->__get('slug_news'));
	    	$stmt->bindValue(':desc_news', $this->news->__get('desc_news'));
	    	$stmt->bindValue(':author_news', $this->news->__get('author_news'));
	    	$stmt->bindValue(':img_news', $this->news->__get('img_news'));

	    	$this->message = New Message();

	    	if($stmt->execute() && $erro == 0){
				$text = 'Notícia cadastrada com sucesso';
				$this->message->success($text);
			}else{
				$err = implode("", $stmt->errorInfo());
				$text = 'Falha ao cadastrar notícia. '.$errors;
				$this->message->error($text . " -> " . $err);
				unlink("C:/xampp/htdocs/sistema/img/".$this->news->__get('img_news'));
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
			
			$id_del = $this->news->__get('id');

			$query = "delete from news where id_news = " . $id_del;

			$stmt = $this->conn->prepare($query); 
	}

	public function update(){
		$id_up = $this->news->__get('id_news');
		
		$completa_query = "";
		if($this->news->__get('img_news') != ''){
			$completa_query = ", img_news = :img_news";
			$img_news_img 	 	= $this->news->__get('img_news');
		}

		$query = "update news set title_news = :title_news, desc_news = :desc_news, slug_news = :slug_news " .$completa_query. " where id_news = " . $id_up;

    	$stmt = $this->conn->prepare($query);

    	$title_news 	= $this->news->__get('title_news');
		$desc_news 		= $this->news->__get('desc_news');
		$slug_news 		= $this->news->__get('slug_news');

    	$stmt->bindParam(':title_news', $title_news, PDO::PARAM_STR); 
    	$stmt->bindParam(':desc_news', $desc_news, PDO::PARAM_STR); 
    	$stmt->bindParam(':slug_news', $slug_news, PDO::PARAM_STR); 

    	if($this->news->__get('img_news') != ''){
    		$stmt->bindParam(':img_news', $img_news_img, PDO::PARAM_STR); 
		}

		$this->message = New Message();

    	if($stmt->execute()){
			$text = 'Notícia editada com sucesso';
			$this->message->success($text);
		}else{
			$err = implode("", $stmt->errorInfo());
			$text = 'Falha ao editar notícia.';
			$this->message->error($text . " -> " . $err);
		}
		
		return $this->message->render();
	}

	public function select(){

	}
}

?>