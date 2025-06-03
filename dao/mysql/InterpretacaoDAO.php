<?php
namespace dao\mysql;

use dao\IInterpretacaoDAO;
use generic\MysqlFactory;

class InterpretacaoDAO extends MysqlFactory implements IInterpretacaoDAO {
    
    public function listar() {
        $sql = "SELECT i.id, i.sonho_id, i.interpretador, i.texto, i.criado_em, s.conteudo as sonho_conteudo 
                FROM interpretacoes i 
                INNER JOIN sonhos s ON i.sonho_id = s.id 
                ORDER BY i.criado_em DESC";
        return $this->banco->executar($sql);
    }

    public function listarPorSonho($sonho_id) {
        $sql = "SELECT id, sonho_id, interpretador, texto, criado_em 
                FROM interpretacoes 
                WHERE sonho_id = :sonho_id 
                ORDER BY criado_em DESC";
        $param = [":sonho_id" => $sonho_id];
        return $this->banco->executar($sql, $param);
    }

    public function listarId($id) {
        $sql = "SELECT i.id, i.sonho_id, i.interpretador, i.texto, i.criado_em, s.conteudo as sonho_conteudo 
                FROM interpretacoes i 
                INNER JOIN sonhos s ON i.sonho_id = s.id 
                WHERE i.id = :id";
        $param = [":id" => $id];
        return $this->banco->executar($sql, $param);
    }

    public function inserir($sonho_id, $interpretador, $texto) {
        $sql = "INSERT INTO interpretacoes (sonho_id, interpretador, texto) 
                VALUES (:sonho_id, :interpretador, :texto)";
        $param = [
            ":sonho_id" => $sonho_id,
            ":interpretador" => $interpretador,
            ":texto" => $texto
        ];
        return $this->banco->executar($sql, $param);
    }

    public function alterar($id, $interpretador, $texto) {
        $sql = "UPDATE interpretacoes 
                SET interpretador = :interpretador, texto = :texto 
                WHERE id = :id";
        $param = [
            ":id" => $id,
            ":interpretador" => $interpretador,
            ":texto" => $texto
        ];
        return $this->banco->executar($sql, $param);
    }

    public function excluir($id) {
        $sql = "DELETE FROM interpretacoes WHERE id = :id";
        $param = [":id" => $id];
        return $this->banco->executar($sql, $param);
    }
} 