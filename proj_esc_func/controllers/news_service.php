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

		$checkSlug   = $this->checkDuplicateData("news", "slug_news", $this->news->__get('slug_news'));
		
		$i = 1;
		$start_slug =  $this->news->__get('slug_news');
		while($checkSlug){
			$this->news->__set('slug_news', $start_slug."-".$i);
			$checkSlug  = $this->checkDuplicateData("news", "slug_news", $this->news->__get('slug_news'));
			$i++;
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
			$id_del = $this->news->__get('id_news');
			$id_to_del = $this->findByParam("id_news", "slug_news");

			$this->message = new Message();

			if(password_verify($id_to_del['id_news'], $id_del)){
				$query_delete = "delete from news where id_news = ".$id_to_del['id_news'];
				$stmt = $this->conn->query($query_delete);
				if($stmt->execute()){
					$text = "Notícia excluída com sucesso";
					$this->message->success($text);
				}else {
					$text = "Falha ao excluir notícia";
					$this->message->error($text);
				}
			}else{
				$text = "Falha de segurança. O id inserido não pertence a uma notícia válida.";
				$this->message->error($text);
			}
			return $this->message->render();	 
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

    	$last_img = ""; 
    	if($this->news->__get('img_news') != ''){
    		$stmt->bindParam(':img_news', $img_news_img, PDO::PARAM_STR);
			$query_last_img = "select img_news from news where id_news = " . $id_up;
			$stmt_last_img  = $this->conn->query($query_last_img);
			$row_last_img   = $stmt_last_img->fetch(PDO::FETCH_ASSOC);  
			$last_img       = $row_last_img['img_news'];
		}

		$this->message = New Message();

    	if($stmt->execute()){
			$text = 'Notícia editada com sucesso';
			$this->message->success($text);
			if($last_img){
				unlink(__DIR__ . "/../../img/" . $last_img);
			}
		}else{
			$err = implode("", $stmt->errorInfo());
			$text = 'Falha ao editar notícia.';
			$this->message->error($text . " -> " . $err);
		}
		
		return $this->message->render();
	}

	public function select(){

	}

	public function findByParam($fields, $string_param){
		$query = "select " . $fields . " from news where " . $string_param . " = '" . $this->news->__get($string_param) . "'";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
        	return $result;
        }
        return $stmt->errorInfo();
	}

	public function findById($fields){
		$query = "select " . $fields . " from news where id_news = " . $this->news->__get('id_news');
        $stmt = $this->conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
        	return $result;
        }
        return false;
	}
}

?>
