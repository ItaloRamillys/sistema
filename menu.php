<?php	

    $user_id = $_SESSION['user_id'];

    $query_img_profile = "select img_profile from usuario where id = " . $user_id;
    $stmt_img_profile  = $conexao->query($query_img_profile);

    $row_img_profile = $stmt_img_profile->fetch(PDO::FETCH_NUM);

    if($row_img_profile[0] == ""){
        $img_profile    = "http://localhost/sistema/img/usuario/img-profile-default.jpg";
    }else{
	    $r_img = explode(".", $row_img_profile[0]);
	    $name_img = $r_img[0];
	    $new_name_img = $name_img."_720x480.".$r_img[1];
       	$img_profile    = "http://localhost/sistema/img/" . $row_img_profile[0];
    }

	$query_menu = "select img_escola from config";
	$stmt_menu  = $conexao->query($query_menu);
	$row = $stmt_menu->fetch(PDO::FETCH_NUM);
	$img_escola = $row[0];

	$img = "";

	$tipo_usu_menu = $_SESSION['tipo'];

	$id_user_menu = $_SESSION['user_id'];

	$minha_conta = "$configBase/editar_minha_conta";
	
	?>

	<div class='menu col-md-2 col-sm-12' id='menu'>
		<div id="opacity-menu" class="container-fluid">
			<div class="row">
				<div class='div-img-school w-100 d-flex justify-content-center'>
					<img src='<?php echo "{$img_profile}"; ?>' id='img_profile' class='img-school'>
				</div>

		    		<ul class='menu-ul text-center text-md-left'>
		    			<li class='menu-item'><a href='<?=$configBase?>/inicio'><div class='name-item-menu'><i class='fas fa-home'></i>Inicio</div> </a></li>

		<?php

		if ($tipo_usu_menu == 2) {


		?>

						<li class='menu-item'>
							
								<div class='name-item-menu'>
									<i class='fas fa-chart-line'></i>Dashboards
								</div>
		    					<div class='icon-menu-item-right'><div class='fas fa-plus more-menu'></div></div>

						</li>
		    			
						<ul class='sub-menu' id='cad-user'> 

	    					<li class='menu-item'>
	    						<a href="<?= "{$configBase}/admin/dashboard_frequencia" ?>">
	    							<div class='name-item-menu'>
	    								<i class='far fa-calendar-alt'></i>Frequência
	    							</div>
	    						</a>
	    					</li>
							
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/dashboard_media_geral" ?>'>
									<div class='name-item-menu'>
										<i class='fas fa-book'></i>Média por disciplina
									</div>
								</a>
							</li>
							
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/dashboard_media_por_turma" ?>'>
									<div class='name-item-menu'>
										<i class='fas fa-users'></i>Média por turma
									</div>
								</a>
							</li>
	    				
	    				</ul>
		    		
		    			<li class='menu-item' id='show-cad-user'>
		    				
		    					<div class='name-item-menu'>
		    						<i class='fas fa-user-plus'></i>Cadastrar Usuários
		    					</div>
		    					<div class='icon-menu-item-right'><div class='fas fa-plus more-menu'></div></div>
		    				
						</li>
		    			
	    				<ul class='sub-menu' id='cad-user'> 

	    					<li class='menu-item'>
	    						<a href="<?= "{$configBase}/admin/cad_admin" ?>">
	    							<div class='name-item-menu'>
	    								<i class='fas fa-user-tie'></i>   Administradores
	    							</div>
	    						</a>
	    					</li>
							
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/cad_aluno" ?>'>
									<div class='name-item-menu'>
										<i class='fas fa-user-graduate'></i>   Alunos
									</div>
								</a>
							</li>
							
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/cad_prof" ?>'>
									<div class='name-item-menu'>
										<i class='fas fa-chalkboard-teacher'></i>   Professores
									</div>
								</a>
							</li>
	    				
	    				</ul>
		    		
		    			<li class='menu-item' id='show-user'>
		    				
			    				<div class='name-item-menu'>

			    					<i class='fas fa-user-cog'></i> Gerenciar Usuários 

			    				</div>

			    				<div class='icon-menu-item-right'><div class='fas fa-plus more-menu'></div></div>
		    				
		    			</li>

		    			<ul class='sub-menu' id='user'> 

	    					<li class='menu-item'>
	    						<a href='<?= "{$configBase}/admin/ger_adm" ?>'>
		    						<div class='name-item-menu'>
		    							<i class='fas fa-user-tie'></i>   Administradores
		    						</div>

		    					</a>
		    				</li>
							
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/ger_aluno" ?>'>
									<div class='name-item-menu'>
										<i class='fas fa-user-graduate'></i>   Alunos
									</div>
								</a>
							</li>
							
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/ger_prof" ?>'>
									<div class='name-item-menu'><i class='fas fa-chalkboard-teacher'></i>   Professores
									</div>
								</a>
							</li>
		    				
		    			</ul> 

		    			<li class='menu-item' id='show-turmas'>

	    					<div class='name-item-menu'>
	    						<i class='fas fa-users'></i> Turmas
	    					</div>
	    					<div class='icon-menu-item-right'><div class='fas fa-plus more-menu'></div></div>
	    					
		    			</li>

		    			<ul class='sub-menu' id='turmas'> 

	    					<li class='menu-item'>
	    						<a href='<?= "{$configBase}/admin/cad_turma" ?>'>
	    							<div class='name-item-menu'>
	    								<i class='fas fa-table'></i>   Cadastrar Turma
	    							</div>
	    						</a>
	    					</li>
							
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/turmas_adm" ?>'>
									<div class='name-item-menu'>
										<i class='fas fa-search'></i>Visualizar turmas
									</div>
								</a>
							</li>
							
			    		</ul>
		    		
		    			<li class='menu-item'>
		    				
		    					<div class='name-item-menu'>
									<i class='fas fa-book-open'></i>   Disciplinas
								</div>
								
			    				<div class='icon-menu-item-right'><div class='fas fa-plus more-menu'></div></div>
							
						</li>
						
						<ul class='sub-menu' id='menu-disc'> 

	    					<li class='menu-item'>
	    						<a href='<?= "{$configBase}/admin/cad_disc" ?>'>
	    							<div class='name-item-menu'>
	    								<i class="fas fa-plus"></i>Cadastrar
	    							</div>
	    						</a>
	    					</li>
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/view_disc" ?>'>
									<div class='name-item-menu'>
										<i class="fas fa-eye"></i>Visualizar
									</div>
								</a>
							</li>
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/cadastro_de_aula" ?>'>
									<div class='name-item-menu'>
										<i class="fas fa-chalkboard-teacher"></i>Cadastrar aula
									</div>
								</a>
							</li>
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/remocao_de_aula" ?>'>
									<div class='name-item-menu'>
										<i class="fas fa-chalkboard-teacher"></i>Remover aula
									</div>
								</a>
							</li>
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/recorrencia_de_aula" ?>'>
									<div class='name-item-menu'>
										<i class="fas fa-chalkboard-teacher"></i>Recorrência de aula
									</div>
								</a>
							</li>
	    				
	    				</ul>

						<li class='menu-item'>
							
								<div class='name-item-menu'>
									<i class='far fa-newspaper'></i>   Notícias
								</div>
		    					<div class='icon-menu-item-right'><div class='fas fa-plus more-menu'></div></div>

						</li>	

						<ul class='sub-menu' id='menu-disc'> 

	    					<li class='menu-item'>
	    						<a href='<?= "{$configBase}/admin/cad_news" ?>'>
	    							<div class='name-item-menu'>
	    								<i class="fas fa-plus"></i>Cadastrar
	    							</div>
	    						</a>
	    					</li>
							<li class='menu-item'>
								<a href='<?= "{$configBase}/admin/ger_news" ?>'>
									<div class='name-item-menu'>
										<i class="fas fa-eye"></i>Gerenciar
									</div>
								</a>
							</li>
							
	    				
	    				</ul>

						<a href='<?= "{$configBase}/admin/cad_news" ?>'>

		    			<li class='menu-item'>
		    				<a href='<?= "{$configBase}/admin/config_site" ?>'>
		    					<div class='name-item-menu'>
		    						<i class='fas fa-tools'></i>   Configurações do Site
		    					</div>
		    				</a>
		    			</li>

		    			<li class='menu-item'>
		    				<a href='<?= "{$configBase}/admin/galeria" ?>'>
		    					<div class='name-item-menu'>
		    						<i class='far fa-images'></i>   Galeria do Site
		    					</div>
		    				</a>
		    			</li>
		    			
		    			<li class='menu-item'>
		    				<a href='<?= "{$configBase}/admin/documentos" ?>'>
		    					<div class='name-item-menu'>
		    						<i class="fas fa-file-alt"></i>   Documentos
		    					</div>
		    				</a>
		    			</li>
		    			
	<?php
	
	}else if($tipo_usu_menu == 1){

	?>

		    		<li class='menu-item'>
		    			<a href='<?= "{$configBase}/professor/agenda" ?>'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-book'></i>Agenda
		    				</div>
		    			</a>
		    		</li>

		    		<li class='menu-item' id='show-freq'>
		    			
		    			<a href='<?= "{$configBase}/professor/cad_falta" ?>'>
		    				
			    			<div class='name-item-menu'>
			    				<i class='far fa-calendar-alt'></i>Frequências
			    			</div>
			    			<div class='icon-menu-item-right'><div class='fas fa-plus more-menu'></div></div>
		    			</a>

					</li>

					<ul class='sub-menu' id='freq'> 
		    			
	    				<li class='menu-item'>
	    					<a href='<?= "{$configBase}/professor/cad_falta" ?>'>
	    						<div class='name-item-menu'>
	    							<i class='far fa-calendar-plus'></i>Cadastrar Frequência
	    						</div>
	    					</a>
	    				</li>
						
						<li class='menu-item'>
							<a href='<?= "{$configBase}/professor/ger_falta" ?>'>
								<div class='name-item-menu'>
									<i class='far fa-edit'></i>Gerenciar Frequência
								</div>
							</a>
						</li>
					</ul>
		    		
		    		<li class='menu-item'>
		    			<a href='<?= "{$configBase}/professor/cad_notas" ?>'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-globe'></i>Notas
		    				</div>
		    			</a>
		    		</li>

		    		<li class='menu-item'>
		    			<a href='<?= "{$configBase}/professor/turma_prof" ?>'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-users-cog'></i>  Minhas Aulas
		    				</div>
		    			</a>
		    		</li>

	<?php 

		}else if($tipo_usu_menu == 0){ 

			$base_panel = "aluno";
	?>
		
		<a href='<?= "{$configBase}/aluno/agenda" ?>'>
			<li class='menu-item'>
				<div class='name-item-menu'>
					<i class='fas fa-book'></i> Agenda
				</div>
			</li>
		</a>
		    		
		<a href='<?= "{$configBase}/aluno/freq" ?>'>
			<li class='menu-item'>
				<div class='name-item-menu'>
					<i class='fas fa-chart-line'></i> Frequência
				</div>
			</li>
		</a>

		<li class='menu-item'>
			<a href='<?= "{$configBase}/aluno/boletim" ?>'>
				<div class='name-item-menu'>
					<i class='fas fa-file-invoice'></i> Histórico Escolar
				</div>
			</a>
		</li>

		<li class='menu-item'>
			<a href='<?= "{$configBase}/aluno/turma" ?>'>
				<div class='name-item-menu'>
					<i class='fas fa-users'></i> Minha Turma
				</div>
			</a>
		</li>

		<li class='menu-item'>
			<a href='<?= "{$configBase}/aluno/notas" ?>'>
				<div class='name-item-menu'>
					<i class='fas fa-book-open'></i> Ver Notas
				</div>
			</a>
		</li>
	<?php
		
		}

	else{

		$_SESSION['authentic'] = 'NO';
        header("Location: ..\index.php?login=erro2");

	}
?>

		<li class='menu-item'>
			<a href='<?php echo "{$minha_conta}"; ?>'>
				<div class='name-item-menu'><i class='far fa-id-card'></i>   Minha Conta</div>
			</a>
		</li>

	</ul>
		</div>
	</div>
</div>
	<li class='menu-item-exit d-md-none d-block text-center' id='close-menu' style='max-height: 48px;'>Abrir Menu</li>

<script>

$(document).ready(function() {
  	$('.menu-item').click(function(e){
		$(e.target).parent('li').next().slideToggle(400);
	});
});


$(document).ready(function() {
    $('#close-menu').click(function(e) {
        
        var text = $('#close-menu').text();
        if(text == 'Fechar Menu'){
        	$('#close-menu').text('Abrir Menu');
        }else{
        	$('#close-menu').text('Fechar Menu');
        }
        $('#menu').slideToggle(400);
        e.stopPropagation();
    });
});

</script>