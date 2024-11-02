<?php
require_once 'pgconnect.php';

class Pergunta {
    private $connection;

    public function __construct() {
        $db = new pgconnect();
        $this->connection = $db->getConnection();
    }

    public function obterPerguntas() {
        $query = "SELECT id, texto FROM perguntas WHERE status = TRUE";
        $result = pg_query($this->connection, $query);

        $perguntas = [];
        if ($result) {
            while ($row = pg_fetch_assoc($result)) {
                $perguntas[] = $row;
            }
        }
        return $perguntas;
    }    

    public function cadastrarPergunta($texto, $status = true) {
        if (!$this->connection) {
            return false;
        }
        $query = "INSERT INTO perguntas (texto, status) VALUES ($1, $2)";
        $params = array($texto, $status);
        $result = pg_query_params($this->connection, $query, $params);
        return $result ? "Pergunta cadastrada com sucesso!" : "Erro ao cadastrar pergunta.";
    }    
    
    public function removerPergunta($id) {
        $query = "DELETE FROM perguntas WHERE id = $1";
        $params = array($id);
        $result = pg_query_params($this->connection, $query, $params);
        return $result ? "Pergunta removida com sucesso!" : "Erro ao remover pergunta.";
    }
}
?>