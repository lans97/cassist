<?php

namespace App\API\Handlers;

use PDOException;

class UsersHandler {
    private $_pdo;

    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
    }

    public function get_users() {
        try {
            $query = "SELECT 
                    `id`,
                    `username`,
                    `email`,
                    `super_user`,
                    `created_at`,
                    `updated_at`
                  FROM `user`";
            $stmt = $this->_pdo->query($query);
            $usersData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($usersData === false) {
                throw new \Exception("No users in database");
            }

            $users = [];
            foreach ($usersData as $userData) {
                $user = new \App\Models\User($userData['id'], $userData['username'], $userData['email'], $userData['super_user'] == 1 ? true : false, $userData['created_at'], $userData['updated_at']);
                $users[] = $user->to_array();
            }
            return $users;
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function get_user($id) {
        try {
            $query = "SELECT 
                    `id`,
                    `username`,
                    `email`,
                    `super_user`,
                    `created_at`,
                    `updated_at`
                  FROM `user`
                  WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([':id' => $id]);
            $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (empty($userData)) {
                throw new \Exception('User not found');
            }
            $user = new \App\Models\User($userData['id'], $userData['username'], $userData['email'], $userData['super_user'] == 1 ? true : false, $userData['created_at'], $userData['updated_at']);
            return $user->to_array();
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function create_user($user) {
        try {
            $salt = bin2hex(random_bytes(16));
            $hash = password_hash($salt . $user['password'], PASSWORD_DEFAULT);
            $query = "INSERT INTO `user`
                    (`username`,
                     `email`,
                     `password_hash`,
                     `salt`,
                     `super_user`)
                  VALUES
                    (:username,
                     :email,
                     :password_hash,
                     :salt,
                     :super_user)";
            $stmt = $this->_pdo->prepare($query);
            $stmt->bindParam(':username', $user['username'], \PDO::PARAM_STR);
            $stmt->bindParam(':email', $user['email'], \PDO::PARAM_STR);
            $stmt->bindParam(':password_hash', $hash, \PDO::PARAM_STR);
            $stmt->bindParam(':salt', $salt, \PDO::PARAM_STR);
            $stmt->bindParam(':super_user', $user['super_user'], \PDO::PARAM_BOOL);
            $stmt->execute();

            $userId = $this->_pdo->lastInsertId();
            return $this->get_user($userId);
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function update_user($user) {
        try {
            $this->get_user($user['id']);
            $query = "UPDATE `user`
                      SET
                        `username` = :username,
                        `email` = :email,
                        `super_user` = :super_user
                      WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->bindParam(':username', $user['username'], \PDO::PARAM_STR);
            $stmt->bindParam(':email', $user['email'], \PDO::PARAM_STR);
            $stmt->bindParam(':super_user', $user['super_user'], \PDO::PARAM_BOOL);
            $stmt->bindParam(':id', $user['id'], \PDO::PARAM_INT);
            $stmt->execute();

            return $this->get_user($user['id']);
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function delete_user($id) {
        try {
            $this->get_user($id);
            $query = "DELETE FROM `user`
                      WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function login($username, $password) {
        try {
            $query = "SELECT
                    `id`,
                    `password_hash`,
                    `salt`
                  FROM `user`
                  WHERE `username` = :username";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([':username' => $username]);
            $loginData = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($loginData === false) {
                throw new \Exception('User not found');
            }
            $match = password_verify($loginData['salt'] . $password, $loginData['password_hash']);
            if ($match === false) {
                throw new \Exception('Incorrect password');
            }
            return $loginData['id'];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
}
