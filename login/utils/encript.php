<?php

class Crypto {
    private $secretKey;

    public function __construct($secretKey) {
        // Asegurar que la clave tenga exactamente 32 bytes
        $this->secretKey = substr(hash('sha256', $secretKey, true), 0, 32);
    }

    // Método para encriptar
    public function encrypt($data) {
        $iv = random_bytes(16); // Generar un IV aleatorio de 16 bytes
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $this->secretKey, OPENSSL_RAW_DATA, $iv);

        if ($encrypted === false) {
            throw new Exception('Error al encriptar los datos.');
        }

        // Concatenar el IV con los datos encriptados y codificar en Base64
        return base64_encode($iv . $encrypted);
    }

    // Método para desencriptar
    public function decrypt($encryptedData) {
        // Decodificar los datos en Base64
        $decodedData = base64_decode($encryptedData);

        // Extraer el IV (los primeros 16 bytes)
        $iv = substr($decodedData, 0, 16);

        // Extraer los datos encriptados
        $encrypted = substr($decodedData, 16);

        // Desencriptar
        $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $this->secretKey, OPENSSL_RAW_DATA, $iv);

        if ($decrypted === false) {
            throw new Exception('Error al desencriptar los datos.');
        }

        return $decrypted;
    }
}
?>