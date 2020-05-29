function getDadosAjaxCronograma(){ 

    var turma = document.getElementById('turmas_src').value;
    var ajax    = new XMLHttpRequest();
    var method  = "GET";
    var url     = "http://localhost/sistema/painel/ajax/turma_aula.php?turma=" + turma;
    var async   = true;

    ajax.open(method, url, async);
    ajax.send();

    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            var aula = "";
            var aula_atual = "";
            console.log(data);

                var aula_2 = "";
                var aula_3 = "";
                var aula_4 = "";
                var aula_5 = "";
                var aula_6 = "";

                for (var i = 0; i < 20; i++) {

                    if(typeof(data[0][i]) == 'undefined'){
                        aula_atual = "--";
                    }else{
                        if(data[0][i].dia_da_semana == '2'){
                            aula_2 += data[0][i].nome_disc + " - " + data[0][i].nome + "<br><small>" + data[0][i].horario_de_inicio + "-" + data[0][i].horario_de_termino  + "</small><a href='../controllers/turma_disc_controller.php?td=" + data[0][i].id_DT + "&action=delete' class='confirmation btn'><i class='material-icons' style='font-size:20px;color:#dc3545'>remove_circle</i> </a><br>";
                        }else if(data[0][i].dia_da_semana == '3'){
                            aula_3 += data[0][i].nome_disc + " - " + data[0][i].nome + "<br><small>" + data[0][i].horario_de_inicio + "-" + data[0][i].horario_de_termino  + "</small><a href='../controllers/turma_disc_controller.php?td=" + data[0][i].id_DT + "&action=delete' class='confirmation btn'><i class='material-icons' style='font-size:20px;color:#dc3545'>remove_circle</i> </a><br>";
                        }else if(data[0][i].dia_da_semana == '4'){
                            aula_4 += data[0][i].nome_disc + " - " + data[0][i].nome + "<br><small>" + data[0][i].horario_de_inicio + "-" + data[0][i].horario_de_termino  + "</small><a href='../controllers/turma_disc_controller.php?td=" + data[0][i].id_DT + "&action=delete' class='confirmation btn'><i class='material-icons' style='font-size:20px;color:#dc3545'>remove_circle</i> </a><br>";
                        }else if(data[0][i].dia_da_semana == '5'){
                            aula_5 += data[0][i].nome_disc + " - " + data[0][i].nome + "<br><small>" + data[0][i].horario_de_inicio + "-" + data[0][i].horario_de_termino  + "</small><a href='../controllers/turma_disc_controller.php?td=" + data[0][i].id_DT + "&action=delete' class='confirmation btn'><i class='material-icons' style='font-size:20px;color:#dc3545'>remove_circle</i> </a><br>";
                        }else if(data[0][i].dia_da_semana == '6'){
                            aula_6 += data[0][i].nome_disc + " - " + data[0][i].nome + "<br><small>" + data[0][i].horario_de_inicio + "-" + data[0][i].horario_de_termino  + "</small><a href='../controllers/turma_disc_controller.php?td=" + data[0][i].id_DT + "&action=delete' class='confirmation btn'><i class='material-icons' style='font-size:20px;color:#dc3545'>remove_circle</i> </a><br>";
                        }
                    }

                }

                document.getElementById('aulas_seg').innerHTML = aula_2;
                document.getElementById('aulas_ter').innerHTML = aula_3;
                document.getElementById('aulas_qua').innerHTML = aula_4;
                document.getElementById('aulas_qui').innerHTML = aula_5;
                document.getElementById('aulas_sex').innerHTML = aula_6;    
              
            var participantes = "";

            for (var i = 0; i < data[1].length; i++) {
                participantes   += "<div class='col-6 col-md-3'> <div class='container'> <div class='row'><div class='col-12'><img src = 'http://localhost/sistema/img/" 
                                + data[1][i].img_profile 
                                + "' width='90px' height='90px'></div><div class='col-12'> " 
                                + data[1][i].nome + " " + data[1][i].sobrenome  
                                + "</div><div class='col-12'>"    
                                + "<a href='../controllers/turma_aluno_controller.php?ta=" + data[1][i].id_TA + "&action=delete' class='confirmation btn btn-danger btn-sm my-2'>Remover</a></div></div></div></div>";
            }

            if(participantes == ""){
                participantes = "Nenhum aluno cadastrado nessa turma";
            }

            document.getElementById('participantes').innerHTML = participantes;

            $('.confirmation').on('click', function(){ return confirm('Deseja realmente excluir?')});
        }
    }
}