<?php
namespace dao\mysql;

use dao\ISonhoDAO;
use generic\MysqlFactory;

class SonhoDAO extends MysqlFactory implements ISonhoDAO {
    
    public function listar() {
        try {
            $sql = "SELECT id, conteudo, criado_em FROM sonhos ORDER BY criado_em DESC";
            $resultado = $this->banco->executar($sql);
            return empty($resultado) ? [] : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar sonhos no banco de dados");
        }
    }

    public function listarId($id) {
        try {
            $sql = "SELECT id, conteudo, criado_em FROM sonhos WHERE id = :id";
            $param = [":id" => $id];
            $resultado = $this->banco->executar($sql, $param);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar sonho no banco de dados");
        }
    }

    public function inserir($conteudo) {
        try {
            $sql = "INSERT INTO sonhos (conteudo) VALUES (:conteudo)";
            $param = [":conteudo" => $conteudo];
            $resultado = $this->banco->executar($sql, $param);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir sonho no banco de dados");
        }
    }

    public function alterar($id, $conteudo) {
        try {
            $sql = "UPDATE sonhos SET conteudo = :conteudo WHERE id = :id";
            $param = [
                ":id" => $id,
                ":conteudo" => $conteudo
            ];
            $resultado = $this->banco->executar($sql, $param);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao alterar sonho no banco de dados");
        }
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM sonhos WHERE id = :id";
            $param = [":id" => $id];
            $resultado = $this->banco->executar($sql, $param);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir sonho no banco de dados");
        }
    }

    public function adicionarTag($sonho_id, $tag_id) {
        try {
            $sql = "INSERT INTO sonho_tag (sonho_id, tag_id) VALUES (:sonho_id, :tag_id)";
            $param = [
                ":sonho_id" => $sonho_id,
                ":tag_id" => $tag_id
            ];
            $resultado = $this->banco->executar($sql, $param);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao adicionar tag no banco de dados");
        }
    }

    public function removerTag($sonho_id, $tag_id) {
        try {
            $sql = "DELETE FROM sonho_tag WHERE sonho_id = :sonho_id AND tag_id = :tag_id";
            $param = [
                ":sonho_id" => $sonho_id,
                ":tag_id" => $tag_id
            ];
            $resultado = $this->banco->executar($sql, $param);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao remover tag no banco de dados");
        }
    }

    public function listarTags($sonho_id) {
        try {
            $sql = "SELECT t.id, t.nome 
                    FROM tags t 
                    INNER JOIN sonho_tag st ON t.id = st.tag_id 
                    WHERE st.sonho_id = :sonho_id";
            $param = [":sonho_id" => $sonho_id];
            $resultado = $this->banco->executar($sql, $param);
            return empty($resultado) ? [] : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar tags no banco de dados");
        }
    }

    public function listarInterpretacoes($sonho_id) {
        try {
            $sql = "SELECT id, sonho_id, interpretador, texto, criado_em 
                    FROM interpretacoes 
                    WHERE sonho_id = :sonho_id 
                    ORDER BY criado_em DESC";
            $param = [":sonho_id" => $sonho_id];
            $resultado = $this->banco->executar($sql, $param);
            return empty($resultado) ? [] : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar interpretacoes no banco de dados");
        }
    }
} 