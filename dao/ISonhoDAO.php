<?php
namespace dao;

interface ISonhoDAO {
    public function listar();
    public function listarId($id);
    public function inserir($conteudo);
    public function alterar($id, $conteudo);
    public function excluir($id);
    public function adicionarTag($sonho_id, $tag_id);
    public function removerTag($sonho_id, $tag_id);
    public function listarTags($sonho_id);
} 