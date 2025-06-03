<?php
namespace service;

use dao\mysql\InterpretacaoDAO;

class InterpretacaoService {
    private $dao;

    public function __construct() {
        $this->dao = new InterpretacaoDAO();
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function listarId($id) {
        return $this->dao->listarId($id);
    }

    public function listarPorSonho($sonho_id) {
        return $this->dao->listarPorSonho($sonho_id);
    }

    public function inserir($sonho_id, $interpretador, $texto) {
        if (empty($interpretador)) {
            throw new \Exception("Nome do interpretador não pode ser vazio");
        }
        if (empty($texto)) {
            throw new \Exception("Texto da interpretação não pode ser vazio");
        }
        return $this->dao->inserir($sonho_id, $interpretador, $texto);
    }

    public function alterar($id, $interpretador, $texto) {
        if (empty($interpretador)) {
            throw new \Exception("Nome do interpretador não pode ser vazio");
        }
        if (empty($texto)) {
            throw new \Exception("Texto da interpretação não pode ser vazio");
        }
        return $this->dao->alterar($id, $interpretador, $texto);
    }

    public function excluir($id) {
        return $this->dao->excluir($id);
    }
} 