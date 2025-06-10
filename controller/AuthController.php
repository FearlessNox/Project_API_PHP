<?php
require_once 'service/AuthService.php';

class AuthController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login() {
        try {
            $dados = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($dados['email']) || !isset($dados['senha'])) {
                throw new Exception("Email e senha são obrigatórios");
            }

            $resultado = $this->authService->login($dados['email'], $dados['senha']);
            
            http_response_code(200);
            echo json_encode($resultado);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['erro' => $e->getMessage()]);
        }
    }
} 