<?php
namespace controller;

use generic\AuthController;
use service\InterpretacaoService;

class Interpretacao extends AuthController {
    private $service;

    public function __construct() {
        parent::__construct();
        $this->service = new InterpretacaoService();
    }

    public function listar() {
        try {
            $retorno = $this->service->listar();
            $this->retornar($retorno);
        } catch (\Exception $e) {
            $this->retornar([
                "erro" => $e->getMessage(),
                "dado" => null
            ], 500);
        }
    }

    public function listarId($id) {
        try {
            $retorno = $this->service->listarId($id);
            if (!$retorno) {
                $this->retornar([
                    "erro" => "Interpretacao nao encontrada",
                    "dado" => null
                ], 404);
                return;
            }
            $this->retornar($retorno);
        } catch (\Exception $e) {
            $this->retornar([
                "erro" => $e->getMessage(),
                "dado" => null
            ], 500);
        }
    }

    public function listarPorSonho($id) {
        $retorno = $this->service->listarPorSonho($id);
        $this->retornar($retorno);
    }

    public function inserir() {
        try {
            $dados = $this->getDados();
            if (!isset($dados->sonho_id) || !isset($dados->interpretador) || !isset($dados->texto)) {
                $this->retornar([
                    "erro" => "Sonho ID, interpretador e texto sao obrigatorios",
                    "dado" => null
                ], 400);
                return;
            }
            $retorno = $this->service->inserir($dados->sonho_id, $dados->interpretador, $dados->texto);
            $this->retornar($retorno);
        } catch (\Exception $e) {
            $this->retornar([
                "erro" => $e->getMessage(),
                "dado" => null
            ], 500);
        }
    }

    public function alterar($id) {
        try {
            $dados = $this->getDados();
            if (!isset($dados->interpretador) || !isset($dados->texto)) {
                $this->retornar([
                    "erro" => "Interpretador e texto sao obrigatorios",
                    "dado" => null
                ], 400);
                return;
            }
            $retorno = $this->service->alterar($id, $dados->interpretador, $dados->texto);
            if (!$retorno) {
                $this->retornar([
                    "erro" => "Interpretacao nao encontrada",
                    "dado" => null
                ], 404);
                return;
            }
            $this->retornar($retorno);
        } catch (\Exception $e) {
            $this->retornar([
                "erro" => $e->getMessage(),
                "dado" => null
            ], 500);
        }
    }

    public function excluir($id) {
        try {
            $retorno = $this->service->excluir($id);
            if (!$retorno) {
                $this->retornar([
                    "erro" => "Interpretacao nao encontrada",
                    "dado" => null
                ], 404);
                return;
            }
            $this->retornar($retorno);
        } catch (\Exception $e) {
            $this->retornar([
                "erro" => $e->getMessage(),
                "dado" => null
            ], 500);
        }
    }
} 