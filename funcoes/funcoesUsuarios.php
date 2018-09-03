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
    case "editarSenha":
        editarSenha();
        break;

}

function getTodos() {

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();
    $result = $conexao->Executar("select * from usuarios order by id");

    $data = array();
    while ($row = pg_fetch_array($result)) {
        $id = $row['id'];
        $nome = $row['nome'];
        $email = $row['email'];
        $opcoes = "<i class='fa fa-key' codigo=" . $row['id'] . " onclick=\"alterarSenha($(this).attr('codigo'))\" style=\"cursor:pointer;font-size:20px;\"></i>
        <input class=btnExcluir type=\"image\" src=\"images/delete.png\" width=\"18px\" height=\"18px\" codigo=" . $row['id'] . " onclick=\"excluir($(this).attr('codigo'))\"/> ";
        $data['data'][] = array($id, $nome, $email, $opcoes);
    }
    echo json_encode($data);
}

function inserir(){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    $senha = hash('whirlpool', $senha);

    try {
        $sql = "insert into usuarios (nome, email, senha) values('" . $nome . "', '". $email ."', '". $senha ."')";
        $conexao->Executar($sql);
        echo 'OK';
    } catch (Exception $e) {
        echo $e;
    }

    $conexao->Liberar();
    $conexao->Fechar();

}

function excluir(){

    $codigo = $_POST['codigo'];

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    try {
        $sql = "delete from usuarios where id = " . $codigo;
        $conexao->Executar($sql);

        echo 'OK';
    } catch (Exception $e) {
        
        echo $e->getMessage();
    }

    $conexao->Liberar();
    $conexao->Fechar();

}

function editarSenha(){

    $codigo = $_POST['codigo'];
    $novaSenha = $_POST['novaSenha'];

    $novaSenha = hash('whirlpool', $novaSenha);

    include 'conexao.php';

    $conexao = new Conexao();
    $conexao->Conexao();

    try {
        $sql = "update usuarios set senha = '".$novaSenha."' where id = " . $codigo;
        $conexao->Executar($sql);

        echo 'OK';
    } catch (Exception $e) {
        
        echo $e->getMessage();
    }

    $conexao->Liberar();
    $conexao->Fechar();
    
}
?>