<?php
namespace PhpApiProject\Controllers;

use PhpApiProject\Services\UserService;

class UserController {

    public function index() {
        $users = (new UserService())->getAll();

        echo json_encode(['success' => true, 'data' => $users]);
    }

    public function show($id) {
        $user = (new UserService())->getById($id);

        if ($user) {
            echo json_encode(['success' => true, 'data' => $user]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => ['message' => 'Usuário não encontrado']]);
        }
    }

    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['name']) || empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => ['message' => 'Nome e email válidos são obrigatórios']]);
            return;
        }

        $created = (new UserService())->create($data['name'], $data['email']);

        if ($created) {
            http_response_code(201);
            echo json_encode(['success' => true, 'message' => 'Usuário criado com sucesso']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => ['message' => 'Erro ao criar usuário']]);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['name']) || empty($data['email'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => ['message' => 'Nome e email são obrigatórios']]);
            return;
        }

        $updated = (new UserService())->update($id, $data['name'], $data['email']);

        if ($updated) {
            echo json_encode(['success' => true, 'message' => 'Usuário atualizado com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => ['message' => 'Usuário não encontrado']]);
        }
    }

    public function delete($id) {
        $deleted = (new UserService())->delete($id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => 'Usuário removido com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => ['message' => 'Usuário não encontrado']]);
        }
    }
}
