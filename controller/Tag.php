<?php
namespace controller;

use generic\Controller;
use service\TagService;

class Tag extends Controller {
    private $service;

    public function __construct() {
        $this->service = new TagService();
    }

    public function listar() {
        $retorno = $this->service->listar();
        $this->retornar($retorno);
    }

    public function listarId($id) {
        $retorno = $this->service->listarId($id);
        $this->retornar($retorno);
    }

    public function inserir() {
        $dados = $this->getDados();
        if (!isset($dados->nome)) {
            $this->retornar(["erro" => "Nome da tag é obrigatório"], 400);
            return;
        }
        $retorno = $this->service->inserir($dados->nome);
        $this->retornar($retorno);
    }

    public function alterar($id) {
        $dados = $this->getDados();
        if (!isset($dados->nome)) {
            $this->retornar(["erro" => "Nome da tag é obrigatório"], 400);
            return;
        }
        $retorno = $this->service->alterar($id, $dados->nome);
        $this->retornar($retorno);
    }

    public function excluir($id) {
        $retorno = $this->service->excluir($id);
        $this->retornar($retorno);
    }
} 