<?php
namespace dao\mysql;

use dao\IUsuarioDAO;
use generic\MysqlFactory;

class UsuarioDAO extends MysqlFactory implements IUsuarioDAO {
    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $param = [":email" => $email];
        $resultado = $this->banco->executar($sql, $param);
        return $resultado[0] ?? null;
    }

    public function criar($nome, $email, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $param = [
            ":nome" => $nome,
            ":email" => $email,
            ":senha" => $senhaHash
        ];
        return $this->banco->executar($sql, $param);
    }
} 