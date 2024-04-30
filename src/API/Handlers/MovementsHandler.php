<?php

namespace App\API\Handlers;

use PDOException;

class MovementsHandler {
    private $_pdo;

    public function __construct(\PDO $pdo) {
        $this->_pdo = $pdo;
    }

    public function get_movements() {
        try {
            $query = "SELECT 
                    `id`,
                    `account`,
                    `category`,
                    `info`,
                    `ammount`,
                    `created_at`,
                    `updated_at`
                  FROM `movement`";
            $stmt = $this->_pdo->query($query);
            $movementsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($movementsData === false) {
                throw new \Exception("No movements in database");
            }


            $movements = [];
            foreach ($movementsData as $movementData) {
                $movement = new \App\Models\Movement($movementData['id'], $movementData['account'], $movementData['category'], $movementData['info'], $movementData['ammount'], $movementData['created_at'], $movementData['updated_at']);
                $movements[] = $movement->to_array();
            }
            return $movements;
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function get_movement($id) {
        try {
            $query = "SELECT 
                    `id`,
                    `account`,
                    `category`,
                    `info`,
                    `ammount`,
                    `created_at`,
                    `updated_at`
                  WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([':id' => $id]);
            $movementData = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (empty($movementData)) {
                throw new \Exception('Movement not found');
            }

            $movement = new \App\Models\Movement($movementData['id'], $movementData['account'], $movementData['category'], $movementData['info'], $movementData['ammount'], $movementData['created_at'], $movementData['updated_at']);
            return $movement->to_array();
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function create_movement($movement) {
        try {
            $query = "INSERT INTO `movement`
                    (`id`,
                     `account`,
                     `category`,
                     `info`,
                     `ammount`,
                     `created_at`,
                     `updated_at`)
                  VALUES
                    (:id,
                     :account,
                     :category,
                     :info,
                     :ammount,
                     :created_at,
                     :updated_at)";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([
                ':id' => $movement['id'],
                ':account' => $movement['account'],
                ':category' => $movement['category'],
                ':info' => $movement['info'],
                ':ammount' => $movement['ammount'],
                ':created_at' => $movement['created_at'],
                ':updated_at' => $movement['updated_at'],
            ]);

            $movementId = $this->_pdo->lastInsertId();
            return $this->get_movement($movementId);
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        }
    }

    public function update_movement($movement) {
        try {
            $this->get_movement($movement['id']);
            $query = "UPDATE TABLE `movement`
                    `account` = :account,
                    `category` = :category,
                    `info` = :info,
                    `ammount` = :ammount
                  WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([
                ':account' => $movement['account'],
                ':category' => $movement['category'],
                ':info' => $movement['info'],
                ':ammount' => $movement['ammount'],
            ]);

            return $this->get_movement($movement['id']);
        } catch (PDOException $th) {
            throw new PDOException($th->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function delete_movement($id) {
        try {
            $this->get_movement($id);
            $query = "DELETE FROM `movement`
                      WHERE `id` = :id";
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
