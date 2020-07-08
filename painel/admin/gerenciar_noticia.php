<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="box"> 
                <header class="div-title-box">
                    <h1 class="title-box-main  d-flex justify-content-center">Gerenciar Notícias</h1>
                </header>
               
                <div class="col-12 p-0 m-0">

                    <?php 

                        $table = "news";

                        $query = "select * from ".$table;
                           
                        $stmt = $conn->query($query);

                        if ($stmt->rowCount() > 0) {
                        $res = "<section>";

                            $res .= "<table id='table-scroll' class='table table-hover'><thead><tr><th>Imagem</th><th class='text-center'>Título</th><th class='text-center'>Autor</th><th class='text-center'>Ações</th></tr></thead><tbody>";
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    
                                    $id_author = $row['id_author'];
                                    $query_author = "select name, last_name from user where id = " . $id_author;
                                    $stmt_author = $conn->query($query_author);
                                    $row_author = $stmt_author->fetch(PDO::FETCH_ASSOC);
                                    
                                    $author = $row_author['name'] . " " . $row_author['last_name'];
                                    $title = $row['title_news'];
                                    $img_news = $row['path_img'];
                                    $slug = $row['slug_news'];

                                    $res .= "<tr><td><img src='{$configBase}/../img/" . $img_news . "' style='height: 80px; width:80px; border-radius: 5px;'></td><td class='text-center'> ".$title."</td><td class='text-center'> ". $author ." </td><td class='text-center'><button class='btn btn-sm m-1'><i class='far fa-trash-alt'></i></button><a href='{$configBase}/admin/editar_news/{$slug}' class='btn btn-sm m-1'><i class='far fa-edit'></i></a></td></tr>";
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
                            echo "Nenhum(a) " .$table. "  cadastrado(a) nesta escola";
                        }
                   
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>