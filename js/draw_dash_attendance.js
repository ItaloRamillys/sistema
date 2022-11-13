function drawDash(){ 
    var mes = document.getElementById('input_month').value;
    var ano = document.getElementById('input_year').value;

    if(mes != "" && ano != ""){
      var ajax    = new XMLHttpRequest();
      var method  = "GET";
      var url     = "http://localhost/sistema/painel/admin/dashboards/dash_attendance.php?input=" + ano + "-" + mes;
      var async   = true;

      ajax.open(method, url, async);
      ajax.send();

      ajax.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
              var data = JSON.parse(this.responseText);
              if (Array.isArray(data) && data.length){
                draw(mes, ano ,data);
              }else{
                alert("Nosso sistema não retornou nenhum dado referente a data digitada");
              }
          }
      }          
    }else{
      alert("É obrigatório preencher o campo");
    }
}

function draw(mes, ano, data){
    var parent = document.getElementById("graphic");
    var chart = document.getElementById("myChart");
    var tag = document.createElement("canvas");
    parent.removeChild(chart);
    parent.appendChild(tag);
    tag.setAttribute('id', 'myChart');

    var ctx = document.getElementById('myChart').getContext('2d');
    var data3 = data;

    var media = [];
    var disc = [];

    var t = data3.length;
    var aux;

    for (var i = 0; i < t; i++) {
        disc.push(data3[i]['name_subject']);              
    }
    for (var i = 0; i < t; i++) {
        aux = parseFloat(data3[i]['qtde_falta']);
        media.push(aux);  
    }         

      var highest = Math.max.apply(null,media) + 3;
      var color_background_bar = [
                          'rgba(255, 99, 132, 0.6)',
                          'rgba(54, 162, 235, 0.6)',
                          'rgba(255, 206, 86, 0.6)',
                          'rgba(75, 192, 192, 0.6)',
                          'rgba(153, 102, 255, 0.6)',
                          'rgba(255, 159, 64, 0.6)',
                          'rgba(255, 99, 132, 0.6)',
                          'rgba(54, 162, 235, 0.6)',
                          'rgba(255, 206, 86, 0.6)',
                          'rgba(75, 192, 192, 0.6)',
                          'rgba(153, 102, 255, 0.6)',
                          'rgba(255, 159, 64, 0.6)',
                          'rgba(255, 99, 132, 0.6)',
                          'rgba(54, 162, 235, 0.6)',
                          'rgba(255, 206, 86, 0.6)',
                          'rgba(75, 192, 192, 0.6)',
                          'rgba(153, 102, 255, 0.6)',
                          'rgba(255, 159, 64, 0.6)'
                          ];
          var color_border_bar = [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                          ];
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: disc,
              datasets: [{
                  data: media,
                  backgroundColor: color_background_bar,
                  borderColor: color_border_bar,
                  borderWidth: 1
              }]
          },
          options: {
            legend: {
                display: false
              },
            title: {
                  display: true,
                  text: 'Faltas por disciplina no período '+mes+'/'+ano,
                  fontSize: 22,
                  fontStyle: 300,
                  fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"'
              },
              scales: {
                  yAxes: [{
                      ticks: {
                         max: highest,
                         min: 0,
                         stepSize: 1
                       }
                  }]
              },
              animation: {
                duration: 1,
                onComplete: function() {
                  var chartInstance = this.chart,
                  ctx = chartInstance.ctx;

                  ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);

                  ctx.textAlign = 'center';
                  ctx.textBaseline = 'bottom';

                  this.data.datasets.forEach(function(dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);

                    meta.data.forEach(function(bar, index) {
                      if (dataset.data[index] > 0) {
                        var data = dataset.data[index];
                        ctx.fillText(data, bar._model.x, bar._model.y);
                      }
                    });
                  });
                }
              }
          }
  });
}