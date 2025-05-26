<?php
// Define o namespace da classe
namespace Seunome\PhpApiProject\Controllers;

// Usa a classe de serviço de usuários
use \PhpApiProject\Services\UserService;

class UserController {

    // Método para retornar todos os usuários (GET /users)
    public function index() {
        // Instancia o serviço de usuários e busca todos os registros
        $users = (new UserService())->getAll();

        // Retorna os dados em formato JSON
        echo json_encode($users);
    }

    // Método para criar um novo usuário (POST /users)
    public function store() {
        // Lê os dados JSON enviados no corpo da requisição
        $data = json_decode(file_get_contents('php://input'), true);

        // Cria o novo usuário com os dados recebidos
        $result = (new UserService())->create($data['name'], $data['email']);

        // Retorna sucesso (ou falha) em JSON
        echo json_encode(['success' => $result]);
    }
}
