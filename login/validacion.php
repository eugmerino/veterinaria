<?php 
require_once __DIR__ . '/../../config/JWT.php';

use \Firebase\JWT\JWT;

function validarToken($username, $codigo){
    $key = "hola";  // Clave secreta

    $payload = array(
        "usuario" => $username, 
        "codigo" => $codigo,  
        "iat" => time(),   ,  // Tiempo de emisión
        "exp" => time() + 3600    // Tiempo de expiración
    );

    // Codificar el payload a JWT
    $jwt = JWT::encode($payload, $key);
    echo "Token generado: " . $jwt;
}

?>