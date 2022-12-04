<?php
    namespace Tests;

    session_start();
    $_SESSION['user_id'] = 1;
    require_once("./proj_esc_func/model/User.php");
    require_once("./proj_esc_func/connection.php");
    require_once("./proj_esc_func/controllers/user_service.php");
    require_once("./proj_esc_func/controllers/autoload.php");
    
    use PHPUnit\Framework\TestCase;
    
    /*

    Todas as senhas foram alteradas para 123456789, pois no doc4 tinhamos decidido utilizar o valor 123, 
    mas dessa forma a senha é considerada fraca e o usuário não é inserido e nao conseguiríamos fazer um teste
    mais próximo da realidade.

    */

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
        //Caso de Teste: CAT 006 SEM O UPLOAD DA IMAGEM, porém considerar o caminho salvo em img_profile
    	public function testInsertUsuario()
        {
        	$user = new \User();
        	//$user->__set('id', 1);
        	$user->__set('obs', 'user');
        	$user->__set('login', 'user');
        	$user->__set('pass', '123456789');
        	$user->__set('name', 'user');
        	$user->__set('last_name', 'user');
        	$user->__set('birth', '1999-04-20');
        	$user->__set('blood', 'A+');
        	$user->__set('genre', 'F');
        	$user->__set('document', '00000000000');
        	$user->__set('email', 'user@gmail.com');
        	$user->__set('id_author_insert', 1);
        	$user->__set('id_author_update', null);
        	$user->__set('address', 'Centro');
            $user->__set('img_profile', 'usuario/2022/09/abc.jpg');
        	$user->__set('type', 0);
        	$user->__set('status', 1);
        	$user->__set('std_style', 1);
        	//$user->__set('create_at', null);
        	//$user->__set('update_at', null);
            $userTest = new \UserService(new \Connection(), $user);
            $userTest->insert();
            $result = $userTest->findByParam("email, document","email");
            $this->assertEquals('00000000000', $result['document']);
        }   

        //Caso de Teste: CAT 007
        //É esperado que nao encontre o usuário, pois não deve ser inserido
        public function testInsertUsuario2()
        {
        	$user = new \User();
        	//$user->__set('id', 1);
        	$user->__set('obs', '');
        	$user->__set('login', 'user1');
        	$user->__set('pass', '123456789');
        	$user->__set('name', null);
        	$user->__set('last_name', 'user');
        	$user->__set('birth', '');
        	$user->__set('blood', 'A+');
        	$user->__set('genre', 'F');
        	$user->__set('document', '00000000001');
        	$user->__set('email', 'user1@gmail.com');
        	$user->__set('id_author_insert', 1);
        	$user->__set('id_author_update', null);
        	$user->__set('address', 'Centro');
        	$user->__set('img_profile', '');
        	$user->__set('type', 0);
        	$user->__set('status', 1);
        	$user->__set('std_style', 1);
        	//$user->__set('create_at', null);
        	//$user->__set('update_at', null);
            $userTest = new \UserService(new \Connection(), $user);
            $userTest->insert();
            $result = $userTest->findByParam("document", "document");
            $this->assertEquals(false, $result);
        }   

        //Caso de Teste: CAT 008
        //É esperado que nao encontre o usuário, pois não deve ser inserido, pois a imagem é um campo obrigatório
        //Quando um usuário nao é encontrado é retornado o valor falso, por isso o valor esperado é false
        public function testInsertUsuario3()
        {
            $user = new \User();
            //$user->__set('id', 1);
            $user->__set('obs', '');
            $user->__set('login', 'user2');
            $user->__set('pass', '123456789');
            $user->__set('name', 'user');
            $user->__set('last_name', 'user');
            $user->__set('birth', '1999-04-20');
            $user->__set('blood', 'A+');
            $user->__set('genre', 'F');
            $user->__set('document', '00000000002');
            $user->__set('email', 'user2@gmail.com');
            $user->__set('id_author_insert', 1);
            $user->__set('id_author_update', null);
            $user->__set('address', 'Centro');
            $user->__set('img_profile', null);
            $user->__set('type', 0);
            $user->__set('status', 1);
            $user->__set('std_style', 1);
            //$user->__set('create_at', null);
            //$user->__set('update_at', null);
            $userTest = new \UserService(new \Connection(), $user);
            $userTest->insert();
            $result = $userTest->findByParam("document", "document");
            $this->assertEquals(false, $result);
        }   

    	//[END] - INSERT TESTS


        //[BEGIN] - UPDATE TESTS

        //Caso de Teste: CAT 009
        //Primeiro inserimos um usuário
        //Em sequência utilizamos o mesmo usuário para realizar o update
        //O update nao deve ser realizado, logo os dados do Assert devem ser iguais aos do insert
        public function testUpdateUsuario()
        {
            $user = new \User();
            //$user->__set('id', 1);
            $user->__set('obs', '');
            $user->__set('login', 'userReal');
            $user->__set('pass', '123456789');
            $user->__set('name', 'ItaloTestePHPUnit');
            $user->__set('last_name', 'user');
            $user->__set('birth', '1999-04-20');
            $user->__set('blood', 'A+');
            $user->__set('genre', 'F');
            $user->__set('document', '00000000005');
            $user->__set('email', 'userReal@gmail.com');
            $user->__set('id_author_insert', 1);
            $user->__set('id_author_update', null);
            $user->__set('address', 'Centro');
            $user->__set('img_profile', 'usuario/2022/09/abc.jpg');
            $user->__set('type', 0);
            $user->__set('status', 1);
            $user->__set('std_style', 1);
            //$user->__set('create_at', null);
            //$user->__set('update_at', null);
            $userTest = new \UserService(new \Connection(), $user);
            $userTest->insert();

            $user->__set('name', '');
            $result = $userTest->findByParam("document, name", "document");
            $this->assertEquals('ItaloTestePHPUnit', $result['name']);
        } 

        //Caso de Teste: CAT 010
        //Primeiro inserimos um usuário
        //Em sequência utilizamos o mesmo usuário para realizar o update
        //O update nao deve ser realizado, logo os dados do Assert devem ser iguais aos do insert
        //Para vermos nos logs do teste como o nome nao mudou, irei fazer o assert errado e no log mostrará:
        //-'ItaloTestePHPUnit' 
        //+'ItaloTestePHPUnit2'
        public function testUpdateUsuario2()
        {
            $user = new \User();
            //$user->__set('id', 1);
            $user->__set('obs', '');
            $user->__set('login', 'userReal2');
            $user->__set('pass', '123456789');
            $user->__set('name', 'ItaloTestePHPUnit2');
            $user->__set('last_name', 'user2');
            $user->__set('birth', '1999-04-20');
            $user->__set('blood', 'A+');
            $user->__set('genre', 'F');
            $user->__set('document', '00000000019');
            $user->__set('email', 'userReal2@gmail.com');
            $user->__set('id_author_insert', 1);
            $user->__set('id_author_update', null);
            $user->__set('address', 'Centro');
            $user->__set('img_profile', 'usuario/2022/09/abc.jpg');
            $user->__set('type', 0);
            $user->__set('status', 1);
            $user->__set('std_style', 1);
            //$user->__set('create_at', null);
            //$user->__set('update_at', null);
            $userTest = new \UserService(new \Connection(), $user);
            $userTest->insert();
            
            $result = $userTest->findByParam("id, name, img_profile, pass, last_name, birth, blood, genre, address, email, document, name", "document");

            $user->__set('id', $result['id']);
            $user->__set('name', null);
            $user->__set('login', null);
            $user->__set('pass', null);
            $user->__set('last_name', null);
            $user->__set('birth', null);
            $user->__set('blood', null);
            $user->__set('genre', null);
            $user->__set('document', null);
            $user->__set('email', null);
            $user->__set('id_author_update', 1);
            $user->__set('address', null);
            $user->__set('img_profile', null);

            $userTest2 = new \UserService(new \Connection(), $user);
            $userTest2->update();

            $result = $userTest2->findById("name");
            $this->assertEquals('ItaloTestePHPUnit', $result['name']);
        } 

        //[END] - UPDATE TESTS

        //[BEGIN] - DELETE TESTS

        //Caso de Teste: CAT 011
        //Primeiro inserimos um usuário
        //Em sequência utilizamos o mesmo usuário para realizar o delete
        //O usuário sempre pode ser deletado a menos que exista outro registro que tenha relação com ele,
        //Nessa situação é aconselhado apenas desativar o usuário   
        //Quando um usuário nao é encontrado é retornado o valor falso, por isso o valor esperado é false
        public function testDeleteUsuario()
        {
            $user = new \User();
            //$user->__set('id', 1);
            $user->__set('obs', '');
            $user->__set('login', 'userRealDelete');
            $user->__set('pass', '123456789');
            $user->__set('name', 'ItaloTestePHPUnitDel');
            $user->__set('last_name', 'user3');
            $user->__set('birth', '1999-04-20');
            $user->__set('blood', 'A+');
            $user->__set('genre', 'F');
            $user->__set('document', '00000000055');
            $user->__set('email', 'userRealDEL@gmail.com');
            $user->__set('id_author_insert', 1);
            $user->__set('id_author_update', null);
            $user->__set('address', 'Centro');
            $user->__set('img_profile', 'usuario/2022/09/abc.jpg');
            $user->__set('type', 0);
            $user->__set('status', 1);
            $user->__set('std_style', 1);
            //$user->__set('create_at', null);
            //$user->__set('update_at', null);
            $userTest = new \UserService(new \Connection(), $user);
            $userTest->insert();
            
            $result = $userTest->findByParam("id, login, name, img_profile, pass, last_name, birth, blood, genre, address, email, document, name", "document", "document");

            $user->__set('id', $result['id']);
            $userTest->delete();

            $result2 = $userTest->findById($result['id']);

            $this->assertEquals(false, $result2);
        } 

        //[END] - DELETE TESTS


    }
?>