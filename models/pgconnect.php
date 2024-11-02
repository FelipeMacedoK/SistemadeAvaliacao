<?php
class pgconnect {
    private $connection;

    public function __construct($host = 'localhost', $port = '5432', $dbname = 'SistemadeAvaliacao', $user = 'postgres', $password = 'postgres') {
        try {
            $this->connection = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
            if (!$this->connection) {
                throw new Exception("Erro ao conectar ao banco de dados.");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}