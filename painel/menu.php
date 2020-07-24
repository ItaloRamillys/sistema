<?php	
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];

$query_img_profile = "select img_profile from user where id = " . $user_id;
$stmt_img_profile  = $conn->query($query_img_profile);
$row_img_profile = $stmt_img_profile->fetch(PDO::FETCH_NUM);

$query_menu = "select img_school from config";
$stmt_menu  = $conn->query($query_menu);
$row = $stmt_menu->fetch(PDO::FETCH_NUM);
$img_escola = $row[0];

$img = "";

$type_usu_menu = $_SESSION['type'];
$id_user_menu = $_SESSION['user_id'];
$minha_conta = $configBase."/editar_minha_conta";

?>

<div class='menu col-md-2 col-sm-12' id='menu'>
	<div id="opacity-menu" class="container-fluid">
		<div class="row">
			<div class='div-img-profile'>
				<?= render_img(
					__DIR__ . "/../img/" . $row_img_profile[0], 
					"http://localhost/sistema/img/" . $row_img_profile[0], 
					"http://localhost/sistema/img/padrao/img-profile-default.jpg",
					"",
					'rounded-circle img-profile',
					200,
					200) ?>
			</div>
			<div id='msg-welcome'><?=$user_name?></div>
            					    
	    		<ul class='menu-ul text-center text-md-left main-menu'>
	    			<li class='menu-item'>
	    				<div class='menu-item-inner'>
	    					<a href='<?=$configBase?>/inicio'>
	    						<div class='name-item-menu'><i class='fas fa-home'></i>Inicio
	    						</div> 
	    					</a>
	    				</div>
	    			</li>

	<?php

	if ($type_usu_menu == 2) {

	?>

					<li class='menu-item'>
						<div class='menu-item-inner'>
						
							<div class='name-item-menu'>
								<i class='fas fa-chart-line'></i>Dashboards
							</div>
	    					<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>

						</div>
					</li>
	    			
					<ul class='sub-menu'> 

    					<li class='menu-item'>
    						<div class='menu-item-inner'>
	    						<a href="<?= "{$configBase}/admin/dashboard_frequencia" ?>">
	    							<div class='name-item-menu'>
	    								<i class='far fa-calendar-alt'></i>Frequência
	    							</div>
	    						</a>
    						</div>
    					</li>
						
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/dashboard_media_geral" ?>'>
								<div class='name-item-menu'>
									<i class='fas fa-book'></i>Média por disciplina
								</div>
							</a>
						</div></li>
						
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/dashboard_media_por_turma" ?>'>
								<div class='name-item-menu'>
									<i class='fas fa-users'></i>Média por turma
								</div>
							</a>
						</div></li>
    				
    				</ul>
	    		
	    			<li class='menu-item'><div class='menu-item-inner'>
	    				
	    					<div class='name-item-menu'>
	    						<i class='fas fa-user-plus'></i>Cadastrar Usuários
	    					</div>
	    					<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>
	    				
					</div></li>
	    			
    				<ul class='sub-menu' id='cad-user'> 

    					<li class='menu-item'><div class='menu-item-inner'>
    						<a href="<?= "{$configBase}/admin/cad_admin" ?>">
    							<div class='name-item-menu'>
    								<i class='fas fa-user-tie'></i>   Administradores
    							</div>
    						</a>
    					</div></li>
						
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/cad_aluno" ?>'>
								<div class='name-item-menu'>
									<i class='fas fa-user-graduate'></i>   Alunos
								</div>
							</a>
						</div></li>
						
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/cad_prof" ?>'>
								<div class='name-item-menu'>
									<i class='fas fa-chalkboard-teacher'></i>   Professores
								</div>
							</a>
						</div></li>
    				
    				</ul>
	    		
	    			<li class='menu-item'><div class='menu-item-inner'>
	    				
		    				<div class='name-item-menu'>

		    					<i class='fas fa-user-cog'></i> Gerenciar Usuários 

		    				</div>

		    				<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>
	    				
	    			</div></li>

	    			<ul class='sub-menu'> 

    					<li class='menu-item'><div class='menu-item-inner'>
    						<a href='<?= "{$configBase}/admin/gerenciar_adm" ?>'>
	    						<div class='name-item-menu'>
	    							<i class='fas fa-user-tie'></i>   Administradores
	    						</div>

	    					</a>
	    				</div></li>
						
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/gerenciar_aluno" ?>'>
								<div class='name-item-menu'>
									<i class='fas fa-user-graduate'></i>   Alunos
								</div>
							</a>
						</div></li>
						
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/gerenciar_professor" ?>'>
								<div class='name-item-menu'><i class='fas fa-chalkboard-teacher'></i>   Professores
								</div>
							</a>
						</div></li>
	    				
	    			</ul> 

	    			<li class='menu-item'><div class='menu-item-inner'>

    					<div class='name-item-menu'>
    						<i class='fas fa-users'></i> Turmas
    					</div>
    					<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>
    					
	    			</div></li>

	    			<ul class='sub-menu'> 

    					<li class='menu-item'>
    						<div class='menu-item-inner'>
	    						<a href='<?= "{$configBase}/admin/cad_turma" ?>'>
	    							<div class='name-item-menu'>
	    								<i class='fas fa-table'></i>Cadastrar Turma
	    							</div>
	    						</a>
	    					</div>
	    				</li>
						
						<li class='menu-item'>
							<div class='menu-item-inner'>
								<a href='<?= "{$configBase}/admin/turmas_adm" ?>'>
									<div class='name-item-menu'>
										<i class='fas fa-search'></i>Visualizar turmas
									</div>
								</a>
							</div>
						</li>

						<li class='menu-item'>
							<div class='menu-item-inner'>
								<a href='<?= "{$configBase}/admin/preencher_turma" ?>'>
									<div class='name-item-menu'>
										<i class='fa fa-user-plus'></i>Preencher turmas
									</div>
								</a>
							</div>
						</li>
						
		    		</ul>
	    		
	    			<li class='menu-item'><div class='menu-item-inner'>
	    				
	    					<div class='name-item-menu'>
								<i class='fas fa-book-open'></i>   Disciplinas
							</div>
							
		    				<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>
						
					</div></li>
					
					<ul class='sub-menu'> 

    					<li class='menu-item'><div class='menu-item-inner'>
    						<a href='<?= "{$configBase}/admin/cad_disc" ?>'>
    							<div class='name-item-menu'>
    								<i class="fas fa-plus"></i>Cadastrar
    							</div>
    						</a>
    					</div></li>
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/gerenciar_disciplina" ?>'>
								<div class='name-item-menu'>
									<i class="fas fa-eye"></i>Visualizar
								</div>
							</a>
						</div></li>
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/cadastrar_aula" ?>'>
								<div class='name-item-menu'>
									<i class="fas fa-chalkboard-teacher"></i>Cadastrar aula
								</div>
							</a>
						</div></li>
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/remocao_de_aula" ?>'>
								<div class='name-item-menu'>
									<i class="fas fa-chalkboard-teacher"></i>Remover aula
								</div>
							</a>
						</div></li>
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/recorrencia_de_aula" ?>'>
								<div class='name-item-menu'>
									<i class="fas fa-chalkboard-teacher"></i>Recorrência de aula
								</div>
							</a>
						</div></li>
    				
    				</ul>

					<li class='menu-item'><div class='menu-item-inner'>
						
							<div class='name-item-menu'>
								<i class='far fa-newspaper'></i>   Notícias
							</div>
	    					<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>

					</div></li>	

					<ul class='sub-menu'> 

    					<li class='menu-item'><div class='menu-item-inner'>
    						<a href='<?= "{$configBase}/admin/cad_noticia" ?>'>
    							<div class='name-item-menu'>
    								<i class="fas fa-plus"></i>Cadastrar
    							</div>
    						</a>
    					</div></li>
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/admin/gerenciar_noticia" ?>'>
								<div class='name-item-menu'>
									<i class="fas fa-eye"></i>Gerenciar
								</div>
							</a>
						</div></li>
						
    				
    				</ul>

					<a href='<?= "{$configBase}/admin/cad_news" ?>'>

	    			<li class='menu-item'>
	    				<div class='menu-item-inner'>
	    					<a href='<?= "{$configBase}/admin/customizacao_site" ?>'>
		    					<div class='name-item-menu'>
		    						<i class='fas fa-laptop-code'></i>   Personalização do Site
		    					</div>
	    					</a>
	    				</div>
	    			</li>

	    			<li class='menu-item'>
	    				<div class='menu-item-inner'>
	    					<a href='<?= "{$configBase}/admin/config_escola" ?>'>
		    					<div class='name-item-menu'>
		    						<i class='fas fa-tools'></i>   Configurações da Escola
		    					</div>
	    					</a>
	    				</div>
	    			</li>

	    			<li class='menu-item'><div class='menu-item-inner'>
	    				<a href='<?= "{$configBase}/admin/galeria" ?>'>
	    					<div class='name-item-menu'>
	    						<i class='far fa-images'></i>   Galeria do Site
	    					</div>
	    				</a>
	    			</div></li>
	    			
	    			<li class='menu-item'><div class='menu-item-inner'>
	    				<a href='<?= "{$configBase}/admin/documentos" ?>'>
	    					<div class='name-item-menu'>
	    						<i class="fas fa-file-alt"></i>   Documentos
	    					</div>
	    				</a>
	    			</div></li>
	    			
	<?php
	
	}else if($type_usu_menu == 1){

	?>

		    		<li class='menu-item'><div class='menu-item-inner'>
		    			<a href='<?= "{$configBase}/professor/agenda" ?>'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-book'></i>Agenda
		    				</div>
		    			</a>
		    		</div></li>

		    		<li class='menu-item'>
		    			<div class='menu-item-inner'>
	    					<div class='name-item-menu'>
			    				<i class='far fa-calendar-alt'></i>Frequências
			    			</div>
			    			<div class='icon-menu-item-right'>
			    				<i class='fas fa-plus more-menu'></i>
			    			</div>
						</div>
					</li>

					<ul class='sub-menu'> 
	    				<li class='menu-item'><div class='menu-item-inner'>
	    					<a href='<?= "{$configBase}/professor/cad_falta" ?>'>
	    						<div class='name-item-menu'>
	    							<i class='far fa-calendar-plus'></i>Cadastrar Frequência
	    						</div>
	    					</a>
	    				</div></li>
						<li class='menu-item'><div class='menu-item-inner'>
							<a href='<?= "{$configBase}/professor/ger_falta" ?>'>
								<div class='name-item-menu'>
									<i class='far fa-edit'></i>Gerenciar Frequência
								</div>
							</a>
						</div></li>
					</ul>

					<li class='menu-item'>
		    			<div class='menu-item-inner'>
	    					<div class='name-item-menu'>
			    				<i class='fas fa-globe'></i>Notas
			    			</div>
			    			<div class='icon-menu-item-right'>
			    				<i class='fas fa-plus more-menu'></i>
			    			</div>
						</div>
					</li>

					<ul class='sub-menu'> 
	    				<li class='menu-item'><div class='menu-item-inner'>
	    					<a href='<?= "{$configBase}/professor/cad_notas" ?>'>
	    						<div class='name-item-menu'>
	    							<i class='far fa-calendar-plus'></i>Cadastrar Notas
	    						</div>
	    					</a>
	    				</div></li>
						<li class='menu-item'>
							<div class='menu-item-inner'>
								<a href='<?= "{$configBase}/professor/ger_falta" ?>'>
								<div class='name-item-menu'>
									<i class='far fa-edit'></i>Gerenciar Notas
								</div>
								</a>
							</div>
						</li>
					</ul>

		    		<li class='menu-item'><div class='menu-item-inner'>
		    			<a href='<?= "{$configBase}/professor/turma_prof" ?>'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-users-cog'></i>  Minhas Aulas
		    				</div>
		    			</a>
		    		</div></li>

	<?php 

		}else if($type_usu_menu == 0){ 

			$base_panel = "aluno";
	?>
		
		<a href='<?= "{$configBase}/aluno/agenda" ?>'>
			<li class='menu-item'><div class='menu-item-inner'>
				<div class='name-item-menu'>
					<i class='fas fa-book'></i> Agenda
				</div>
			</div></li>
		</a>
		    		
		<a href='<?= "{$configBase}/aluno/freq" ?>'>
			<li class='menu-item'><div class='menu-item-inner'>
				<div class='name-item-menu'>
					<i class='fas fa-chart-line'></i> Frequência
				</div>
			</div></li>
		</a>

		<li class='menu-item'><div class='menu-item-inner'>
			<a href='<?= "{$configBase}/aluno/boletim" ?>'>
				<div class='name-item-menu'>
					<i class='fas fa-file-invoice'></i> Histórico Escolar
				</div>
			</a>
		</div></li>

		<li class='menu-item'><div class='menu-item-inner'>
			<a href='<?= "{$configBase}/aluno/turma" ?>'>
				<div class='name-item-menu'>
					<i class='fas fa-users'></i> Minha Turma
				</div>
			</a>
		</div></li>

		<li class='menu-item'><div class='menu-item-inner'>
			<a href='<?= "{$configBase}/aluno/notas" ?>'>
				<div class='name-item-menu'>
					<i class='fas fa-book-open'></i> Ver Notas
				</div>
			</a>
		</div></li>
	<?php
		
		}

	else{

		$_SESSION['authentic'] = 'NO';
        header("Location: ..\index.php?login=erro2");

	}
