<?php

namespace generic;

use service\JWTService;

abstract class AuthController extends Controller {
    protected $usuario;

    public function __construct() {
        parent::__construct();
        $this->validarAutenticacao();
    }

    protected function validarAutenticacao() {
        $token = JWTService::getTokenFromHeader();
        
        if (!$token) {
            $this->retornar(['error' => 'Acesso nao autorizado. Token nao fornecido.'], 401);
            exit;
        }

        $decoded = JWTService::validateToken($token);
        
        if (!$decoded) {
            $this->retornar(['error' => 'Acesso nao autorizado. Token invalido ou expirado.'], 401);
            exit;
        }

        $this->usuario = $decoded;
    }

    protected function getUsuarioId() {
        return $this->usuario['sub'] ?? null;
    }

    protected function getUsuarioEmail() {
        return $this->usuario['email'] ?? null;
    }
} 