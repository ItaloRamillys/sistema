function drawDash(){ 

    var url_php = document.querySelector(".btn-active").getAttribute("id");
    var mes     = document.getElementById('input').value;
    var ajax    = new XMLHttpRequest();
    var method  = "GET";
    var url     = "http://localhost/sistema/painel/admin/dashboards/"+url_php+".php?input=" + mes;
    var async   = true;


    ajax.open(method, url, async);
    ajax.send();

    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            draw(mes,data);
        }
    }          
}

function draw(mes, data){
    var ctx = document.getElementById('myChart').getContext('2d');
    var data3 = data;

    var media = [];
    var disc = [];

    var t = data3.length;
    var aux;

    for (var i = 0; i < t; i++) {
        disc.push(data3[i]['nome_disc']);              
    }
    for (var i = 0; i < t; i++) {
        aux = parseFloat(data3[i]['qtde_falta']);
        media.push(aux);  
    }         

      var highest = Math.max.apply(null,media) + 3;

      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: disc,
              datasets: [{
                  data: media,
                  backgroundColor: [
                      
                  ],
                  borderColor: [
                  ],
                  borderWidth: 1
              }]
          },
          options: {
            legend: {
                display: false
              },
            title: {
                  display: true,
                  text: 'Faltas por disciplina no período '+mes+'/2020',
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
      console.log(myChart);
}