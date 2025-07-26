<?php
// verificarToken.php

require __DIR__ . '/vendor/autoload.php'; // Ajusta la ruta si es necesario

use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

header('Content-Type: application/json');

// Lee el JSON recibido
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (!isset($input['idToken'])) {
    echo json_encode(['success' => false, 'error' => 'No se recibió token']);
    http_response_code(400);
    exit;
}

$idToken = $input['idToken'];

// Inicializa Firebase Admin SDK
try {
    $factory = (new Factory)->withServiceAccount(__DIR__.'/ruta/a/tu/firebase-service-account.json');
    $auth = $factory->createAuth();

    // Verifica el token
    $verifiedIdToken = $auth->verifyIdToken($idToken);

    // Obtén el uid o los datos del usuario
    $uid = $verifiedIdToken->claims()->get('sub');

    // Aquí podrías validar si el uid está permitido en tu app o base de datos

    echo json_encode(['success' => true, 'uid' => $uid]);

} catch (InvalidToken $e) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Token inválido: '.$e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Error del servidor: '.$e->getMessage()]);
}
