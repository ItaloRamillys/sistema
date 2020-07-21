<div class="container">
    <div id="msg"></div>
    <div class="row">
        <div class="col-12">
            <div class="box"> 
                <header class="div-title-box">
                    <h1 class="title-box-main  d-flex justify-content-center">Gerenciar Professores</h1>
                </header>
               
                <div class="table-data">
                    <input type="hidden" id="type" value="1">
                    <?php 
                    if(isset($configUrl[2])){
                        $page = $configUrl[2];
                    }else{
                        $page = 1;
                    }

                    $limit = 10;

                    $query_total = "select count(*) from user where type = 1";
                    $stmt_total = $conn->query($query_total);
                    $row_total = $stmt_total->fetch(PDO::FETCH_NUM);
                    $max_pages = ceil($row_total[0]/$limit);    
                    
                    if(($page > 0) && ($page <= $max_pages)){
                        $offset = ($page - 1)*$limit;

                        $query = "select * from user where type = 1 order by name, last_name limit " . $limit . " offset " . $offset;
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

                    if($stmt->rowCount() > 0) {
                            $res = "<section>";

                            $res .= "<table id='table-scroll' class='table table-hover'><thead><tr><th>Imagem</th><th class='text-center'>Nome completo</th><th class='text-center'>Email</th><th class='text-center'>Status</th><th class='text-center'>Ações</th></tr></thead><tbody>";
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    
                                    if($row["email"] == ''){
                                      $row["email"] = "Não possui email";
                                    }

                                    $img = $row['img_profile'];
                                    
                                    $name = $row['name'];
                                    $last_name = $row['last_name'];
                                    $email = $row['email'];
                                    $cria = $row['create_at'];
                                    $id_get = $row['id'];
                                    $status = $row['status'];
                                    $user = $row['login'];

                                    $id_cript_to_del = password_hash($id_get, PASSWORD_DEFAULT, array('cost' => 10));
                                    $id_cript_to_up = password_hash($id_get, PASSWORD_DEFAULT, array('cost' => 5));

                                    $r_img = explode(".", $img);
                                    $name_img = $r_img[0];
                                    $new_name_img = $name_img."_100x100.".$r_img[1];

                                    $imagem = render_img(__DIR__."/../../img/".$img, 
                                                        "{$configBase}/../img/".$new_name_img,
                                                        "{$configBase}/../img/padrao/img-profile-default.jpg",
                                                        'rounded',
                                                        80,
                                                        80
                                                        );

                                    $is_disable = "";

                                    if(!$status){
                                        $is_disable = "<button class='btn btn-sm m-1 reactivate' id={$id_cript_to_up} email-data={$email} data-toggle='tooltip' data-placement='top' title='Reativar usuário' {$is_disable}><i class='fas fa-undo'></i></button>";
                                    }else{
                                        $is_disable = "<button class='btn btn-sm m-1 disable-btn' id={$id_cript_to_up} email-data={$email} data-toggle='tooltip' data-placement='top' title='Desativar usuário' {$is_disable}><i class='fas fa-times-circle'></i></button>";
                                    }

                                    $res .= "<tr><td>{$imagem}</td><td class='text-center'> ".$name." ".$last_name." </td><td class='text-center'> ".$email." </td><td class='text-center'> ".$status." </td><td class='text-center'>{$is_disable}<a href='{$configBase}/admin/editar_conta/".$user."' class='btn btn-sm m-1' data-toggle='tooltip' data-placement='top' title='Editar usuário'><i class='fas fa-edit'></i></a></td></tr>";

                                }

                            $res .= "</tbody></table></section>
                                    <div>

                                    </div> 
                            <!-- Include jQuery - see http://jquery.com -->
                            <script type='text/javascript'>
                                $('.confirmation').on('click', function () {
                                    return confirm('Deseja realmente excluir?');
                                });
                            </script> ";
                            
                            $res .= "<div class='col-12 d-flex justify-content-center my-3'> " . $has_before . " <p class='mx-3'> " . $page . " </p> " . $has_after . " </div>";

                            echo $res;
                        } else {
                            echo "Nenhum(a) " .$table. "  cadastrado(a) nesta escola";
                        }
                    }else{
                        echo "<div class='col-12 py-3'>A página desejada não está disponível</div>";
                    }
                           
                    ?>
                </div>
            </div>
        </div>
    </div>
</div> 
<script src="<?=$configBase?>/../js/delete_user.js"></script>
<script src="http://localhost/sistema/js/reactive_user.js"></script>
<script src="http://localhost/sistema/js/disable_user.js"></script>