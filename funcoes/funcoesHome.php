<?php

$funcao = $_POST['funcao'];

switch ($funcao) {

    case "getTotalVendas":
        getTotalVendas();
    break;

    case "getImpostometro":
    	getImpostometro();
   	break;

   	case "getTotaisGraficos":
   		getTotaisGraficos();
   	break;

}

function getTotaisGraficos(){

	include 'conexao.php';

    $conexao = new Conexao(); // Abre conexao
    $conexao->Conexao();
    $sql = "select sum(valor_total) as somaTotal, sum(valor_impostos) as somaImpostos from venda";
    $conexao->Executar($sql);
    $result = $conexao->MontarResultados();
    $conexao->Liberar();
    $conexao->Fechar();
    $json = json_encode($result);

    echo $json;


}

function getTotalVendas(){

	include 'conexao.php';

    $conexao = new Conexao(); // Abre conexao
    $conexao->Conexao();
    $sql = "select sum(valor_total) as somaTotal from venda";
    $conexao->Executar($sql);
    $result = $conexao->MontarResultados();
    $conexao->Liberar();
    $conexao->Fechar();
    $json = json_encode($result);

    echo $json;

}

function getImpostometro(){

	include 'conexao.php';

    $conexao = new Conexao(); // Abre conexao
    $conexao->Conexao();
    $sql = "select sum(valor_impostos) as somaImpostos from venda";
    $conexao->Executar($sql);
    $result = $conexao->MontarResultados();
    $conexao->Liberar();
    $conexao->Fechar();
    $json = json_encode($result);

    echo $json;

}
?>