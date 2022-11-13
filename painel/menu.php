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
?>

<div class='menu' id='menu'>
	<div id="opacity-menu" class="container-fluid">
		<div class="row">
			<div class='div-img-profile'>
				<?= render_img(
					__DIR__ . "/../img/" . $row_img_profile[0], 
					"http://localhost/sistema/img/" . $row_img_profile[0], 
					"http://localhost/sistema/img/padrao/img-profile-default.jpg",
					"",
					'rounded-circle img-profile',
					100,
					100) ?>
			</div>
			<div id='name-user'><?=$user_name?></div>
            					    
	    		<ul class='menu-ul text-center text-md-left main-menu'>
	    			<li class='menu-item'>
	    				<a href='<?=$configBase?>/inicio' class='menu-item-inner'>
	    						<div class='name-item-menu'><i class='fas fa-home'></i>Inicio
	    						</div> 
	    				</a>
	    			</li>

	<?php

	if ($type_usu_menu == 2) {

	?>
					<li class='menu-item'>
						<div class='name-item-menu'>
							<i class='fas fa-chart-line'></i>Dashboards
						</div>
	    				<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>			
					</li>
	    			
					<ul class='sub-menu'> 
    					<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/dashboard_frequencia" ?>'  class='menu-item-inner'>
    							<div class='name-item-menu'>
    								<i class='far fa-calendar-alt'></i>Frequência
    							</div>
    						</a>
    					</li>
						
						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/dashboard_media_geral" ?>' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class='fas fa-book'></i>Média por disciplina
								</div>
							</a>
						</li>
						
						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/dashboard_media_por_turma" ?>	' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class='fas fa-users'></i>Média por turma
								</div>
							</a>
						</li>
    				</ul>

	    			<li class='menu-item'>
    					<div class='name-item-menu'>
    						<i class='fas fa-user-plus'></i>Cadastrar Usuários
    					</div>
    					<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>
	    			</li>
	    			
    				<ul class='sub-menu' id='cad-user'> 
    					<li class='menu-item'>
    						<a href="<?= "{$configBase}/admin/cad_admin" ?>" class='menu-item-inner'>
    							<div class='name-item-menu'>
    								<i class='fas fa-user-tie'></i>   Administradores
    							</div>
    						</a>
    					</li>
						
						<li class='menu-item'>
						    <a href='<?= "{$configBase}/admin/cad_aluno" ?>' class='menu-item-inner'>
							    <div class='name-item-menu'>
								    <i class='fas fa-user-graduate'></i>   Alunos
							    </div>
						    </a>
                        </li>
						
						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/cad_prof" ?>' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class='fas fa-chalkboard-teacher'></i>   Professores
								</div>
							</a>
						</li>
    				
    				</ul>
	    		
	    			<li class='menu-item'>
	    				<div class='name-item-menu'>
	    					<i class='fas fa-user-cog'></i> Gerenciar Usuários 
	    				</div>
	    				<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>
	    			</li>

	    			<ul class='sub-menu'> 
    					<li class='menu-item'>
    						<a href='<?= "{$configBase}/admin/gerenciar_adm" ?>' class='menu-item-inner'>
	    						<div class='name-item-menu'>
	    							<i class='fas fa-user-tie'></i>   Administradores
	    						</div>
							</a>
	    				</li>
						
						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/gerenciar_aluno" ?>' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class='fas fa-user-graduate'></i>   Alunos
								</div>
							</a>
						</li>
						
						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/gerenciar_professor" ?>' class='menu-item-inner'>
								<div class='name-item-menu'><i class='fas fa-chalkboard-teacher'></i>   Professores
								</div>
							</a>
						</li>	
	    			</ul> 

	    			<li class='menu-item'>
						<div class='name-item-menu'>
    						<i class='fas fa-users'></i> Turmas
    					</div>
    					<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>
	    			</li>

	    			<ul class='sub-menu'> 
    					<li class='menu-item'>
    						<a href='<?= "{$configBase}/admin/cad_turma" ?>' class='menu-item-inner'>
    							<div class='name-item-menu'>
    								<i class='fas fa-table'></i>Cadastrar Turma
    							</div>
    						</a>
    					</li>
						
						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/turmas_adm" ?>' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class='fas fa-search'></i>Visualizar turmas
								</div>
							</a>
						</li>

						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/preencher_turma" ?>' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class='fa fa-user-plus'></i>Preencher turmas
								</div>
							</a>							
						</li>
		    		</ul>
	    		
	    			<li class='menu-item'>
	    				<div class='name-item-menu'>
							<i class='fas fa-book-open'></i>   Disciplinas
						</div>
						<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>
					</li>
					
					<ul class='sub-menu'> 
						<li class='menu-item'>
    						<a href='<?= "{$configBase}/admin/cad_disc" ?>' class='menu-item-inner'>
    							<div class='name-item-menu'>
    								<i class="fas fa-plus"></i>Cadastrar
    							</div>
    						</a>
    					</li>
						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/gerenciar_disciplina" ?>' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class="fas fa-eye"></i>Visualizar
								</div>
							</a>
						</li>
						<li class='menu-item'>
							<a href=' <?="{$configBase}/admin/cadastrar_aula" ?> ' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class="fas fa-chalkboard-teacher"></i>Cadastrar aula
								</div>
							</a>
						</li>
						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/remover_aula" ?>' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class="fas fa-chalkboard-teacher"></i>Remover aula
								</div>
							</a>
						</li>
						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/recorrencia_de_aula" ?>' class='menu-item-inner'>
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
    					<div class='icon-menu-item-right'><i class='fas fa-plus more-menu'></i></div>
					</li>	

					<ul class='sub-menu'> 
    					<li class='menu-item'>
    						<a href='<?= "{$configBase}/admin/cad_noticia" ?>' class='menu-item-inner'>
    							<div class='name-item-menu'>
    								<i class="fas fa-plus"></i>Cadastrar
    							</div>
    						</a>
    					</li>
						<li class='menu-item'>
							<a href='<?= "{$configBase}/admin/gerenciar_noticia" ?>' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class="fas fa-eye"></i>Gerenciar
								</div>
							</a>
						</li>
    				</ul>

	    			<li class='menu-item'>
    					<a href='<?= "{$configBase}/admin/customizacao_site" ?>' class='menu-item-inner'>
	    					<div class='name-item-menu'>
	    						<i class='fas fa-laptop-code'></i>   Personalização do Site
	    					</div>
    					</a>
	    			</li>

	    			<!--li class='menu-item'>
	    				<div class='menu-item-inner'>
	    					<a href=' //"{$configBase}/admin/config_escola" '>
		    					<div class='name-item-menu'>
		    						<i class='fas fa-tools'></i>   Configurações da Escola
		    					</div>
	    					</a>
	    				</div>
	    			</li>-->

	    			<li class='menu-item'>
	    				<a href='<?= "{$configBase}/admin/galeria" ?>' class='menu-item-inner'>
	    					<div class='name-item-menu'>
	    						<i class='far fa-images'></i>   Galeria do Site
	    					</div>
	    				</a>
	    			</li>
	    			
	    			<li class='menu-item'>
	    				<a href='<?= "{$configBase}/admin/documentos" ?>' class='menu-item-inner'>
	    					<div class='name-item-menu'>
	    						<i class="fas fa-file-alt"></i>   Documentos
	    					</div>
	    				</a>
	    			</li>
	    			
	<?php
	
	}else if($type_usu_menu == 1){

	?>

		    		<li class='menu-item'>
		    			<a href='<?= "{$configBase}/professor/agenda" ?>' class='menu-item-inner'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-book'></i>Agenda
		    				</div>
		    			</a>
		    		</li>

		    		<li class='menu-item'>
    					<div class='name-item-menu'>
		    				<i class='far fa-calendar-alt'></i>Frequências
		    			</div>
		    			<div class='icon-menu-item-right'>
		    				<i class='fas fa-plus more-menu'></i>
		    			</div>
					</li>

					<ul class='sub-menu'> 
	    				<li class='menu-item'>
	    					<a href='<?= "{$configBase}/professor/cad_falta" ?>' class='menu-item-inner'>
	    						<div class='name-item-menu'>
	    							<i class='far fa-calendar-plus'></i>Cadastrar Frequência
	    						</div>
	    					</a>
	    				</li>
						<li class='menu-item'>
							<a href='<?= "{$configBase}/professor/ger_falta" ?>' class='menu-item-inner'>
								<div class='name-item-menu'>
									<i class='far fa-edit'></i>Gerenciar Frequência
								</div>
							</a>
						</li>
					</ul>

					<li class='menu-item'>
		    			<div class='name-item-menu'>
		    				<i class='fas fa-globe'></i>Notas
		    			</div>
		    			<div class='icon-menu-item-right'>
		    				<i class='fas fa-plus more-menu'></i>
		    			</div>
					</li>

					<ul class='sub-menu'> 
	    				<li class='menu-item'>
	    					<a href='<?= "{$configBase}/professor/cad_notas" ?>' class='menu-item-inner'>
	    						<div class='name-item-menu'>
	    							<i class='far fa-calendar-plus'></i>Cadastrar Notas
	    						</div>
	    					</a>
	    				</li>
						<li class='menu-item'>
							<a href='<?= "{$configBase}/professor/ger_falta" ?>' class='menu-item-inner'>
							<div class='name-item-menu'>
								<i class='far fa-edit'></i>Gerenciar Notas
							</div>
							</a>
						</li>
					</ul>

		    		<li class='menu-item'>
		    			<a href='<?= "{$configBase}/professor/turma_prof" ?>' class='menu-item-inner'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-users-cog'></i>  Minhas Aulas
		    				</div>
		    			</a>
		    		</li>

	<?php 

		}else if($type_usu_menu == 0){ 

	?>
		
				<li class='menu-item'>
					<a href='<?= "{$configBase}/aluno/agenda" ?>' class='menu-item-inner'>
					<div class='name-item-menu'>
						<i class='fas fa-book'></i> Agenda
					</div>
					</a>
				</li>
			    		
				<li class='menu-item'>
					<a href='<?= "{$configBase}/aluno/freq" ?>' class='menu-item-inner'>
						<div class='name-item-menu'>
							<i class='fas fa-chart-line'></i> Frequência
						</div>
					</a>
				</li>

				<li class='menu-item'>
					<a href='<?= "{$configBase}/aluno/boletim" ?>' class='menu-item-inner'>
						<div class='name-item-menu'>
							<i class='fas fa-file-invoice'></i> Histórico Escolar
						</div>
					</a>
					
				</li>

				<li class='menu-item'>
					<a href='<?= "{$configBase}/aluno/turma" ?>' class='menu-item-inner'>
						<div class='name-item-menu'>
							<i class='fas fa-users'></i> Minha Turma
						</div>
					</a>
				</li>

				<li class='menu-item'>
					<a href='<?= "{$configBase}/aluno/notas" ?>' class='menu-item-inner'>
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
						<a href='<?=$configBase."/minha_conta"?>' class='menu-item-inner'>
							<div class='name-item-menu'><i class='far fa-id-card'></i>Minha Conta</div>
						</a>
				</li>

			</ul>
		</div>
	</div>
</div>
<li class='menu-item-exit d-md-none d-block text-center' id='close-menu' style='max-height: 48px;' value="0">Abrir Menu</li>

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
        	$('#menu').css("display", "block");
        }else{
        	$('#close-menu').val('0');
        	$('#close-menu').text('Abrir Menu');
        	$('#menu').css("display", "none");
        }
        e.stopPropagation();
    });
});

</script>