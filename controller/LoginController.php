<?php

namespace controller;

use service\AuthService;

class LoginController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['email']) || !isset($data['senha'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Email e senha são obrigatórios']);
            return;
        }

        try {
            $resultado = $this->authService->login($data['email'], $data['senha']);
            echo json_encode($resultado);
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function register() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['nome']) || !isset($data['email']) || !isset($data['senha'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Nome, email e senha são obrigatórios']);
            return;
        }

        try {
            $resultado = $this->authService->register($data['nome'], $data['email'], $data['senha']);
            echo json_encode($resultado);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
} 