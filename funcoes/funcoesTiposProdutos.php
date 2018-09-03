<?php

$funcao = $_POST['funcao'];

switch ($funcao) {

    case "getTodos":
        getTodos();
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
    $percentual = $_POST['percentual_imposto'];

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    try {
        $sql = "insert into tipos_produtos (descricao, percentual_imposto) values('" . $descricao . "', '". $percentual ."')";
        $conexao->Executar($sql);
        echo 'OK';
    } catch (Exception $e) {
        echo $e;
    }

    $conexao->Liberar();
    $conexao->Fechar();

}

function getTodos() {

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();
    $result = $conexao->Executar("select * from tipos_produtos order by id");

    $data = array();
    while ($row = pg_fetch_array($result)) {
        $id = $row['id'];
        $descricao = $row['descricao'];
        $percentual_imposto = str_replace(".", ",", $row['percentual_imposto'])."%";
        $opcoes = "<input class=btnAlterar type=\"image\" src=\"images/edit.png\" width=\"18px\" height=\"18px\" codigo=" . $row['id'] . " onclick=\"alterar($(this).attr('codigo'))\"/>
        <input class=btnExcluir type=\"image\" src=\"images/delete.png\" width=\"18px\" height=\"18px\" codigo=" . $row['id'] . " tipo='" . $row['descricao'] . "' onclick=\"excluir($(this).attr('codigo'), $(this).attr('tipo'))\"/> ";
        $data['data'][] = array($id, $descricao, $percentual_imposto, $opcoes);
    }
    echo json_encode($data);
}

function excluir(){

    $codigo = $_POST['codigo'];

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    try {
        $sql = "delete from tipos_produtos where id = " . $codigo;
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