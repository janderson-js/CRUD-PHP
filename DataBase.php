<?php

class DataBase{

    private static $instancia;
    private $conn;

    private $host = "localhost:3307";
    private $username = "root";
    private $password = "";
    private $database = "agenda";

    private function __construct()
    {
        try {
            // Criação da conexão PDO
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);

            // Configuração para lançar exceções em caso de erros
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        }
    }

    public function desconectar(){
        $this->conn = null;
    }

    public static function getInstance() {
        if (!self::$instancia) {
            self::$instancia = new DataBase();
        }
        return self::$instancia;
    }

    public function getConexao() {
        return $this->conn;
    }   
}