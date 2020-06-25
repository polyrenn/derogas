<?php

require_once 'lib/airplay.php';
require_once 'settings/settings.php';
require BASE_PATH . 'vendor/autoload.php';

use \Firebase\JWT\JWT;

$data = json_decode(file_get_contents('php://input'), true);


$message = [];
$login = DB::select('users', ['id', 'tel', 'password'], 'tel', $data['tel']);
foreach ($login as $key => $value) {
    if (password_verify($data['password'], $value['password'])) {
        $key = base64_encode("i was there");

        $payload = array(
            "jti" => base64_encode(Airplay::token()),
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => time(),
            "data" => [
                'userid' => $value['id'],
                'tel' => $value['tel']
            ]
        );
        $jwt = JWT::encode($payload, $key);
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $message['action'] = 'login';
        $message['success'] = true;
        $message['token'] = $jwt;
        $message['timestamp'] = time();

        echo json_encode($message);
    }
}
