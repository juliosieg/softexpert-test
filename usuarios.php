<!-- Funções da página -->
<script src="js/usuarios.js"></script>

<section class="content-header">

    <h1>
        Usuários
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tag"></i>SoftExpert Test</a></li>
        <li class="active">Usuários</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3>Inserção de Usuários</h3>
                </div>
                <div class='box-body'>
                    <div class='col-xs-4'>
                        <label for="nome">Nome</label>
                        <input type='text' class='form-control' name='nome' id='nome'>
                    </div>
                    <div class='col-xs-3'>
                        <label for="email">E-mail</label>
                        <input type='email' class='form-control' name='email' id='email'>
                    </div>
                    <div class='col-xs-3'>
                        <label for="senha">Senha</label>
                        <input type='password' class='form-control' name='senha' id='senha'>
                    </div>
                    <div class='col-xs-2'>
                        <label>&nbsp;</label>
                        <button type="button" onclick='adicionarUsuario()' class="btn btn-block btn-success">Adicionar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                	<h3>Listagem de Usuários</h3><br/>
                    <table id="tableUsuarios" class="table table-bordered table-striped display responsive nowrap">
                        <thead>
                            <tr>
                                <th width='10%'>ID</th>
                                <th width='40%'>Nome</th>
                                <th width='30%'>Email</th>
                                <th width='20%'>Opções</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>