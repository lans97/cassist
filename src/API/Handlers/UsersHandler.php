<?php namespace App\API\Handlers;

use PDOException;

class UsersHandler {
    private $_pdo;
    
    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
    }
    
    public function getUsers() {
        $query = "SELECT 
                    `id`,
                    `username`,
                    `mail`,
                    `super_user`,
                    `created_at`,
                    `updated_at`
                  FROM `user`";
        $stmt = $this->_pdo->query($query);
        $usersData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = [];
        foreach ($usersData as $user) {
            $user = new \App\Models\User($user['id'], $user['username'], $user['mail'], $user['super_user'], $user['created_at'], $user['updated_at']);
            $users[] = $user->toArray();
        }
        return $users;
    }
    
    public function getUser($id) {
        $query = "SELECT 
                    `id`,
                    `username`,
                    `mail`,
                    `super_user`,
                    `created_at`,
                    `updated_at`
                  FROM `user`
                  WHERE `id` = :id";
        $stmt = $this->_pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

        $user= new \App\Models\User($userData['id'], $userData['username'], $userData['mail'], $userData['super_user'], $userData['created_at'], $userData['updated_at']);
        return $user->toArray();
    }
    
    public function createUser($user) {
        $salt = random_bytes(16);
        $hash = $this->hashPassword($user['password'], $salt);
        $query = "INSERT INTO user
                    (`username`,
                     `mail`,
                     `password_hash`,
                     `salt`,
                     `super_user`)
                  VALUES
                    (:username,
                     :mail,
                     :password_hash,
                     :salt,
                     :super_user)";      
        $stmt = $this->_pdo->prepare($query);
        $stmt->execute([
            ':username' => $user['username'],
            ':mail' => $user['mail'],
            ':password_hash' => $hash,
            ':salt' => $salt,
            ':super_user' => $user['super_user']
        ]);
        
        $userId = $this->_pdo->lastInsertId();
        return $this->getUser($userId);
    }
    
    public function updateUser($user) {
        $query = "UPDATE TABLE user
                    `username` = :username,
                    `mail` = :mail,
                    `super_user` = :super_user
                  WHERE `id` = :id";      
        $stmt = $this->_pdo->prepare($query);
        $stmt->execute([
            ':username' => $user['username'],
            ':mail' => $user['mail'],
            ':super_user' => $user['super_user']
        ]);
        
        return $this->getUser($user['id']);
    }
    
    public function deleteUser($id) {
        try {
            $query = "DELETE FROM user
                      WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    
    public function login($username, $password) {
        $query = "SELECT
                    `id`,
                    `password_hash`,
                    `salt`
                  FROM `user`
                  WHERE `username` = :username";
        $stmt = $this->_pdo->prepare($query);
        $stmt->execute([':username' => $username]);
        $loginData = $stmt->fetch(\PDO::FETCH_ASSOC);
        $match = $this->verifyPassword($loginData["password"], $loginData["password_hash"], $loginData["salt"]);
        if ($match) {
            return $this->getUser($loginData["id"]);
        } else {
            return false;
        }
    }

    private function hashPassword($password, $salt) {
        $hash = password_hash($password, PASSWORD_BCRYPT, ['salt' => $salt]);
        return $hash;
    }
    
    private function verifyPassword($password, $storedHash, $storedSalt) {
        $computedHash = password_hash($password, PASSWORD_BCRYPT, ['salt' => $storedSalt]);
    
        return password_verify($computedHash, $storedHash);
    }
    
}