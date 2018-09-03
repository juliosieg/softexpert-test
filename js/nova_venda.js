$(function (){

	getTodosProdutos();

})

function finalizarVenda(){

	var arrayCodigo= [];
	var arrayQuantidade = [];
	var arrayDescricao = [];
	var arrayValorUnitario = [];
	var arrayValorTotal = [];
	var arrayImpostos = [];
	var valorTotalVenda = $(".totalVenda").text();
	var valorTotalImpostos = $(".totalImpostos").text();

	$("tr").each(function (){

		if($(this).attr("rel")){

			$(this).find("td").each(function(index, val){

				if(index == 1){
					arrayCodigo.push($(this).text());
				}else if(index == 2){
					arrayQuantidade.push($(this).text());
				}else if(index == 3){
					arrayDescricao.push($(this).text());
				}else if(index == 4){
					arrayValorUnitario.push($(this).text());
				}else if(index == 5){
					arrayValorTotal.push($(this).text());
				}else if(index == 6){
					arrayImpostos.push($(this).text());
				}
			})
		}

	});


	$.ajax({
        type: "POST",
        url: 'funcoes/funcoesNovaVenda.php',
        data: {
        	funcao: "finalizarVenda",
        	arrayCodigo: arrayCodigo,
        	arrayQuantidade: arrayQuantidade,
        	arrayDescricao: arrayDescricao,
        	arrayValorUnitario: arrayValorUnitario,
        	arrayValorTotal: arrayValorTotal,
        	arrayImpostos: arrayImpostos,
        	valorTotalVenda: valorTotalVenda,
        	valorTotalImpostos: valorTotalImpostos
    	},
        success: function (html) {

            window.location.href = 'index.php?menu=listar_venda';

        }

    });

}

