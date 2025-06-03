<?php
namespace controller;

use generic\Controller;
use service\InterpretacaoService;

class Interpretacao extends Controller {
    private $service;

    public function __construct() {
        $this->service = new InterpretacaoService();
    }

    public function listar() {
        $retorno = $this->service->listar();
        $this->retornar($retorno);
    }

    public function listarId($id) {
        $retorno = $this->service->listarId($id);
        $this->retornar($retorno);
    }

    public function listarPorSonho($sonho_id) {
        $retorno = $this->service->listarPorSonho($sonho_id);
        $this->retornar($retorno);
    }

    public function inserir() {
        $dados = $this->getDados();
        if (!isset($dados->sonho_id) || !isset($dados->interpretador) || !isset($dados->texto)) {
            $this->retornar(["erro" => "Todos os campos são obrigatórios"], 400);
            return;
        }
        $retorno = $this->service->inserir($dados->sonho_id, $dados->interpretador, $dados->texto);
        $this->retornar($retorno);
    }

    public function alterar($id) {
        $dados = $this->getDados();
        if (!isset($dados->interpretador) || !isset($dados->texto)) {
            $this->retornar(["erro" => "Interpretador e texto são obrigatórios"], 400);
            return;
        }
        $retorno = $this->service->alterar($id, $dados->interpretador, $dados->texto);
        $this->retornar($retorno);
    }

    public function excluir($id) {
        $retorno = $this->service->excluir($id);
        $this->retornar($retorno);
    }
} 