<?php
namespace controller;

use generic\AuthController;
use service\TagService;

class Tag extends AuthController {
    private $service;

    public function __construct() {
        parent::__construct();
        $this->service = new TagService();
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
                    "erro" => "Tag nao encontrada",
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

    public function inserir() {
        try {
            $dados = $this->getDados();
            if (!isset($dados->nome)) {
                $this->retornar([
                    "erro" => "Nome da tag e obrigatorio",
                    "dado" => null
                ], 400);
                return;
            }
            $retorno = $this->service->inserir($dados->nome);
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
            if (!isset($dados->nome)) {
                $this->retornar([
                    "erro" => "Nome da tag e obrigatorio",
                    "dado" => null
                ], 400);
                return;
            }
            $retorno = $this->service->alterar($id, $dados->nome);
            if (!$retorno) {
                $this->retornar([
                    "erro" => "Tag nao encontrada",
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
                    "erro" => "Tag nao encontrada",
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