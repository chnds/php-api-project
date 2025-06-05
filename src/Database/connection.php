<?php
// Define o namespace da classe
namespace PhpApiProject\Database;

// Importa a classe PDO do PHP para usar conexão com banco
use PDO;

class Connection {

    // Método estático para retornar uma instância da conexão PDO
    public static function get(): PDO {
        return new PDO(
            'mysql:host=localhost;dbname=php_api;charset=utf8', // DSN: onde está o banco
            'root',     // Usuário do banco
            '',         // Senha do banco (em XAMPP normalmente é vazia)
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Configura para lançar exceções em erros SQL
            ]
        );
    }
}
