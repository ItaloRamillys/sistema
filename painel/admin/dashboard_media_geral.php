<div class="container">
  <div class="row">
    <div class="col-md-9 col-12">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script type="text/javascript" src="<?=$configBase?>/../js/draw_dash_avg_by_subject.js"></script>
    <div class="box">

      <div class="div-title-box">
          <h1 class="title-box-main  d-flex justify-content-center">Dashboard Escolar</h1>
      </div>

      <div class="container p-3">
        <div class="row text-center">
          <div class="col-12">
            <div class="row">
              <div class="col-12 p-2">
                <button class="btn btn-sm btn-primary p-1 btn-dash" id="dash_attendance">Média geral das disciplinas</button>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="row justify-content-center my-2">
              <button id="draw_dash" class="btn btn-sm btn-primary" onclick="drawDash()">Desenha gráfico</button>
            </div>
          </div>
        </div>
      <div class="row my-2 main">
        <div class="col-12" id="graphic">
          <canvas id="myChart"></canvas>
        </div>
      </div>
      </div> 
    </div>
</div>
    <div class="col-md-3 col-12">
      <?php require("{$configThemePath}/sidebar.php"); ?>
    </div>
  </div>
</div>