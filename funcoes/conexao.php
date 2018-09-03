<?php

class Conexao {

    var $user = "postgres";
    var $pass = "postgres";
    var $host = "localhost";
    var $port = "5432";
    var $dbname = "softexpert_test";
    var $link;
    var $result;

    function Conexao() {
        $this->link = pg_connect("host='$this->host' port='$this->port' dbname='$this->dbname' user='$this->user' password='$this->pass'") or die("Configuracao de Banco de Dados Errada!");
    }

    function Executar($sql) {
        $this->result = pg_exec($sql) or die("Erro ao executar query: ".pg_last_error());
        return $this->result;
    }

    function MontarResultados() {
        $resultArray = pg_fetch_all($this->result);
        return $resultArray;
    }

    function ContarLinhas() {
        $lines = pg_num_rows($this->result);
        return $lines;
    }

    function Fechar() {
        pg_close($this->link);
    }

    function Liberar() {
        pg_free_result($this->result);
    }

}

?>
