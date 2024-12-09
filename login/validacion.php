<?php
function base64UrlEncode($data) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
}

function base64UrlDecode($data) {
    return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
}

function crearToken($payload, $secret) {
    $header = base64UrlEncode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
    $payload = base64UrlEncode(json_encode($payload));
    $signature = base64UrlEncode(hash_hmac('sha256', "$header.$payload", $secret, true));

    return "$header.$payload.$signature";
}

function verificarToken($token, $secret) {
    $partes = explode('.', $token);
    if (count($partes) !== 3) {
        return false; // Token inválido
    }

    [$headerBase64, $payloadBase64, $firmaRecibidaBase64] = $partes;
    $firmaCalculada = base64UrlEncode(hash_hmac('sha256', "$headerBase64.$payloadBase64", $secret, true));

    if (!hash_equals($firmaCalculada, $firmaRecibidaBase64)) {
        return false; // Firma no válida
    }

    $payload = json_decode(base64UrlDecode($payloadBase64), true);

    if (isset($payload['exp']) && time() > $payload['exp']) {
        return false; // Token expirado
    }

    return true; // Token válido
}
?>
