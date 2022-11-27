<?php
    namespace Tests;

    require_once("./proj_esc_func/model/User.php");
    require_once("./proj_esc_func/connection.php");
    require_once("./proj_esc_func/controllers/user_service.php");
    require_once("./proj_esc_func/controllers/autoload.php");

    
    use PHPUnit\Framework\TestCase;
    
    class UserServiceTest extends TestCase
    {
    	//[BEGIN] - SELECT TESTS

    	//Teste com Assert com nome correto (.)
        public function testFindById()
        {
        	$user = new \User();
        	$user->__set('id', 1);
            $userTest = new \UserService(new \Connection(), $user);
            $result = $userTest->findById('name');
            $this->assertEquals('Italo Ramillys', $result['name']);
        }

    	//Teste com Assert com nome incorreto (F)
        public function testFindById2()
        {
        	$user = new \User();
        	$user->__set('id', 1);
            $userTest = new \UserService(new \Connection(), $user);
            $result = $userTest->findById('name');
            $this->assertEquals('Raimundo Ramillys', $result['name']);
        }    	
        //[END] - SELECT TESTS


    	//[BEGIN] - INSERT TESTS
    	//Teste com e-mail duplicado (E)
    	public function testInsertAluno()
        {
        	$user = new \User();
        	//$user->__set('id', 1);
        	$user->__set('obs', 'Nenhuma');
        	$user->__set('login', 'testeunitario1');
        	$user->__set('pass', 'testeunitario1');
        	$user->__set('name', 'Usuario de Teste');
        	$user->__set('last_name', 'Silva');
        	$user->__set('birth', '2002-11-11');
        	$user->__set('blood', 'A+');
        	$user->__set('genre', 'M');
        	$user->__set('document', '06334592327');
        	$user->__set('email', 'italoramillys@gmail.com');
        	$user->__set('id_author_insert', 1);
        	$user->__set('id_author_update', null);
        	$user->__set('address', 'Rua A');
        	$user->__set('img_profile', '/padrao/image.png');
        	$user->__set('type', 0);
        	$user->__set('status', 1);
        	$user->__set('std_style', 1);
        	//$user->__set('create_at', null);
        	//$user->__set('update_at', null);
            $userTest = new \UserService(new \Connection(), $user);
            $userTest->insert();
            $result = $userTest->findByParam("name","Usuario de Teste"	);
            $this->assertEquals('testeunitario', $result['login']);
        }   

    	//Teste com insert válido, mas com o Assert errado (F)
		public function testInsertAluno2()
        {
        	$user = new \User();
        	//$user->__set('id', 1);
        	$user->__set('obs', 'Usuario que deve entrar');
        	$user->__set('login', 'testeunitario2');
        	$user->__set('pass', 'testeunitario2');
        	$user->__set('name', 'Usuario de Teste');
        	$user->__set('last_name', 'Silva');
        	$user->__set('birth', '2002-11-11');
        	$user->__set('blood', 'A+');
        	$user->__set('genre', 'M');
        	$user->__set('document', '06334592327');
        	$user->__set('email', 'testeunitario@gmail.com');
        	$user->__set('id_author_insert', 1);
        	$user->__set('id_author_update', null);
        	$user->__set('address', 'Rua A');
        	$user->__set('img_profile', '/padrao/image.png');
        	$user->__set('type', 0);
        	$user->__set('status', 1);
        	$user->__set('std_style', 1);
        	//$user->__set('create_at', null);
        	//$user->__set('update_at', null);
            $userTest = new \UserService(new \Connection(), $user);
            $userTest->insert();
            $result = $userTest->findByParam("email", "login");
            $this->assertEquals('testeunitario', $result['login']);
        }   

    	//[END] - INSERT TESTS

    }
?>