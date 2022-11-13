<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="msg"></div>
            <div class="box"> 
                <header class="div-title-box">
                    <h1 class="title-box-main  d-flex justify-content-center">Gerenciar Notícias</h1>
                </header>
               
                <div class="col-12 p-0 m-0">

                    <?php 
                    if(isset($configUrl[2])){
                        $page = $configUrl[2];
                    }else{
                        $page = 1;
                    }

                    $limit = 10;
                    $query_total = "select count(*) from news";
                    $stmt_total = $conn->query($query_total);
                    $row_total = $stmt_total->fetch(PDO::FETCH_NUM);
                    $max_pages = ceil($row_total[0]/$limit);    
                    if($max_pages == 0){
                        $max_pages = 1;
                    }
                    if(($page > 0) && ($page <= $max_pages)){
                        $offset = ($page - 1)*$limit;

                        $query = "select * from news limit " . $limit . " offset " . $offset;
                        $stmt = $conn->query($query);

                        if($page > 1){
                            $has_before = "<a href='{$configBase}/admin/gerenciar_aluno/" . ($page - 1) . "' class=>Anterior</a>"; 
                        }else{
                            $has_before = "<p>Anterior</p>"; 
                        }

                        if(($page + 1) <= $max_pages){
                            $has_after = "<a href='{$configBase}/admin/gerenciar_aluno/" . ($page + 1) . "' class=>Próximo</a>"; 
                        }else{
                            $has_after = "<p>Proximo</p>"; 
                        }
                        if ($stmt->rowCount() > 0) {
                           $res = "<section><table id='table-scroll' class='table table-hover'><thead><tr><th>Imagem</th><th class='text-center'>Título</th><th class='text-center'>Autor</th><th class='text-center'>Ações</th></tr></thead><tbody>";
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    
                                    $id_author = $row['id_author'];
                                    $query_author = "select name, last_name from user where id = " . $id_author;
                                    $stmt_author = $conn->query($query_author);
                                    $row_author = $stmt_author->fetch(PDO::FETCH_ASSOC);
                                    
                                    $author = $row_author['name'] . " " . $row_author['last_name'];
                                    $id_news = $row['id_news'];
                                    $title = $row['title_news'];
                                    $img_news = $row['img_news'];
                                    $slug = $row['slug_news'];

                                    $id_cript_to_del = password_hash($id_news, PASSWORD_DEFAULT, array('cost' => 10));
                                    $id_cript_to_up = password_hash($id_news, PASSWORD_DEFAULT, array('cost' => 5));

                                    $res .= "<tr><td><img src='{$configBase}/../img/" . $img_news . "' style='height: 80px; width:80px; border-radius: 5px;'></td><td class='text-center'> ".$title."</td><td class='text-center'> ". $author ." </td><td class='text-center'><button class='btn btn-sm m-1 btn-error delete' id='{$id_cript_to_del}' data-slug='{$slug}'><i class='far fa-trash-alt'></i></button><a href='{$configBase}/admin/editar_noticia/{$slug}' class='btn btn-sm btn-primary m-1'><i class='far fa-edit'></i></a></td></tr>";
                                }
                            $res .= "</tbody></table></section> 
                            <!-- Include jQuery - see http://jquery.com -->
                            <script type='text/javascript'>
                                $('.confirmation').on('click', function () {
                                    return confirm('Deseja realmente excluir?');
                                });
                            </script> ";
                             $res .= "<div class='col-12 d-flex justify-content-center my-3'> " . $has_before . " <p class='mx-3'> " . $page . " </p> " . $has_after . " </div>";
                            
                            echo $res;
                        }else{
                            echo "<p class='p-2'>Nenhuma notícia cadastrada</p>";
                        }
                    }else{ 
                        echo "<p class='p-2'>Página não encontrada</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=$configBase?>/../js/delete_news.js"></script>