<!-- Funções da página -->
<script src="js/nova_venda.js"></script>

<style>
	.desabilitado{

		background-color: #ececec;

	}
</style>

<section class="content-header">

    <h1>
        Vendas
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tag"></i>SoftExpert Test</a></li>
        <li class="">Vendas</li>
        <li class="active">Nova Venda</li>
    </ol>
</section>

<br>

<div class="col-xs-12">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Adicionar produto à venda</h3>
		</div>
		<div class='box-body'>
			<div class='col-xs-8'>
				<label for="produto">Produtos</label>
		    	<select class="form-control" id="selectProduto">
		    		<option value=''>Selecione uma opção</option>
		    	</select>
			</div>
			<div class='col-xs-2'>
				<label for="quantidade">Quantidade</label>
		    	<input type='number' class='form-control' name='quantidade' id='quantidade'>
			</div>
			<div class='col-xs-2'>
				<label>&nbsp;</label>
				<button type="button" onclick='adicionarProduto()' class="btn btn-block btn-success">Adicionar</button>
			</div>
		</div>
	</div>
</div>


<div class="col-xs-12">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Produtos selecionados</h3>
		</div>

	    <div class="box-body table-responsive no-padding">
	    	<table class="table table-striped">
	        	<tbody>
	        		<tr>
	        			<th>&nbsp;</th>
			        	<th>Cód.</th>
			        	<th>Qtd.</th>
			        	<th>Descrição</th>
			        	<th>Valor Unitário</th>
			        	<th>Valor Total</th>
			        	<th>Impostos</th>
			        </tr>
	        		<tr class='nenhumProdutoSelecionado'>
	      				<td>Nenhum produto selecionado</td>
	      			</tr>
	      		</tbody>
	      	</table>
	      	
	      	<br>
	      	<br>
	      	
	      	<div class="col-xs-12" style="text-align: right; padding-bottom: 10px">
	      		<div class='col-xs-9'>
	      			<b> Valor Total da Venda: </b>
	      		</div>
	      		<div class='col-xs-3'>
	      			<span class='totalVenda'>R$ 0,00</span><br>
	      		</div>
	      		<div class='col-xs-9'>
	      			<b> Valor Total de Impostos: </b>
	      		</div>
	      		<div class='col-xs-3'>
	      			<span class='totalImpostos'>R$ 0,00</span> 
	      		</div>
	      	</div>

	    </div>

	    <div class='col-xs-9'>
			
		</div>

		<div class='col-xs-3'>
			<label>&nbsp;</label>
			<button type="button" onclick='finalizarVenda()' class="btn btn-block btn-success finalizarVenda" disabled="disabled">Finalizar venda &nbsp;&nbsp;&nbsp;<i class='fa fa-long-arrow-right'></i></button>
		</div>

	</div>
</div>