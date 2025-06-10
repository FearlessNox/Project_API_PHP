<?php
namespace service;

use dao\mysql\SonhoDAO;

class SonhoService {
    private $dao;

    public function __construct() {
        $this->dao = new SonhoDAO();
    }

    public function listar() {
        try {
            return $this->dao->listar();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar sonhos: " . $e->getMessage());
        }
    }

    public function listarId($id) {
        try {
            $resultado = $this->dao->listarId($id);
            return $resultado ? $resultado[0] : null;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar sonho: " . $e->getMessage());
        }
    }

    public function inserir($conteudo) {
        try {
            if (empty($conteudo)) {
                throw new \Exception("Conteudo do sonho nao pode ser vazio");
            }
            return $this->dao->inserir($conteudo);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir sonho: " . $e->getMessage());
        }
    }

    public function alterar($id, $conteudo) {
        try {
            if (empty($conteudo)) {
                throw new \Exception("Conteudo do sonho nao pode ser vazio");
            }
            return $this->dao->alterar($id, $conteudo);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao alterar sonho: " . $e->getMessage());
        }
    }

    public function excluir($id) {
        try {
            return $this->dao->excluir($id);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir sonho: " . $e->getMessage());
        }
    }

    public function adicionarTag($sonho_id, $tag_id) {
        try {
            return $this->dao->adicionarTag($sonho_id, $tag_id);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao adicionar tag: " . $e->getMessage());
        }
    }

    public function removerTag($sonho_id, $tag_id) {
        try {
            return $this->dao->removerTag($sonho_id, $tag_id);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao remover tag: " . $e->getMessage());
        }
    }

    public function listarTags($sonho_id) {
        try {
            return $this->dao->listarTags($sonho_id);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar tags: " . $e->getMessage());
        }
    }
} 