<?php
// Define o namespace da classe
namespace Seunome\PhpApiProject\Services;

// Usa a classe responsável pela conexão com o banco
use Seunome\PhpApiProject\Database\Connection;

class UserService {

    // Método para retornar todos os usuários do banco
    public function getAll(): array {
        // Pega a instância do PDO (conexão com o banco)
        $pdo = Connection::get();

        // Executa uma consulta SQL simples
        return $pdo->query('SELECT * FROM users')->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Método para criar um novo usuário no banco usando procedure
    public function create(string $name, string $email): bool {
        // Pega a conexão com o banco
        $pdo = Connection::get();

        // Prepara a chamada da procedure SQL com parâmetros
        $stmt = $pdo->prepare("CALL create_user(:name, :email)");

        // Executa a procedure passando os valores
        return $stmt->execute(['name' => $name, 'email' => $email]);
    }
}
