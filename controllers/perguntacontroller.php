<?php
require_once '../models/pergunta.php';

$pergunta = new Pergunta();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao']) && $_GET['acao'] === 'listar') {
    header('Content-Type: application/json');
    echo json_encode($pergunta->obterPerguntas());
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'];

    if ($acao === 'cadastrar') {
        $texto = $_POST['texto'];
        $resultado = $pergunta->cadastrarPergunta($texto);
        echo $resultado;
    } elseif ($acao === 'remover') {
        $id = $_POST['id'];
        $resultado = $pergunta->removerPergunta($id);
        echo $resultado;
    }
}
?>