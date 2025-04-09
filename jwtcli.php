<?php
if ($argv[1] == 'generate') {
    echo 'Generating JWT';
    $secretKey = $argv[2];
    $payload = $argv[3];
    $header = [
        'alg' => 'HS256',
        'typ' => 'JWT'
        ];
    $headerJSON = json_encode($header);
    $headerBase64 = rtrim(strtr(base64_encode($headerJSON), '+/', '-_'), '=');
    $payloadBase64 = rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');
    $payloadToSign = $headerBase64 . "." . $payloadBase64;
    $signature = hash_hmac('sha256', $payloadToSign, $secretKey);

    $jwt = $payloadToSign . "." . $signature;

    var_dump($jwt);
}
// var_dump($argv);

// $header = [
//     'alg' => 'HS256',
//     'typ' => 'JWT'
//     ];
// $payload = [
//     'iss' => 'example.com',
//     'sub' => 'user123',
//     'iat' => time(),
//     'exp' => time() + 3600,
//     'role' => 'admin'
//     ];
// $secretKey = "123";

// $headerJSON = json_encode($header);
// $headerBase64 = rtrim(strtr(base64_encode($headerJSON), '+/', '-_'), '=');
// $payloadJSON = json_encode($payload);
// $payloadBase64 = rtrim(strtr(base64_encode($payloadJSON), '+/', '-_'), '=');
// $payloadToSign = $headerBase64 . "." . $payloadBase64;
// $signature = hash_hmac('sha256', $payloadToSign, $secretKey);

// $jwt = $payloadToSign . "." . $signature;

// $jwtparts = explode('.', $jwt);

// $decodedheader = json_decode(base64_decode($jwtparts[0]));
// $decodedpayload = json_decode(base64_decode($jwtparts[1]));

// $actsignature = hash_hmac('sha256', $jwtparts[0] . '.' . $jwtparts[1], $secretKey);

// if ($actsignature == $signature) {
//     echo 'Jwt Valid';
// }