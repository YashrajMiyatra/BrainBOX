<?php
// transfer.php

function encryptUserId($user_id) {
    // Encrypt the user_id using AES-256 encryption and the generated key
    $method = 'aes-256-cbc';
    $secret_key = bin2hex(random_bytes(32)); // 256-bit key
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
    $encrypted_user_id = openssl_encrypt($user_id, $method, $secret_key, 0, $iv, $iv);

    // Return the encrypted user_id
    return $encrypted_user_id;
}

?>
