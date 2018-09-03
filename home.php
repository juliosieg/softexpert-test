<!-- Funções da página -->
<script src="js/home.js"></script>

<br>

<div class='col-md-6'>
	<div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-cash"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total de vendas realizadas</span>
          <span class="info-box-number totalVendasRealizadas"></span>
        </div>
    </div>
</div>

<div class='col-md-6'>
	<div class="info-box">
        <span class="info-box-icon bg-red"><i class="ion ion-information-circled"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Impostômetro</span>
          <span class="info-box-number impostometro"></span>
        </div>
    </div>
</div>

<div class='col-md-12'>

	<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Total de Vendas x Impostos</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              <div id="donut-chart" style="height: 300px;"></div>
            </div>
            <div class="col-md-4">
              <ul class="chart-legend clearfix">
                <li><i class="fa fa-circle-o text-aqua"></i> Total de vendas realizadas</li>
                <li><i class="fa fa-circle-o text-red"></i> Percentual de impostos sobre o valor total de vendas</li>
              </ul>
            </div>
          </div>
        </div>
    </div>

</div>