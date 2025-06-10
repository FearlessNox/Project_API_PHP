<?php

namespace service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTService {
    private static $secretKey = "sua_chave_secreta"; // Change this to a secure secret key
    private static $algorithm = 'HS256';
    private static $tokenExpiration = 3600; // 1 hour in seconds

    public static function generateToken($userId, $email) {
        $issuedAt = time();
        $expirationTime = $issuedAt + self::$tokenExpiration;

        $payload = [
            'iss' => "localhost",           // Emissor do token
            'aud' => "localhost",           // Destinatário
            'iat' => $issuedAt,             // Data de emissão
            'exp' => $expirationTime,       // Expiração (1 hora)
            'user_id' => $userId,           // ID do usuário
            'email' => $email               // Email do usuário
        ];

        return JWT::encode($payload, self::$secretKey, self::$algorithm);
    }

    public static function validateToken($token) {
        try {
            $decoded = JWT::decode($token, new Key(self::$secretKey, self::$algorithm));
            return (array) $decoded;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getTokenFromHeader() {
        $headers = getallheaders();
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
} 