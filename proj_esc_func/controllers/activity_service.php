<?php
require "autoload.php";

use Helpers\Message;

class ActivityService{

	private $conn;
	private $activity;
	private $message;

	public function __construct(Connection $conn, Activity $activity){
		$this->conn = $conn->connect();
		$this->activity = $activity;
	}

	public function insert(){

		$query_attr = "";
		$query_bind = "";

		if(!is_null($this->activity->__get('file'))){
			$query_attr = ", file_activity";
			$query_bind = ", :file_activity";
		}

		$query = "insert into activity(title_activity, desc_activity, references_activity, id_author_activity, is_SC_activity {$query_attr}) values(:title_activity, :desc_activity, :references_activity, :id_author_activity, :is_SC_activity {$query_bind})";
			
	    	$stmt = $this->conn->prepare($query);

	    	$stmt->bindValue(':title_activity', $this->activity->__get('title_activity'));
	    	$stmt->bindValue(':desc_activity', $this->activity->__get('desc_activity'));
	    	$stmt->bindValue(':references_activity', $this->activity->__get('references_activity'));
	    	$stmt->bindValue(':id_author_activity', $this->activity->__get('id_author_activity'));
	    	$stmt->bindValue(':is_SC_activity', $this->activity->__get('is_SC_activity'));

	    	if(!is_null($this->activity->__get('arquivo'))){
				$stmt->bindValue(':path_file', $this->activity->__get('arquivo'));
			}

	    	$this->message = new Message();

			if($stmt->execute()){
				$text = 'Atividade cadastrada com sucesso.';
				$this->message->success($text);
			}else{
				$text = 'Falha ao cadastrar atividade.';
				$this->message->error($text . implode("",$stmt->errorInfo()));
			}

			return $this->message->render();
	}

	public function delete(){

	}

	public function update(){

	}

	public function select(){

	}
}

?>