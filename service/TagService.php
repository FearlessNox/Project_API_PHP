<?php
namespace service;

use dao\mysql\TagDAO;

class TagService {
    private $dao;

    public function __construct() {
        $this->dao = new TagDAO();
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function listarId($id) {
        return $this->dao->listarId($id);
    }

    public function inserir($nome) {
        if (empty($nome)) {
            throw new \Exception("Nome da tag não pode ser vazio");
        }
        return $this->dao->inserir($nome);
    }

    public function alterar($id, $nome) {
        if (empty($nome)) {
            throw new \Exception("Nome da tag não pode ser vazio");
        }
        return $this->dao->alterar($id, $nome);
    }

    public function excluir($id) {
        return $this->dao->excluir($id);
    }
} 