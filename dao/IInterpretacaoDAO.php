<?php
namespace dao;

interface IInterpretacaoDAO {
    public function listar();
    public function listarPorSonho($sonho_id);
    public function listarId($id);
    public function inserir($sonho_id, $interpretador, $texto);
    public function alterar($id, $interpretador, $texto);
    public function excluir($id);
} 