<?php

$email = $_POST['email'];
$senha = $_POST['senha'];

include 'conexao.php';

if ($email != null && $email != "" && $senha != null && $senha != "") {

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $s = filter_var($senha, FILTER_SANITIZE_STRING);

    $senha = hash('whirlpool', $senha);

    $conexao = new Conexao();
    $conexao->Conexao();

    $sql = "SELECT u.email FROM usuarios u WHERE u.email = '$email'";

    $conexao->Executar($sql);
    $linhas = $conexao->ContarLinhas();


    if ($linhas <= 0) {
        $result[] = array("ret" => false, "msg" => "Usuário não cadastrado!");
        echo json_encode($result);

        $conexao->Fechar();
        exit(0);
    } else {
        $conexao2 = new Conexao();
        $conexao2->Conexao();

        $sql2 = "SELECT u.id FROM usuarios u WHERE u.email ='$email' AND u.senha ='$senha'";

        $conexao2->Executar($sql2);
        $linhas = $conexao2->ContarLinhas();

        // senha incorreta
        if ($linhas <= 0) {
            $result[] = array("ret" => false, "msg" => "Senha incorreta!");
            echo json_encode($result);

            $conexao2->Fechar();
            exit();
        }


        // ok, pode logar
        if ($linhas == 1) {

            $conexao3 = new Conexao();
            $conexao3->Conexao();

            $sql3 = "SELECT u.nome from usuarios u WHERE u.email ='" . $email . "'
                    ";

            $resultado = $conexao3->Executar($sql3);

            while ($row = pg_fetch_array($resultado)) {

                $nome = $row['nome'];
            }

            $sql4 = "SELECT u.nome FROM usuarios u WHERE u.email ='" . $email . "'
                    ";

            $resultado2 = $conexao3->Executar($sql4);


            session_start();
            $_SESSION['nomeLogado'] = $nome;
            $_SESSION['logado'] = TRUE;
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);

            $conexao2->Fechar();
            $conexao3->Fechar();

            $result[] = array("ret" => true, "msg" => "Bem vindo!");
            echo json_encode($result);
            exit(0);
        }
    }
} else {
    $conexao4 = new Conexao();
    $conexao4->Conexao();

    $result[] = array("ret" => false, "msg" => "Email e/ou senha nulos!");
    echo json_encode($result);
    
    $conexao4->Fechar();
}

