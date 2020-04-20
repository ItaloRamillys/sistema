<div class="container">
  <div class="row">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <div class="box">

      <div class="div-title-box">
          <h1 class="title-box-main  d-flex justify-content-center">Dashboard Escolar</h1>
      </div>

      <div class="container p-3">
        
      
      <?php 

      //MEDIA POR DISC E TURMA
      $queryChart = "select b.*, c.nome_turma from turma c inner join(select avg(o.nota) as 'media', i.nome_disc as 'disc', i.id_turma, o.id_DT from disc_alu_turma o inner join (select y.nome_disc, w.id_DT, w.id_turma from disciplina y inner join (select * from disc_turma where ano = 2020)w on y.id_disc = w.id_disc)i on i.id_DT = o.id_DT group by o.id_DT) b on b.id_turma = c.id_turma";

      //MEDIA POR DISC GERAL
      $queryChart2 = "select avg(o.nota) as 'media', w.nome_disc as 'disc' from disc_alu_turma o inner join (select dt.id_DT, d.* from disc_turma dt inner join (select nome_disc, id_disc from disciplina) d on dt.id_disc = d.id_disc) w on w.id_DT = o.id_DT group by w.id_disc";

      $stmtChart = $conexao->query($queryChart);

      $rowChart = $stmtChart->fetchAll(PDO::FETCH_ASSOC);
      
      $stmtChart2 = $conexao->query($queryChart2);

      $rowChart2 = $stmtChart2->fetchAll(PDO::FETCH_ASSOC);
      ?>

      <div class="row">
        <div class="col-12 col-md-6">
          
          <canvas class="rounded shadow" id="myChart"></canvas>              
        </div>

        <div class="col-12 col-md-6">
          <canvas class="rounded shadow" id="myChart2"></canvas>              
        </div>
      </div>
      
      <script>
        //CHART 1
          var ctx = document.getElementById('myChart').getContext('2d');

          var data = <?php echo json_encode($rowChart); ?>;
          var media = [];
          var disc = [];
          var nome_turma = [];
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


          var t = data.length;
          var aux;

          for (var i = 0; i < t; i++) {
            disc.push(data[i]['disc'] + "-" + data[i]['nome_turma']);              
          }
          for (var j = 0; j < t; j++) {
            aux = parseFloat(data[j]['media']);
            media.push(aux.toFixed(2));  
          }            
          
          console.log(media);

          var myChart = new Chart(ctx, {
              type: 'bar',
             
              data: {
                labels: disc,
                datasets: [{
                  label:"Esconder/Mostrar",
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
                      text: 'Média das disciplinas por turma',
                      fontSize: 22,
                      fontStyle: 300
                  },
                  scales: {
                      yAxes: [{
                          ticks: {
                             min: 0,
                             max: 10,
                             stepSize: 0.5,
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
      </script>

      <script>
        //CHART 1
          var ctx = document.getElementById('myChart2').getContext('2d');

          var data = <?php echo json_encode($rowChart2); ?>;

          var media = [];
          var disc = [];

          var t = data.length;
          var aux;

          for (var i = 0; i < t; i++) {
            disc.push(data[i]['disc']);              
          }
          for (var i = 0; i < t; i++) {
            aux = parseFloat(data[i]['media']);
            media.push(aux.toFixed(2));  
          }            
          
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: disc,
                  datasets: [{
                      data: media,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.6)',
                          'rgba(54, 162, 235, 0.6)',
                          'rgba(255, 206, 86, 0.6)',
                          'rgba(75, 192, 192, 0.6)',
                          'rgba(153, 102, 255, 0.6)',
                          'rgba(255, 159, 64, 0.6)'
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)'
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
                      text: 'Média geral das disciplinas',
                      fontSize: 22,
                      fontStyle: 300
                  },
                  scales: {
                      yAxes: [{
                          ticks: {
                             min: 0,
                             max: 10,
                             stepSize: 0.5,
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
      </script>
      </div> 
    </div>
  </div> 
</div>     
