<?php
// Carrega o autoloader do Composer (para usar classes com PSR-4)
require __DIR__ . '/../vendor/autoload.php';

// Usa o namespace da controller que vamos chamar
use \PhpApiProject\Controllers\UserController;

// Obtém a URI da requisição (ex: /users)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Obtém o método HTTP usado (GET, POST, etc.)
$method = $_SERVER['REQUEST_METHOD'];

// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');

// Roteamento manual básico: se for GET em /users
if ($uri === '/users' && $method === 'GET') {
    // Chama o método index() do UserController
    (new UserController())->index();

// Se for POST em /users
} elseif ($uri === '/users' && $method === 'POST') {
    // Chama o método store() do UserController
    (new UserController())->store();

// Qualquer outra rota: erro 404
} else {
    http_response_code(404); // Código HTTP 404 - não encontrado
    echo json_encode(['error' => 'Rota não encontrada']); // Mensagem em JSON
}
