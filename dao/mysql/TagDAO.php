<?php
namespace dao\mysql;

use dao\ITagDAO;
use generic\MysqlFactory;

class TagDAO extends MysqlFactory implements ITagDAO {
    
    public function listar() {
        $sql = "SELECT id, nome FROM tags ORDER BY nome";
        return $this->banco->executar($sql);
    }

    public function listarId($id) {
        $sql = "SELECT id, nome FROM tags WHERE id = :id";
        $param = [":id" => $id];
        return $this->banco->executar($sql, $param);
    }

    public function inserir($nome) {
        $sql = "INSERT INTO tags (nome) VALUES (:nome)";
        $param = [":nome" => $nome];
        return $this->banco->executar($sql, $param);
    }

    public function alterar($id, $nome) {
        $sql = "UPDATE tags SET nome = :nome WHERE id = :id";
        $param = [
            ":id" => $id,
            ":nome" => $nome
        ];
        return $this->banco->executar($sql, $param);
    }

    public function excluir($id) {
        $sql = "DELETE FROM tags WHERE id = :id";
        $param = [":id" => $id];
        return $this->banco->executar($sql, $param);
    }
} 