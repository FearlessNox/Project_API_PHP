<?php
namespace Firebase\JWT;

class JWT {
    public static function encode($payload, $key, $alg = 'HS256') {
        $header = [
            'typ' => 'JWT',
            'alg' => $alg
        ];

        $headerEncoded = self::base64UrlEncode(json_encode($header));
        $payloadEncoded = self::base64UrlEncode(json_encode($payload));
        
        $signature = hash_hmac('sha256', 
            $headerEncoded . "." . $payloadEncoded, 
            $key, 
            true
        );
        $signatureEncoded = self::base64UrlEncode($signature);

        return $headerEncoded . "." . $payloadEncoded . "." . $signatureEncoded;
    }

    public static function decode($jwt, $key, $alg = 'HS256') {
        $tokens = explode('.', $jwt);
        if (count($tokens) != 3) {
            throw new \Exception('Invalid token format');
        }

        list($headerEncoded, $payloadEncoded, $signatureEncoded) = $tokens;

        $signature = self::base64UrlDecode($signatureEncoded);
        $expectedSignature = hash_hmac('sha256', 
            $headerEncoded . "." . $payloadEncoded, 
            $key, 
            true
        );

        if (!hash_equals($signature, $expectedSignature)) {
            throw new \Exception('Invalid signature');
        }

        return json_decode(self::base64UrlDecode($payloadEncoded), true);
    }

    private static function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode($data) {
        return base64_decode(strtr($data, '-_', '+/'));
    }
} 