<div class="container">
    <div class="row">
        <div class="col-12 p-0">
        <div class="box"> 
                <header class="div-title-box">
                    <h1 class="title-box-main  d-flex justify-content-center">Gerenciar Noticias</h1>
                </header>
               
                <div class="msg-aluno col-12 p-0">

                    <div class="container">
                    <?php 

                    $tabela = "noticia";

                    $query = "select * from ".$tabela;
                       
                    $stmt = $conexao->query($query);

                    if ($stmt->rowCount() > 0) {
                        
                        $res = "<section class='row'>
                                                <div class='col-md-3 col-12 px-3 pt-4 text-center'>
                                                   
                                                        Gerenciar contas <br>

                                                        <a href='cad_.php'> <button class='btn btn-outline-success btn-sm m-md-0 my-md-1 m-2'> + Adicionar</button></a>
                                                        <a href='showData.php?ordem_alfa=1&type='> <button class='btn btn-outline-primary btn-sm m-md-0 my-md-1 m-2'>Ordem alfabética</button></a>
                                                        <a href='showData.php?ordem_cad=1&type='> <button class='btn btn-outline-dark btn-sm m-md-0 my-md-1 m-2'>Ordem de cadastro</button></a>
                                                        
                                                    </div>
                                                <div class='col-md-9 col-12 p-0 pt-4'>
                                                    <div class='container'>
                                                        <div class='row'>
                                                    
                                            ";

                                        $stmt2 = $conexao->query($query);
                                        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                                            $desc = $row["desc_ntc"];
                                            
                                            if (strlen($desc) > 100) {

                                                $stringCut = substr($desc, 0, 100);
                                                $endPoint = strrpos($stringCut, ' ');
                                                $stringCut .= "[...]";
                                                $desc = $stringCut;

                                            }
                                            
                                            $titulo = $row['titulo_ntc'];
                                            $img_noticia = "http://localhost/sistema/img/" . $row['path_img'];
                                            $id_ntc = $row['id_ntc'];

                                            $res .= "
                                                <div class='container-box'>
                                                    <div class='box-dados-usu'>
                                                        <div class='box-img-usu'>
                                                            <img class='img-fluid' src='{$img_noticia}'>
                                                        </div>
                                                        <div class='box-nome-usu'>
                                                            {$titulo}
                                                        </div>
                                                        <div class='box-email-usu'>
                                                            {$desc}
                                                        </div>
                                                        <div class='box-btn-usu pt-2'>
                                                            <a href='editar_news.php?news_id={$id_ntc}&action=edit'><button class='btn btn-primary btn-sm'>Editar</button></a>
                                                            <a href='../controllers/noticia_controller.php?action=delete&news_id={$id_ntc}'><button  class='confirmation btn btn-danger btn-sm'>Excluir</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                      ";
                                        }

                                        $res .= "</div> </div> </div> </section> 
                                        <!-- Include jQuery - see http://jquery.com -->
                                        <script type='text/javascript'>
                                            $('.confirmation').on('click', function () {
                                                return confirm('Deseja realmente excluir?');
                                            });
                                        </script> ";
                                        
                                        echo $res;
                        } else {
                            echo "Nenhum(a) " .$tabela. "  cadastrado(a) nesta escola";
                        }
                       
                        ?>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>