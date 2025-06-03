<?php
namespace dao\mysql;

use dao\ISonhoDAO;
use generic\MysqlFactory;

class SonhoDAO extends MysqlFactory implements ISonhoDAO {
    
    public function listar() {
        $sql = "SELECT id, conteudo, criado_em FROM sonhos ORDER BY criado_em DESC";
        return $this->banco->executar($sql);
    }

    public function listarId($id) {
        $sql = "SELECT id, conteudo, criado_em FROM sonhos WHERE id = :id";
        $param = [":id" => $id];
        return $this->banco->executar($sql, $param);
    }

    public function inserir($conteudo) {
        $sql = "INSERT INTO sonhos (conteudo) VALUES (:conteudo)";
        $param = [":conteudo" => $conteudo];
        return $this->banco->executar($sql, $param);
    }

    public function alterar($id, $conteudo) {
        $sql = "UPDATE sonhos SET conteudo = :conteudo WHERE id = :id";
        $param = [
            ":id" => $id,
            ":conteudo" => $conteudo
        ];
        return $this->banco->executar($sql, $param);
    }

    public function excluir($id) {
        $sql = "DELETE FROM sonhos WHERE id = :id";
        $param = [":id" => $id];
        return $this->banco->executar($sql, $param);
    }

    public function adicionarTag($sonho_id, $tag_id) {
        $sql = "INSERT INTO sonho_tag (sonho_id, tag_id) VALUES (:sonho_id, :tag_id)";
        $param = [
            ":sonho_id" => $sonho_id,
            ":tag_id" => $tag_id
        ];
        return $this->banco->executar($sql, $param);
    }

    public function removerTag($sonho_id, $tag_id) {
        $sql = "DELETE FROM sonho_tag WHERE sonho_id = :sonho_id AND tag_id = :tag_id";
        $param = [
            ":sonho_id" => $sonho_id,
            ":tag_id" => $tag_id
        ];
        return $this->banco->executar($sql, $param);
    }

    public function listarTags($sonho_id) {
        $sql = "SELECT t.id, t.nome 
                FROM tags t 
                INNER JOIN sonho_tag st ON t.id = st.tag_id 
                WHERE st.sonho_id = :sonho_id";
        $param = [":sonho_id" => $sonho_id];
        return $this->banco->executar($sql, $param);
    }
} 