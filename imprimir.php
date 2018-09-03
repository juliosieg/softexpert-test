<?php

    include 'funcoes/conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    $result = $conexao->Executar("select * from venda where id = ".$_GET[cod]);

    $valorTotal = '';
    $valorTotalImpostos = '';

    while ($row = pg_fetch_array($result)) {

        $valorTotal = 'R$ ' . number_format($row['valor_total'], 2, ',', '.');
        $valorTotalImpostos = 'R$ ' . number_format($row['valor_impostos'], 2, ',', '.');
        $dataHora = explode(" ",$row['datahora']);
        $data = explode("-",$dataHora[0]);
        $dataHora = $data[2]."/".$data[1]."/".$data[0]." ".$dataHora[1];

    }

   $resultProdutos = $conexao->Executar("select * from produtos_venda where id_venda = ".$_GET[cod]);

?>

<!-- Funções da página -->
<script src="js/impressao.js"></script>

<section class="content-header">

    <h1>
        Vendas
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-tag"></i>SoftExpert Test</a></li>
        <li class="">Vendas</li>
        <li class="active">Impressão de Venda</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    
                    <div style='text-align: center'>

                        <h3>Ordem de Venda</h3>

                    </div>

                    <hr>

                    <div style='text-align: left; padding-left: 20px'>

                        <h4>Detalhes do Pedido</h4>
                        <br>
                        <h5><b>Código:</b> <?=$_GET[cod]?></h5>
                        <h5><b>Valor Total:</b> <?=$valorTotal?></h5>
                        <h5><b>Total de Impostos:</b> <?=$valorTotalImpostos?></h5>
                        <h5><b>Data/Hora:</b> <?=$dataHora?></h5>

                    </div>
                    
                    <hr>

                    <div style='text-align: left; padding-left: 20px'>

                        <h4>Produtos</h4>
                        <br>
                        
                        <table class="table table-bordered">
                            <tbody><tr>
                              <th style="width: 5%">Cód.</th>
                              <th style="width: 5%">Qtd.</th>
                              <th style="width: 30%">Descrição</th>
                              <th style="width: 20%">Valor Unitário</th>
                              <th style="width: 20%">Valor Total</th>
                              <th style="width: 20%">Impostos</th>
                            </tr>
                            
                              <?php

                                while ($row = pg_fetch_array($resultProdutos)) {

                              ?>
                                <tr>    
                                    <td><?php echo $row[codigo]?></td>
                                    <td><?php echo $row[quantidade]?></td>
                                    <td><?php echo $row[descricao]?></td>
                                    <td><?php echo 'R$ ' . number_format($row['valor_unitario'], 2, ',', '.')?></td>
                                    <td><?php echo 'R$ ' . number_format($row['valor_total'], 2, ',', '.')?></td>
                                    <td><?php echo 'R$ ' . number_format($row['valor_impostos'], 2, ',', '.')?></td>
                                    </tr>
                              <?php } ?>

                          </tbody></table>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>

    <div class='col-xs-2' style="text-align: center">
        <button type="button" onclick="imprimir()" class="btn btn-block btn-success">Imprimir</button>
        <br>
    </div>
</section>