<?php
namespace dao;

interface IUsuarioDAO {
    public function buscarPorEmail($email);
    public function criar($nome, $email, $senha);
} 