<?php
namespace service;

use dao\mysql\UsuarioDAO;
use \Firebase\JWT\JWT;

class AuthService {
    private $usuarioDAO;
    private $jwtService;
    private $chaveSecreta = "sua_chave_secreta_muito_segura"; // Em produção, use uma chave mais segura e armazene em variável de ambiente

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
        $this->jwtService = new JWTService();
    }

    public function login($email, $senha) {
        $usuario = $this->usuarioDAO->buscarPorEmail($email);
        
        if (!$usuario || !password_verify($senha, $usuario['senha'])) {
            throw new \Exception("Credenciais inválidas");
        }

        $token = $this->jwtService->generateToken($usuario['id'], $usuario['email']);
        return [
            'token' => $token,
            'user' => [
                'id' => $usuario['id'],
                'email' => $usuario['email']
            ]
        ];
    }

    public function register($nome, $email, $senha) {
        // Verifica se o email já está em uso
        $usuarioExistente = $this->usuarioDAO->buscarPorEmail($email);
        if ($usuarioExistente) {
            throw new \Exception("Email já está em uso");
        }

        // Cria o novo usuário
        $this->usuarioDAO->criar($nome, $email, $senha);

        // Busca o usuário recém-criado
        $usuario = $this->usuarioDAO->buscarPorEmail($email);
        
        // Gera o token de autenticação
        $token = $this->jwtService->generateToken($usuario['id'], $usuario['email']);
        
        return [
            'token' => $token,
            'user' => [
                'id' => $usuario['id'],
                'email' => $usuario['email']
            ]
        ];
    }

    public function validarToken($token) {
        try {
            $decoded = JWT::decode($token, $this->chaveSecreta, ['HS256']);
            return (array) $decoded;
        } catch (\Exception $e) {
            throw new \Exception("Token inválido");
        }
    }
} 