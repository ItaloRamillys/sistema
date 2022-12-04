<?php

    namespace Tests;

    require_once("./proj_esc_func/model/News.php");
    require_once("./proj_esc_func/connection.php");
    require_once("./proj_esc_func/controllers/news_service.php");
    require_once("./proj_esc_func/controllers/autoload.php");
    
    use PHPUnit\Framework\TestCase;
    
    class NewsServiceTest extends TestCase
    {
    	
        //[BEGIN] - DELETE TESTS
        //Caso de Teste: CAT 019 EXCLUSAO DE NOTICIA
        public function testInsertNews()
        {
            $news = new \News();
            //$news->__set('id', 1);
            $news->__set('title_news', 'Noticia Teste Unit');
            $news->__set('slug_news', 'desc_teste_unit2');
            $news->__set('desc_news', 'Desc Noticia Teste');
            $news->__set('author_news', 1);
            //$news->__set('create_at', null);
            //$news->__set('update_at', null);
            $newsTest = new \NewsService(new \Connection(), $news);
            $newsTest->insert();

            $result = $newsTest->findByParam('id_news','title_news');

            $news->__set('id_news', $result['id_news']);
            $newsTest->delete();

            $result2 = $newsTest->findById('title_news');
            $this->assertEquals(false, $result2);
        }   
        
        //[END] - DELETE TESTS


        //[BEGIN] - UPDATE TESTS
        //Caso de Teste: CAT 019 EDICAO DE NOTICIA
        public function testUpdateNews()
        {
            $news = new \news();
            //$news->__set('id', 1);
            $news->__set('title_news', 'Noticia Teste Unit2998');
            $news->__set('slug_news', 'desc_teste_unit2998');
            $news->__set('desc_news', 'Desc Noticia Teste2');
            $news->__set('author_news', 1);
            //$news->__set('create_at', null);
            //$news->__set('update_at', null);
            $newsTest = new \NewsService(new \Connection(), $news);
            $newsTest->insert();

            $result = $newsTest->findByParam('id_news','title_news');
            $news->__set('id_news', $result['id_news']);
            $news->__set('title_news', null);
            $newsTest->update();
            $result2 = $newsTest->findByParam('desc_news','title_news');

            $this->assertEquals('Desc Noticia Teste2', $result2['desc_news']);
        }   
        
        //[END] - UPDATE TESTS

    }
?>