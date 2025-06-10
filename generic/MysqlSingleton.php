<?php
namespace generic;

use PDO;

class MysqlSingleton{
    private static  $instance = null;

    private $conn;
    private $dsn = 'mysql:host=localhost;dbname=banco_sonhos';
    private $usuario = 'root';
    private $senha = '';

    private function __construct(){
        try {
            $this->conn = new PDO($this->dsn,$this->usuario,$this->senha, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        } catch (\PDOException $e) {
            throw new \Exception("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new MysqlSingleton();
        }

        return self::$instance;
    }

    public function executar($query,$param = array()){
        try {
            $stmt = $this->conn->prepare($query);
            foreach($param as $k => $v){
                $stmt->bindValue($k,$v);
            }
            
            $stmt->execute();
            
            if (stripos($query, 'SELECT') === 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            // Tratamento específico para erros de SQL
            if ($e->getCode() == 23000) {
                throw new \Exception("Erro de integridade: " . $e->getMessage());
            } else if ($e->getCode() == 42) {
                throw new \Exception("Erro na estrutura do banco: " . $e->getMessage());
            } else {
                throw new \Exception("Erro ao executar operacao no banco: " . $e->getMessage());
            }
        } catch (\Exception $e) {
            throw new \Exception("Erro inesperado: " . $e->getMessage());
        }
    }
}