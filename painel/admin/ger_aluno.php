<div id="msg"></div>
<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="box"> 
                <header class="div-title-box">
                    <h1 class="title-box-main  d-flex justify-content-center">Gerenciar Aluno</h1>
                </header>
               
                <div class="table-data">
                    <?php 

                    $tabela = "usuario";
                $tipo = "0";

                $query = "select * from ".$tabela." where tipo = ".$tipo;
                    
                $stmt = $conexao->query($query);

                if ($stmt->rowCount() > 0) {
                    $res = "<section>";

                        $res .= "<table id='tabela-scroll' class='table table-hover'><thead><tr><th>Imagem</th><th class='text-center'>Nome completo</th><th class='text-center'>Email</th><th class='text-center'>Status</th><th class='text-center'>Ações</th></tr></thead><tbody>";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                
                                if($row["email"] == ''){
                                  $row["email"] = "Não possui email";
                                }

                                $img = $row['img_profile'];
                                
                                $nome = $row['nome'];
                                $sobrenome = $row['sobrenome'];
                                $email = $row['email'];
                                $cria = $row['create_at'];
                                $id_get = $row['id'];
                                $status = $row['status'];
                                $user = $row['login'];

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

                                $res .= "<tr><td>{$imagem}</td><td class='text-center'> ".$nome." ".$sobrenome." </td><td class='text-center'> ".$email." </td><td class='text-center'> ".$status." </td><td class='text-center'><button class='btn btn-sm btn-danger m-1'><i class='far fa-trash-alt'></i></button><a href='{$configBase}/admin/editar_conta/".$user."' class='btn btn-sm btn-primary m-1'><i class='far fa-edit'></i></a></td></tr>";

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

<script src="http://localhost/sistema/js/delete_aluno.js"></script>
