function getDadosAjax(){ 
    var turma_ano   = document.getElementById('turma_ano').value;
    var ajax    = new XMLHttpRequest();
    var method  = "GET";
    var url     = "http://localhost/sistema/painel/ajax/turmas_prof.php?turma_ano="+turma_ano;
    var async   = true;

    ajax.open(method, url, async);
    ajax.send();

    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);

            var select = document.getElementById('turma_ano');

            var date = document.getElementById('date').value;            

            var disc_hora_turma = select.options[select.selectedIndex].innerText;

            var result = "";

            if (data[0].length == 0 || date == "") {
                data = "<div class='p-4'>Nenhum aluno encontrado</div>";
                result = "<div class='row justify-content-center'><span class='my-3 bg-dark text-light p-2 rounded'>Escolha uma data</span></div>";
                document.getElementById('result-falta').innerHTML = data; 
            }else{

                result = "<div class='row justify-content-center'><span class='my-3 bg-dark text-light p-2 rounded'>" + disc_hora_turma  +  "</span></div>";

                for (var i = 0; i < data[0].length; i++) {
                    result += 
                        "<article class='row p-2'>" +
                        "<div class='col-6'><div class='row'>" + 
                        "<div class='col-12 col-md-3'>" + data[0][i].img_profile + "</div>" + 
                        "<div class='col-12 col-md-9 m-auto'><input type='hidden' name='id_usu[]' value='" + data[0][i].id + "'>" + 
                        data[0][i].nome + " " +data[0][i].sobrenome + 
                        "</div></div></div>" + 
                        "<div class='col-6 m-auto'>" + 
                        "<select name='tipo_falta[]' class='col-12'>" +
                        "<option value='p'>Presente</option>" +
                        "<option value='f'>Falta</option>" +
                        "<option value='j'>Falta justificada</option>" +
                        "</select>" +
                        "</div> </article>";
                }

               $('.confirmation').on('click', function(){ return confirm('Deseja realmente incluir esta frequência?')});
                result += "<input type='submit' class='confirmation btn btn-primary' value='Cadastrar faltas'>";
            }
                document.getElementById('result-falta').innerHTML = result;
            
        }
    }
}