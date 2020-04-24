function getDadosAjax(){ 

    var dados           = document.getElementById('turma_ano').value;
    var dados_filtrado  = dados.split("-");
    var id_DT           = dados_filtrado[3];
    var date            = document.getElementById('data').value;
    var ajax            = new XMLHttpRequest();
    var method          = "GET";
    var url             = "http://localhost/sistema/painel/ajax/view_freq.php?data='" + date + "'&id_DT=" + id_DT;
    var async           = true;

    ajax.open(method, url, async);

    ajax.send();

    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);


            var select = document.getElementById('turma_ano');

            var disc_hora_turma = select.options[select.selectedIndex].innerText;

            var data_freq = document.getElementById('data').value;

            var data_formatada = "Escolha uma data";
            if(data_freq != ""){
                var data_split = data_freq.split("-");
                data_formatada = data_split[2] + "/" + data_split[1] + "/" + data_split[0];
            }

            if (data[0].length == 0) {
                data = "<div class='p-4'>Nenhum aluno encontrado</div>";  
                document.getElementById('result-falta').innerHTML = data; 

            }else{

                var result = "<div class='row justify-content-center'><span class='my-3 bg-dark text-light p-2 rounded'>" + disc_hora_turma + "</span></div>";

                result += "<div class='row justify-content-center'><span class='my-3 bg-dark text-light p-2 rounded'> Dia da freqûência: " + data_formatada + "</span></div>";

                for (var i = 0; i < data[0].length; i++) {
                    result += 
                        "<article class='row p-2'>" +
                        "<div class='col-md-6 col-12'><div class='row m-md-0 my-3'>" + 
                        "<div class='col-3'><img src='../img/" + data[0][i].img_profile + "'' class='img-profile-aluno'></div>" + 
                        "<div class='col-9 m-auto text-center'><input type='hidden' name='id_usu[]' value='" + data[0][i].id + "'>" + 
                        data[0][i].nome + " " +data[0][i].sobrenome + 
                        "</div></div></div>" + 
                        "<div class='col-md-6 col-12 m-auto bg-dark text-light rounded p-2'>" + 
                        "<select name='tipo_falta[]' class='col-12' id='sel_tipo_falta" + i + "'>" +
                        "<option value='p'>Presente</option>" +
                        "<option value='f'>Falta</option>" +
                        "<option value='j'>Falta justificada</option>" +
                        "</select>" +
                        "</div> </article>";


                }

                result += "<input type='submit' class='confirmation btn btn-primary' value='Cadastrar faltas'>";

                document.getElementById('result-falta').innerHTML = result;

                for (var i = 0; i < data[0].length; i++) {
                    document.getElementById('sel_tipo_falta' + i).value = data[0][i].freq;
                }

                $('.confirmation').on('click', function(){ return confirm('Deseja realmente incluir esta frequência?')});
            }
             
        }
    }
}
