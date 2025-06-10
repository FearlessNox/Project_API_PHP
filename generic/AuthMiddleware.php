<?php

namespace generic;

use service\JWTService;

class AuthMiddleware {
    public static function validateToken() {
        $token = JWTService::getTokenFromHeader();
        
        if (!$token) {
            http_response_code(401);
            echo json_encode(['error' => 'Token não fornecido']);
            exit;
        }

        $decoded = JWTService::validateToken($token);
        
        if (!$decoded) {
            http_response_code(401);
            echo json_encode(['error' => 'Token inválido ou expirado']);
            exit;
        }

        return $decoded;
    }
} 