function numberToReal(numero) {
    var numero = numero.toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

function excluirLinha(codigo){

	$("tr").each(function (){

		if($(this).attr("rel") == codigo){

			$(this).remove();

			$("#selectProduto option").each(function (){


				if($(this).val() == codigo){

					$(this).removeClass("desabilitado");
					$(this).removeAttr("disabled");

				}
			})

			var valorTotalGeral = '';
			var valorImpostos = '';

			$(".valorTotal").each(function (){

	    		var valor = $(this).text();

	    		valor = valor.replace(".", "");
	    		valor = valor.replace(",", ".");
	    		valor = valor.replace("R$", "");
	    		valor = valor.replace(" ", "");

	    		valorTotalGeral = Number(valorTotalGeral) + Number(valor);

	    	})

	    	$(".totalImpostosItem").each(function (){
	    		
	    		var valor = $(this).text();
	    		valor = valor.replace(".", "");
	    		valor = valor.replace(",", ".");
	    		valor = valor.replace("R$", "");
	    		valor = valor.replace(" ", "");

	    		valorImpostos = Number(valorImpostos) + Number(valor);

	    	})

	    	if(valorTotalGeral){
	    		$(".totalVenda").text(numberToReal(valorTotalGeral));
	    	}

	    	if(valorImpostos){
	    		$(".totalImpostos").text(numberToReal(valorImpostos));
	    	}

	    	var countTotalLinhas = 0;

	    	$("tr").each(function (){

	    		countTotalLinhas++;
	
	    	});

	    	if(countTotalLinhas == 1){

	    		var linha = '<tr class="nenhumProdutoSelecionado">';
	    		linha += '<td>Nenhum produto selecionado</td>';
	    		linha += '</tr>';

	    		$(".totalVenda").text("R$ 0,00");
	    		$(".totalImpostos").text("R$ 0,00");

	    		$(".table > tbody").append(linha);

		    	$(".finalizarVenda").attr("disabled", "disabled");

	    	}

	    	
		}
	})
}

function adicionarProduto(){

	var produtoSelecionado = $("#selectProduto").find("option:selected").val();
	var quantidadeSelecionada = $("#quantidade").val();

	if(produtoSelecionado == null || produtoSelecionado == ""){
		
		$.notify({
            message: 'Selecione um produto'
        }, {
            type: 'danger'
        });

    }else if(quantidadeSelecionada == null || quantidadeSelecionada == "" || quantidadeSelecionada == 0){
		$.notify({
            message: 'Informe a quantidade'
        }, {
            type: 'danger'
        });
	}else{

		var valorTotalGeral = '';
		var valorImpostos = '';

		$.ajax({
		    type: "POST",
		    url: 'funcoes/funcoesNovaVenda.php',
		    data: {funcao: "getInfoProduto", idProduto: produtoSelecionado},
		    success: function (html) {

		    	$("#selectProduto").find("option:selected").addClass("desabilitado");
		    	$("#selectProduto").find("option:selected").attr("disabled", "disabled");
  	
		    	var test = jQuery.parseJSON(html);

		    	var valorTotal = Number(quantidadeSelecionada) * Number(test[0].valor_venda);
		    	var impostos = test[0].percentual_imposto;

		    	var totalImpostos = Number(valorTotal) * (impostos / 100);

		    	$(".nenhumProdutoSelecionado").remove();

		    	var linha = '<tr rel="'+test[0].id+'">';
		    	linha += '<td style="text-align: center;">';
		    	linha += '<i class="fa fa-minus-circle" onclick="excluirLinha('+test[0].id+')" style="color: red; margin-top: 3px; cursor: pointer"></i>'
		    	linha += "</td>";
		    	linha += '<td>';
		    	linha += test[0].id;
		    	linha += "</td>";
		    	linha += '<td>';
		    	linha += quantidadeSelecionada;
		    	linha += "</td>";
		    	linha += '<td>';
		    	linha += test[0].descricao;
		    	linha += "</td>";
		    	linha += '<td>';
		    	linha += numberToReal(parseFloat(test[0].valor_venda));
		    	linha += "</td>";
		    	linha += '<td class="valorTotal">';
		    	linha += numberToReal(valorTotal);
		    	linha += "</td>";
		    	linha += '<td class="totalImpostosItem">';
		    	linha += numberToReal(totalImpostos);
		    	linha += "</td>";
		    	linha += '</tr>';

		    	$(".table > tbody").append(linha);

		    	$.notify({
		            message: 'Produto adicionado com sucesso.'
		        }, {
		            type: 'success'
		        });

		    	$("#selectProduto").val("");
		    	$("#quantidade").val("");
		
		    	$(".valorTotal").each(function (){

		    		var valor = $(this).text();

		    		valor = valor.replace(".", "");
		    		valor = valor.replace(",", ".");
		    		valor = valor.replace("R$", "");
		    		valor = valor.replace(" ", "");

		    		valorTotalGeral = Number(valorTotalGeral) + Number(valor);

		    	})

		    	$(".totalImpostosItem").each(function (){
		    		
		    		var valor = $(this).text();
		    		valor = valor.replace(".", "");
		    		valor = valor.replace(",", ".");
		    		valor = valor.replace("R$", "");
		    		valor = valor.replace(" ", "");

		    		valorImpostos = Number(valorImpostos) + Number(valor);

		    	})

		    	$(".totalVenda").text(numberToReal(valorTotalGeral));
		    	$(".totalImpostos").text(numberToReal(valorImpostos));

		    	$(".finalizarVenda").removeAttr("disabled");
		    }

		});	
	}
}

function getTodosProdutos(){

	$.ajax({
        type: "POST",
        url: 'funcoes/funcoesNovaVenda.php',
        data: {funcao: "getTodosProdutos"},
        success: function (html) {

            var test = jQuery.parseJSON(html);

            var i = 0;
            var categoria = '';
            var fechaOptGroup = false;

            $('#produto').find('option').remove();
			$("#produto").append("<option value=''>Selecione uma opção</option>");
            
			$.each(test, function (index, item) {

				fechaOptGroup = false;

				if(categoria != item.descricaotipo || categoria == ''){

					categoria = item.descricaotipo;

					i++;

					$("#selectProduto").append("<optgroup label = '"+categoria+"' class='optgroup"+i+"'>");

					fechaOptGroup = true;

				}

                $("#selectProduto > .optgroup"+i).append("<option value=\"" + item.id + "\" descricao=\"" + item.descricao + "\">" + item.descricao + "</option>")
            
            });

        }

    });	

}