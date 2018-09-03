<?php

$funcao = $_POST['funcao'];

switch ($funcao) {

    case "getTodasVendas":
        getTodasVendas();
        break;
    case "excluir":
        excluir();
        break;

}

function getTodasVendas(){

	
    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();
    $result = $conexao->Executar("select * from venda order by datahora desc");

    $data = array();
    while ($row = pg_fetch_array($result)) {


        $id = $row['id'];
        $valor_total = 'R$ '.number_format( $row['valor_total'], 2, ',', '.');
        $valor_imposto = 'R$ '.number_format( $row['valor_impostos'], 2, ',', '.');

        $data_hora = $row[datahora];

        $opcoes = "<i class='fa fa-print btnImprimir' style='font-size: 20px; cursor: pointer' codigo=" . $row['id'] . " onclick=\"imprimir($(this).attr('codigo'))\"></i>
        	<i class='fa fa-times btnExcluir' style='font-size: 24px; color: red; cursor: pointer' codigo=" . $row['id'] . " onclick=\"excluir($(this).attr('codigo'))\"/>";

        $data['data'][] = array($id, $valor_total, $valor_imposto, $data_hora, $opcoes);
    }
    echo json_encode($data);

}

function excluir(){

    $codigo = $_POST['codigo'];

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    try {
        $sql = "delete from produtos_venda where id_venda = " . $codigo;
        $conexao->Executar($sql);

        $sql = "delete from venda where id = " . $codigo;
        $conexao->Executar($sql);

        echo 'OK';
    } catch (Exception $e) {
        
        echo $e->getMessage();
    }

    $conexao->Liberar();
    $conexao->Fechar();
}