<?php
$conexao = pg_connect("host=localhost dbname=seu_banco_de_dados user=seu_usuario password=sua_senha");
if (!$conexao) {
    die("Erro na conexão com o banco de dados.");
}
?>