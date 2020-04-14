<?php	

	$query_menu = "select img_escola from config";
	$stmt_menu  = $conexao->query($query_menu);
	$row = $stmt_menu->fetch(PDO::FETCH_NUM);
	$img_escola = $row[0];

	$img = "";

	$tipo_usu_menu = $_SESSION['tipo'];

	$id_user_menu = $_SESSION['user_id'];

	if($tipo_usu_menu == 2){
		$minha_conta = "editar_conta.php?user_id={$id_user_menu}&action=edit";
	}else{
		$minha_conta = "minha_conta.php?id={$id_user_menu}";
	}
	
	?>

	<div class='menu col-md-2 col-sm-12 p-0' id='menu'>
				<div class='div-img-school'>
					<img src='<?php echo "../img/{$img_escola}"; ?>' class='img-school'>
				</div>
				
		    		<ul class='menu-ul text-center text-md-left'>
		    			<li class='menu-item'><a href='inicio.php'><div class='name-item-menu'><i class='fas fa-home'></i>Inicio</div> </a></li>

		<?php

		if ($tipo_usu_menu == 2) {

		?>

			<li class='menu-item'><a href='dashboard.php'><div class='name-item-menu'><i class='fas fa-chart-pie'></i>   Dashboard</div></a></li>
		    			<li class='menu-item' id='show-cad-user'>
		    				<a>
		    					<div class='name-item-menu'>
		    						<i class='fas fa-user-plus'></i>Cadastrar Usuários
		    					</div>
		    					<div class='fas fa-plus more-menu'></div>
		    				</a>

		    			</li>
		    			
	    				<ul class='sub-menu' id='cad-user'> 

	    					<li class='menu-item'><a href='cad_admin.php'><div class='name-item-menu'><i class='fas fa-user-tie'></i>   Administradores</div></a></li>
							<li class='menu-item'><a href='cad_aluno.php'><div class='name-item-menu'><i class='fas fa-user-graduate'></i>   Alunos</div></a></li>
							<li class='menu-item'><a href='cad_prof.php'><div class='name-item-menu'><i class='fas fa-chalkboard-teacher'></i>   Professores</div></a></li>
	    				
	    				</ul>
		    			

		    			<li class='menu-item' id='show-user'>
		    				<a>

			    				<div class='name-item-menu'>

			    					<i class='fas fa-user-cog'></i> Gerenciar Usuários 

			    				</div>

			    				<div class='fas fa-plus more-menu'></div>
		    				
		    				</a>
		    				
		    			</li>

		    			<ul class='sub-menu' id='user'> 

	    					<li class='menu-item'>
	    						<a href='showData.php?type=admin'>
		    						<div class='name-item-menu'>
		    							<i class='fas fa-user-tie'></i>   Administradores
		    						</div>

		    					</a>
		    				</li>
							
							<li class='menu-item'>
								<a href='showData.php?type=aluno'>
									<div class='name-item-menu'>
										<i class='fas fa-user-graduate'></i>   Alunos
									</div>
								</a>
							</li>
							
							<li class='menu-item'>
								<a href='showData.php?type=prof'>
									<div class='name-item-menu'><i class='fas fa-chalkboard-teacher'></i>   Professores
									</div>
								</a>
							</li>
		    				
		    			</ul> 
		    			

		    			<li class='menu-item'>
		    				<a>
		    					<div class='name-item-menu'>
									<i class='fas fa-book-open'></i>   Disciplinas
								</div>
								
			    				<div class='fas fa-plus more-menu'></div>
							</a>
						</li>
						
						<ul class='sub-menu' id='menu-disc'> 

	    					<li class='menu-item'><a href='cad_disc.php'><div class='name-item-menu'><i class="fas fa-plus"></i>Cadastrar</div></a></li>
							<li class='menu-item'><a href='view_disc.php'><div class='name-item-menu'><i class="fas fa-eye"></i>Visualizar</div></a></li>
							<li class='menu-item'><a href='join_disc_prof.php'><div class='name-item-menu'><i class="fas fa-chalkboard-teacher"></i>Turma - Disciplina</div></a></li>
	    				
	    				</ul>

						<li class='menu-item'><a href='cad_news.php'><div class='name-item-menu'>
							<i class='far fa-newspaper'></i>   Notícias
							</div></a></li>

		    			<li class='menu-item' id='show-turmas'>

		    				<a>
		    					<div class='name-item-menu'><i class='fas fa-users'></i> Turmas
		    					 </div><div class='fas fa-plus more-menu'></div>
		    					</a>

		    			</li>

		    			<ul class='sub-menu' id='turmas'> 

		    					<li class='menu-item'><a href='cad_turma.php'><div class='name-item-menu'><i class='fas fa-table'></i>   Cadastrar Turma</div></a></li>
								<li class='menu-item'><a href='turmas_adm.php'><div class='name-item-menu'><i class='	fas fa-search'></i>Visualizar turmas</div></a></li>
								
			    			</ul>
		    			

		    			<li class='menu-item'><a href='config_site.php'><div class='name-item-menu'><i class='fas fa-tools'></i>   Configurações do Site</div></a></li>
		    			<li class='menu-item'><a href='galeria.php'><div class='name-item-menu'><i class='far fa-images'></i>   Galeria do Site</div></a></li>
		    			<li class='menu-item'><a href='documentos.php'><div class='name-item-menu'><i class="fas fa-file-alt"></i>   Documentos</div></a></li>
		    			
	<?php
	
	}else if($tipo_usu_menu == 1){

	?>

		    		<li class='menu-item'>
		    			<a href='agenda.php'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-book'></i>Agenda
		    				</div>
		    			</a>
		    		</li>

		    		<li class='menu-item' id='show-freq'>
		    			
		    			<a>
		    				
			    			<div class='name-item-menu'>
			    				<i class='far fa-calendar-alt'></i>Frequências
			    			</div>
			    			<div class='fas fa-plus more-menu'></div>
		    			</a>

					</li>

					<ul class='sub-menu' id='freq'> 
		    			
	    				<li class='menu-item'>
	    					<a href='cad_falta.php'>
	    						<div class='name-item-menu'>
	    							<i class='far fa-calendar-plus'></i>Cadastrar Frequência
	    						</div>
	    					</a>
	    				</li>
						
						<li class='menu-item'>
							<a href='ger_falta.php'>
								<div class='name-item-menu'>
									<i class='far fa-edit'></i>Gerenciar Frequência
								</div>
							</a>
						</li>
					</ul>
		    		
		    		<li class='menu-item'>
		    			<a href='cad_notas.php'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-globe'></i>Cadastrar Notas
		    				</div>
		    			</a>
		    		</li>

		    		<li class='menu-item'>
		    			<a href='#'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-book'></i>Cadastrar Atividade
		    				</div>
		    			</a>
		    		</li>
		    		
		    		<li class='menu-item'>
		    			<a href='turma_prof.php'>
		    				<div class='name-item-menu'>
		    					<i class='fas fa-users-cog'></i>  Minhas Aulas
		    				</div>
		    			</a>
		    		</li>

	<?php 

		}else if($tipo_usu_menu == 0){ 

	?>
		
		<a href='agenda.php'>
			<li class='menu-item'>
				<div class='name-item-menu'>
					<i class='fas fa-book'></i> Agenda
				</div>
			</li>
		</a>
		    		
		<a href='freq.php'>
			<li class='menu-item'>
				<div class='name-item-menu'>
					<i class='fas fa-chart-line'></i> Frequência
				</div>
			</li>
		</a>

		<li class='menu-item'>
			<a href='boletim.php'>
				<div class='name-item-menu'>
					<i class='fas fa-file-invoice'></i> Histórico Escolar
				</div>
			</a>
		</li>

		<li class='menu-item'>
			<a href='turma.php'>
				<div class='name-item-menu'>
					<i class='fas fa-users'></i> Minha Turma
				</div>
			</a>
		</li>

		<li class='menu-item'>
			<a href='notas.php'>
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
	<li class='menu-item-exit d-md-none d-block text-center' id='close-menu' style='max-height: 48px;'>Abrir Menu</li>

<script>

$(document).ready(function() {
  	$('.menu-item').click(function(e){
		$(e.target).parent('a').parent('li').next().slideToggle(400);
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