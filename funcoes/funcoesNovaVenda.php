<?php

$funcao = $_POST['funcao'];

switch ($funcao) {

    case "getTodosProdutos":
        getTodosProdutos();
        break;
    case "getInfoProduto":
    	getInfoProduto();
    	break;
    case "finalizarVenda":
        finalizarVenda();
        break;
}

function getTodosProdutos() {

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();
    $conexao->Executar("select p.*, tp.descricao as descricaotipo from produtos p inner join tipos_produtos tp on tp.id = p.tipo_produto order by tp.descricao");
    $result = $conexao->MontarResultados();
    $conexao->Liberar();
    $conexao->Fechar();
    $json = json_encode($result);

    echo $json;

}

function getInfoProduto(){

	include 'conexao.php';
	$conexao = new Conexao();
	$conexao->Conexao();
	$conexao->Executar("select p.*, tp.descricao as descricaotipo, tp.percentual_imposto from produtos p inner join tipos_produtos tp on tp.id = p.tipo_produto where p.id = ".$_POST[idProduto]." order by tp.descricao");
	$result = $conexao->MontarResultados();
    $conexao->Liberar();
    $conexao->Fechar();
    $json = json_encode($result);

    echo $json;

}

function finalizarVenda(){

    $arrayCodigo = $_POST['arrayCodigo'];
    $arrayQuantidade = $_POST['arrayQuantidade'];
    $arrayDescricao = $_POST['arrayDescricao'];
    $arrayValorUnitario = $_POST['arrayValorUnitario'];
    $arrayValorTotal = $_POST['arrayValorTotal'];
    $arrayImpostos = $_POST['arrayImpostos'];
    $valorTotalVenda = $_POST['valorTotalVenda'];
    $valorTotalImpostos = $_POST['valorTotalImpostos'];

    $valorTotalVenda = str_replace("R$ ", "", $valorTotalVenda);
    $valorTotalVenda = str_replace(".", "", $valorTotalVenda);
    $valorTotalVenda = str_replace(",", ".", $valorTotalVenda);

    $valorTotalImpostos = str_replace("R$ ", "", $valorTotalImpostos);
    $valorTotalImpostos = str_replace(".", "", $valorTotalImpostos);
    $valorTotalImpostos = str_replace(",", ".", $valorTotalImpostos);

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    try {

        $dataHora = date("Y-m-d H:i:s");


        $sql = "insert into venda(valor_total, valor_impostos, datahora) values('" . $valorTotalVenda . "', '". $valorTotalImpostos ."', '".$dataHora."')";
        $conexao->Executar($sql);

        foreach($arrayCodigo as $key => $item){

            $codigo = $arrayCodigo[$key];
            $quantidade = $arrayQuantidade[$key];
            $descricao = $arrayDescricao[$key];

            $valor_unitario = $arrayValorUnitario[$key];
            $valor_unitario = str_replace("R$ ", "", $valor_unitario);
            $valor_unitario = str_replace(".", "", $valor_unitario);
            $valor_unitario = str_replace(",", ".", $valor_unitario);

            $valor_total = $arrayValorTotal[$key];
            $valor_total = str_replace("R$ ", "", $valor_total);
            $valor_total = str_replace(".", "", $valor_total);
            $valor_total = str_replace(",", ".", $valor_total);

            $valor_impostos = $arrayImpostos[$key];
            $valor_impostos = str_replace("R$ ", "", $valor_impostos);
            $valor_impostos = str_replace(".", "", $valor_impostos);
            $valor_impostos = str_replace(",", ".", $valor_impostos);

            $conexao->Executar("select MAX(id) as maximo from venda");
            $result = $conexao->MontarResultados();
            $id_venda = $result[0][maximo];

            $sql = "insert into produtos_venda(codigo, quantidade, descricao, valor_unitario, valor_total, valor_impostos, id_venda) values('" . $codigo . "', '". $quantidade ."', '". $descricao ."', '". $valor_unitario ."', '". $valor_total ."', '". $valor_impostos ."', '". $id_venda ."')";
            $conexao->Executar($sql);

        }

        echo 'OK';
    } catch (Exception $e) {
        echo $e;
    }

    $conexao->Liberar();
    $conexao->Fechar();

}
?>