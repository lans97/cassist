<?php namespace App\API\Handlers;

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
        $saltHash = $this->hashPassword($user['password']);
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
            ':password_hash' => $saltHash['hash'],
            ':salt' => $saltHash['salt'],
            ':super_user' => $user['super_user']
        ]);
        
        $userId = $this->_pdo->lastInsertId();
        return $this->getUser($userId);
    }
    
    private function hashPassword($password) {
        $salt = random_bytes(16);
    
        $hash = password_hash($password, PASSWORD_BCRYPT, ['salt' => $salt]);
    
        return array('salt' => $salt, 'hash' => $hash);
    }
    
    private function verifyPassword($password, $storedHash, $storedSalt) {
        $computedHash = password_hash($password, PASSWORD_BCRYPT, ['salt' => $storedSalt]);
    
        return password_verify($computedHash, $storedHash);
    }
    
}