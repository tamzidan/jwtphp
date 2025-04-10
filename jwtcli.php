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

// php jwtcli.php parse <jwt-token> [secret]
if ($argv[1] == 'parse') {
    
    if (!isset($argv[2])) {
        die('Argumen ke-3 wajib diisi');
    }
    
    $jwtparts = explode('.', $argv[2]);

    $decodedheader = json_decode(base64_decode($jwtparts[0]));
    $decodedpayload = json_decode(base64_decode($jwtparts[1]));

    print_r($decodedheader);
    print_r($decodedpayload);
    if (isset($argv[3])) {
        $actsignature = hash_hmac('sha256', $jwtparts[0] . '.' . $jwtparts[1], $argv[3]);

        if ($actsignature == $jwtparts[2]) {
            echo 'Jwt Valid';
        } else {
            echo 'Jwt Invalid';
        }
    }
}