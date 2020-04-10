<?php 

class Conexao{

	public $hostname = 'localhost';
	public $bancodedados = 'sepo';
	public $usuario = 'root';
	public $senha = '';


	public function conectar(){
		try{
			$conexao = new PDO(
				"mysql:host=$this->hostname;dbname=$this->bancodedados",
				"$this->usuario",
				"$this->senha"
			);

			return $conexao;
		}catch(PDOException $e){
			echo '<p>Erro de conexão: <br><pre>'. var_dump($e). '</pre></p>';
		}
	}
}

?>