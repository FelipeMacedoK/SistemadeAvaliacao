<?php
require_once 'pgconnect.php'; // Use o arquivo pgconnect.php para a conexão

header('Content-Type: application/json');

$query = "SELECT id, pergunta FROM perguntas WHERE status = true"; // Assume que o status verdadeiro indica perguntas ativas
$result = pg_query($conn, $query);

$perguntas = array();

if ($result) {
    while ($row = pg_fetch_assoc($result)) {
        $perguntas[] = $row;
    }
}

echo json_encode($perguntas);
pg_close($conn);
?>