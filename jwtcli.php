<?php

$header = [
    'alg' => 'HS256',
    'typ' => 'JWT'
    ];
$payload = [
    'iss' => 'example.com',
    'sub' => 'user123',
    'iat' => time(),
    'exp' => time() + 3600,
    'role' => 'admin'
    ];
$secretKey = "123";

$headerJSON = json_encode($header);
$headerBase64 = rtrim(strtr(base64_encode($headerJSON), '+/', '-_'), '=');
$payloadJSON = json_encode($payload);
$payloadBase64 = rtrim(strtr(base64_encode($payloadJSON), '+/', '-_'), '=');
$payloadToSign = $headerBase64 . "." . $payloadBase64;
$signature = hash_hmac('sha256', $payloadToSign, $secretKey);

$jwt = $payloadToSign . "." . $signature;

var_dump($jwt);
// var_dump($signature);

// var_dump($headerJSON);
// echo $payloadJSON;