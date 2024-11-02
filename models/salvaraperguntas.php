<?php
require_once 'pgconnect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $avaliacao = $_POST['avaliacao'];
    $setor_id = $_POST['setor_id']; // Você pode precisar ajustar isso com base na estrutura do seu formulário

    $query = "INSERT INTO avaliacoes (pergunta_id, nota, setor_id) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, array($avaliacao['pergunta_id'], $avaliacao['nota'], $setor_id));

    if ($result) {
        echo json_encode(array('status' => 'success', 'message' => 'Avaliação salva com sucesso.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Erro ao salvar a avaliação.'));
    }
}

pg_close($conn);
?>