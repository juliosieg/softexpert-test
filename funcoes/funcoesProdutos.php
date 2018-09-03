<?php

$funcao = $_POST['funcao'];

switch ($funcao) {

    case "getTodos":
        getTodos();
        break;
    case "getTiposProdutos":
    	getTiposProdutos();
    	break;
    case "inserir":
        inserir();
        break;
    case "excluir":
        excluir();
        break;
    case "pesquisaCodigo":
        pesquisaCodigo();
        break;
    case "salvarAlteracoes":
        salvarAlteracoes();
        break;
}

function inserir(){

    $descricao = $_POST['descricao'];
    $valorVenda = str_replace(",","",$_POST['valor_venda']);
    $tipoProduto = $_POST['tipo_produto'];

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    try {
        $sql = "insert into produtos (descricao, valor_venda, tipo_produto) values('" . $descricao . "', '". $valorVenda ."', '". $tipoProduto ."')";
        $conexao->Executar($sql);
        echo 'OK';
    } catch (Exception $e) {
        echo $e;
    }

    $conexao->Liberar();
    $conexao->Fechar();

}

function getTiposProdutos(){

	include 'conexao.php';

    $conexao = new Conexao(); // Abre conexao
    $conexao->Conexao();
    $sql = "select * from tipos_produtos order by descricao";
    $conexao->Executar($sql);
    $result = $conexao->MontarResultados();
    $conexao->Liberar();
    $conexao->Fechar();
    $json = json_encode($result);

    echo $json;

}

function getTodos() {

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();
    $result = $conexao->Executar("select p.*, tp.descricao as descricaotipo from produtos p inner join tipos_produtos tp on tp.id = p.tipo_produto order by p.id");

    $data = array();

    while ($row = pg_fetch_array($result)) {
        $id = $row['id'];
        $descricao = $row['descricao'];
        $valor_venda = 'R$ '.number_format( $row['valor_venda'], 2, ',', '.');
        $descricao_tipo = $row['descricaotipo'];
        $opcoes = "<input class=btnAlterar type=\"image\" src=\"images/edit.png\" width=\"18px\" height=\"18px\" codigo=" . $row['id'] . " onclick=\"alterar($(this).attr('codigo'))\"/>
        <input class=btnExcluir type=\"image\" src=\"images/delete.png\" width=\"18px\" height=\"18px\" codigo=" . $row['id'] . " produto='" . $row['descricao'] . "' onclick=\"excluir($(this).attr('codigo'), $(this).attr('produto'))\"/> ";
        $data['data'][] = array($id, $descricao, $valor_venda, $descricao_tipo, $opcoes);
    }
    echo json_encode($data);
}

function excluir(){

    $codigo = $_POST['codigo'];

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    try {
        $sql = "delete from produtos where id = " . $codigo;
        $conexao->Executar($sql);

        echo 'OK';
    } catch (Exception $e) {
        
        echo $e->getMessage();
    }

    $conexao->Liberar();
    $conexao->Fechar();
}

function pesquisaCodigo() {

    $codigo = $_POST['codigo'];

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();
    $sql = "select * from tipos_produtos where id = " . $codigo;
    $conexao->Executar($sql);
    $result = $conexao->MontarResultados();
    $conexao->Liberar();
    $conexao->Fechar();
    $json = json_encode($result);

    echo $json;
}

function salvarAlteracoes() {

    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $percentual = $_POST['percentual'];

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    try {
        $sql = "update tipos_produtos set descricao = '" . $descricao . "', percentual_imposto = '". $percentual ."' where id = " . $codigo;
        $conexao->Executar($sql);

        echo 'OK';
    } catch (Exception $e) {
        
        echo $e->getMessage();
    }

    $conexao->Liberar();
    $conexao->Fechar();
}


?>