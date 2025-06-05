// src/Services/UserService.php
<?php
namespace PhpApiProject\Services;

use PhpApiProject\Models\UserModel;

class UserService {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function getAll() {
        return $this->userModel->all();
    }

    public function getById($id) {
        return $this->userModel->find($id);
    }

    public function create($name, $email) {
        return $this->userModel->create($name, $email);
    }

    public function update($id, $name, $email) {
        return $this->userModel->update($id, $name, $email);
    }

    public function delete($id) {
        return $this->userModel->delete($id);
    }
}
