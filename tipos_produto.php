<!-- Funções da página -->
<script src="js/tipos_produto.js"></script>

<section class="content-header">

    <h1>
        Tipos de Produtos
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tag"></i>SoftExpert Test</a></li>
        <li class="active">Tipos de Produtos</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form>
                        <h3>Inserção de Tipos de Produtos</h3>
                        <fieldset class="form-group">
                        	<div class='col-xs-8'>
                        		<label for="descricaoTipo">Descrição</label>
                            	<input type="text" class="form-control" id="descricaoTipo" placeholder="Descrição do Tipo">
                        	</div>
                        	<div class='col-xs-4'>
                        		<label for="percentualTipo">Percentual</label>
                            	<input type="text" class="form-control" id="percentualTipo" placeholder="Percentual de Imposto">
                        	</div>
                        </fieldset>
                        <div class='col-xs-12'>
                        	<input id="btnInserir" type="button" onclick="inserirNovoTipo()" class="btn btn-primary" value="Inserir"/>
                        </div>
                    </form>

                    <br>
                    <br>

                    <h3>Listagem de Tipos de Produtos</h3><br/>

                    <table id="tableTiposProdutos" class="table table-bordered table-striped display responsive nowrap">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="65%">Tipo de Produto</th>
                                <th width="15%">Percentual</th>
                                <th width="10%">Opções</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Modal Edição-->
<div id="modalEditarTipo" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Tipo de Produto</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="idEditarTipo">ID:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="idEditarTipo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="descricaoEditarTipo">Descrição:</label>
                        <div class="col-sm-10"> 
                            <input type="text" class="form-control" id="descricaoEditarTipo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="percentualEditarTipo">Percentual:</label>
                        <div class="col-sm-10"> 
                            <input type="text" class="form-control" id="percentualEditarTipo">
                        </div>
                    </div>
                </form>

                <div id="erroAlteracaoVazia" class="alert alert-danger fade in">
                    <a href="#" class="close alert-close">&times;</a>
                    <strong>Erro!</strong> Todos os campos são obrigatórios. Verifique se existe algum campo vazio e preencha-o.
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="salvarAlteracoes()">Salvar Alterações</button>
            </div>
        </div>
    </div>
</div>