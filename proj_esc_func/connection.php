<?php 
class Connection{

	public $hostname = 'localhost';
	public $db = 'system';
	public $user = 'root';
	public $pass = '';

	private $connection;

	public function connect(){

		if(empty($this->connection)){
			try{
			$connection = new PDO(
				"mysql:host=$this->hostname;dbname=$this->db",
				"$this->user",
				"$this->pass"
			);

				return $connection;
			}catch(PDOException $e){
				echo '<p>Erro de conexão: <br><pre>'. var_dump($e). '</pre></p>';
			}
		}
		return $connection;
	}
}

?>