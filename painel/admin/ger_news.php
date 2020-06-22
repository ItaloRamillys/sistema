<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="box"> 
                <header class="div-title-box">
                    <h1 class="title-box-main  d-flex justify-content-center">Gerenciar Noticias</h1>
                </header>
               
                <div class="col-12 p-0 m-0">

                    <?php 

                        $tabela = "noticia";

                        $query = "select * from ".$tabela;
                           
                        $stmt = $conexao->query($query);

                        if ($stmt->rowCount() > 0) {
                        $res = "<section>";

                            $res .= "<table id='tabela-scroll' class='table table-hover'><thead><tr><th>Imagem</th><th class='text-center'>Título</th><th class='text-center'>Autor</th><th class='text-center'>Ações</th></tr></thead><tbody>";
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    
                                    $id_author = $row['id_resp'];
                                    $query_author = "select nome, sobrenome from usuario where id = " . $id_author;
                                    $stmt_author = $conexao->query($query_author);
                                    $row_author = $stmt_author->fetch(PDO::FETCH_ASSOC);
                                    
                                    $author = $row_author['nome'] . " " . $row_author['sobrenome'];
                                    $titulo = $row['titulo_ntc'];
                                    $img_news = $row['path_img'];
                                    $slug = $row['slug'];

                                    $res .= "<tr><td><img src='{$configBase}/../img/" . $img_news . "' style='height: 80px; width:80px; border-radius: 5px;'></td><td class='text-center'> ".$titulo."</td><td class='text-center'> ". $author ." </td><td class='text-center'><button class='btn btn-sm btn-danger m-1'><i class='far fa-trash-alt'></i></button><a href='{$configBase}/admin/editar_noticia/{$slug}' class='btn btn-sm btn-primary m-1'><i class='far fa-edit'></i></a></td></tr>";
                                }
                            $res .= "</tbody></table></section> 
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