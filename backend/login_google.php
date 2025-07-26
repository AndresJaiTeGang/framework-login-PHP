<?php
require __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;

header('Content-Type: application/json');

// Lee el cuerpo JSON recibido (si usas fetch con JSON)
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['token'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Token no proporcionado']);
    exit;
}

$token = $data['token'];

try {
    $factory = (new Factory)->withServiceAccount(__DIR__ . '/firebase_credentials.json');
    $auth = $factory->createAuth();

    // Verifica el token recibido
    $verifiedIdToken = $auth->verifyIdToken($token);
    $uid = $verifiedIdToken->claims()->get('sub');

    // Aquí podrías hacer lógica con el usuario, como consultar base de datos

    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'uid' => $uid,
        'message' => 'Usuario verificado'
    ]);
} catch (Exception $e) {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'error' => 'Token inválido',
        'message' => $e->getMessage()
    ]);
}