?>

		<li class='menu-item'>
			<div class='menu-item-inner'>
				<a href='<?php echo "{$minha_conta}"; ?>'>
					<div class='name-item-menu'><i class='far fa-id-card'></i>   Minha Conta</div>
				</a>
			</div>
		</li>

		</ul>
	</div>
	</div>
	
	<li class='menu-item-exit d-md-none d-block text-center' id='close-menu' style='max-height: 48px;' value="0">Abrir Menu</div></li>
<script>

//FUNCAO ABRIR SUBMENU
$(document).ready(function() {
  	$('.menu-item').click(function(e){
  		var y = e.target;
  		//ATE ACHAR O MENU-ITEM CLICADO
		while(!($(y).hasClass('menu-item'))){
			y = $(y).parent();
		}
		//SO FAZ O SLIDE TOGGLE SE FOI UM ITEM DO MENU PRINCIPAL
		if(!($(y).parent().hasClass('sub-menu'))){
			$(y).next('ul').slideToggle(400);
		}
	});
});

$(document).ready(function() {
    $('#close-menu').click(function(e) {
        var v = $('#close-menu').val();
        if(v == 0){
        	$('#close-menu').val('1');

        	$('#close-menu').text('Fechar Menu');
        }else{
        	$('#close-menu').val('0');

        	$('#close-menu').text('Abrir Menu');
        }
        $('#menu').slideToggle(500);
        e.stopPropagation();
    });
});

</script>