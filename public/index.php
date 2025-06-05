<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PhpApiProject\Controllers\UserController;

// Simples roteamento baseado na URL e método
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$controller = new UserController();

// Roteamento básico
if ($uri === '/users' && $method === 'GET') {
    $controller->index();
} elseif (preg_match('/\/users\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    if ($method === 'GET') {
        $controller->show($id);
    } elseif ($method === 'PUT') {
        $controller->update($id);
    } elseif ($method === 'DELETE') {
        $controller->delete($id);
    }
} elseif ($uri === '/users' && $method === 'POST') {
    $controller->store();
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Rota não encontrada']);
}
