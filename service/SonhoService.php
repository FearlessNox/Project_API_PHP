<?php
namespace service;

use dao\mysql\SonhoDAO;

class SonhoService {
    private $dao;

    public function __construct() {
        $this->dao = new SonhoDAO();
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function listarId($id) {
        $resultado = $this->dao->listarId($id);
        return $resultado ? $resultado[0] : null;
    }

    public function inserir($conteudo) {
        if (empty($conteudo)) {
            throw new \Exception("Conteudo do sonho nao pode ser vazio");
        }
        return $this->dao->inserir($conteudo);
    }

    public function alterar($id, $conteudo) {
        if (empty($conteudo)) {
            throw new \Exception("Conteudo do sonho nao pode ser vazio");
        }
        return $this->dao->alterar($id, $conteudo);
    }

    public function excluir($id) {
        return $this->dao->excluir($id);
    }

    public function adicionarTag($sonho_id, $tag_id) {
        return $this->dao->adicionarTag($sonho_id, $tag_id);
    }

    public function removerTag($sonho_id, $tag_id) {
        return $this->dao->removerTag($sonho_id, $tag_id);
    }

    public function listarTags($sonho_id) {
        return $this->dao->listarTags($sonho_id);
    }
} 