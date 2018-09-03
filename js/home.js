$(function (){
	getTotalVendas();
	getImpostometro();
	preencheGrafico();
})

function preencheGrafico() {

    var totalVendas = null;
    var totalImpostos = null;

    $.ajax({
        type: "POST",
       url: 'funcoes/funcoesHome.php',
        data: {funcao: "getTotaisGraficos"},
        success: function (data) {
            var test = jQuery.parseJSON(data);
            totalVendas = test[0]["somatotal"];
            totalImpostos = test[0]["somaimpostos"];
        },
        complete: function () {

           var donutData = [
                {label: "Total de Vendas", data: totalVendas, color: "#00c0ef"},
                {label: "Total de Impostos", data: totalImpostos, color: "#dd4b39"}
            ];
            $.plot("#donut-chart", donutData, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.5,
                        label: {
                            show: true,
                            radius: 2.3 / 3,
                            formatter: labelFormatter,
                            threshold: 0.1
                        }

                    }
                },
                legend: {
                    show: false
                }
            });
            /*
             * Custom Label formatter
             * ----------------------
             */
            function labelFormatter(label, series) {
                return '<div style="font-size:10px; text-align:center; padding:10px; color: #fff; font-weight: 600;">'
                        + label
                        + "<br>"
                        + Math.round(series.percent) + "%</div>";
            }
        }
    });
}


function numberToReal(numero) {
    var numero = numero.toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

function getTotalVendas(){

	$.ajax({
        type: "POST",
        url: 'funcoes/funcoesHome.php',
        data: {funcao: "getTotalVendas"},
        success: function (html) {

            var test = JSON.parse(html);

            $(".totalVendasRealizadas").text(numberToReal(Number(test[0].somatotal)));

        }

    });

}

function getImpostometro(){

	$.ajax({
        type: "POST",
        url: 'funcoes/funcoesHome.php',
        data: {funcao: "getImpostometro"},
        success: function (html) {

            var test = JSON.parse(html);

            $(".impostometro").text(numberToReal(Number(test[0].somaimpostos)));


        }

    });

}