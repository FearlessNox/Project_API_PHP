<?php
namespace controller;

use generic\Controller;
use service\SonhoService;

class Sonho extends Controller {
    private $service;

    public function __construct() {
        $this->service = new SonhoService();
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
        if (!isset($dados->conteudo)) {
            $this->retornar(["erro" => "Conteúdo do sonho é obrigatório"], 400);
            return;
        }
        $retorno = $this->service->inserir($dados->conteudo);
        $this->retornar($retorno);
    }

    public function alterar($id) {
        $dados = $this->getDados();
        if (!isset($dados->conteudo)) {
            $this->retornar(["erro" => "Conteúdo do sonho é obrigatório"], 400);
            return;
        }
        $retorno = $this->service->alterar($id, $dados->conteudo);
        $this->retornar($retorno);
    }

    public function excluir($id) {
        $retorno = $this->service->excluir($id);
        $this->retornar($retorno);
    }

    public function adicionarTag($sonho_id) {
        $dados = $this->getDados();
        if (!isset($dados->tag_id)) {
            $this->retornar(["erro" => "ID da tag é obrigatório"], 400);
            return;
        }
        $retorno = $this->service->adicionarTag($sonho_id, $dados->tag_id);
        $this->retornar($retorno);
    }

    public function removerTag($sonho_id) {
        $dados = $this->getDados();
        if (!isset($dados->tag_id)) {
            $this->retornar(["erro" => "ID da tag é obrigatório"], 400);
            return;
        }
        $retorno = $this->service->removerTag($sonho_id, $dados->tag_id);
        $this->retornar($retorno);
    }

    public function listarTags($sonho_id) {
        $retorno = $this->service->listarTags($sonho_id);
        $this->retornar($retorno);
    }
} 