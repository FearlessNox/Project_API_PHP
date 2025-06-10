<?php
namespace controller;

use generic\AuthController;
use service\SonhoService;

class Sonho extends AuthController {
    private $service;

    public function __construct() {
        parent::__construct();
        $this->service = new SonhoService();
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
                    "erro" => "Sonho nao encontrado",
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
            if (!isset($dados->conteudo)) {
                $this->retornar([
                    "erro" => "Conteudo do sonho e obrigatorio",
                    "dado" => null
                ], 400);
                return;
            }
            $retorno = $this->service->inserir($dados->conteudo);
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
            if (!isset($dados->conteudo)) {
                $this->retornar([
                    "erro" => "Conteudo do sonho e obrigatorio",
                    "dado" => null
                ], 400);
                return;
            }
            $retorno = $this->service->alterar($id, $dados->conteudo);
            if (!$retorno) {
                $this->retornar([
                    "erro" => "Sonho nao encontrado",
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
                    "erro" => "Sonho nao encontrado",
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

    public function listarTags($id) {
        try {
            // Primeiro verifica se o sonho existe
            $sonho = $this->service->listarId($id);
            if (!$sonho) {
                $this->retornar([
                    "erro" => "Sonho nao encontrado",
                    "dado" => null
                ], 404);
                return;
            }
            
            $retorno = $this->service->listarTags($id);
            $this->retornar($retorno);
        } catch (\Exception $e) {
            $this->retornar([
                "erro" => $e->getMessage(),
                "dado" => null
            ], 500);
        }
    }

    public function listarInterpretacoes($id) {
        try {
            // Primeiro verifica se o sonho existe
            $sonho = $this->service->listarId($id);
            if (!$sonho) {
                $this->retornar([
                    "erro" => "Sonho nao encontrado",
                    "dado" => null
                ], 404);
                return;
            }
            
            $retorno = $this->service->listarInterpretacoes($id);
            $this->retornar($retorno);
        } catch (\Exception $e) {
            $this->retornar([
                "erro" => $e->getMessage(),
                "dado" => null
            ], 500);
        }
    }

    public function adicionarTag($id) {
        try {
            $dados = $this->getDados();
            if (!isset($dados->tag_id)) {
                $this->retornar([
                    "erro" => "ID da tag e obrigatorio",
                    "dado" => null
                ], 400);
                return;
            }
            $retorno = $this->service->adicionarTag($id, $dados->tag_id);
            if (!$retorno) {
                $this->retornar([
                    "erro" => "Sonho nao encontrado",
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

    public function removerTag($id) {
        try {
            $dados = $this->getDados();
            if (!isset($dados->tag_id)) {
                $this->retornar([
                    "erro" => "ID da tag e obrigatorio",
                    "dado" => null
                ], 400);
                return;
            }
            $retorno = $this->service->removerTag($id, $dados->tag_id);
            if (!$retorno) {
                $this->retornar([
                    "erro" => "Sonho nao encontrado",
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